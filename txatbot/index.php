<?php
session_start();
require_once '../index.php'; // Konexioa lortzeko (Ensure this path is correct relative to txatbot folder)

$apiKey = getenv('OPENAI_API_KEY'); // Ziurtatu ingurune aldagaia definituta dagoela edo jarri gakoa hemen

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: text/plain');
    $erabiltzailearen_mezua = trim($_POST['erabiltzailearen_mezua'] ?? '');

    if (empty($erabiltzailearen_mezua)) {
        echo "Mezua falta da";
        exit;
    }

    // Gorde mezua historian
    if (!isset($_SESSION['txataren_mezuak'])) {
        $_SESSION['txataren_mezuak'] = [];
    }
    
    // 1. URRATSA: Iragazkiak atera
    $systemPrompt1 = "Zure lana denda bateko produktuen bilaketa-iragazkiak JSON formatuan itzultzea da.
    Eremuak: izena, kategoria, prezio_min, prezio_max, urtea_min, urtea_max.
    Balorerik ez badago, null erabili. Ez sartu testu gehigarririk, soilik JSON objektua.";

    $messages1 = [
        ["role" => "system", "content" => $systemPrompt1],
        ["role" => "user", "content" => $erabiltzailearen_mezua]
    ];

    $responseJson = callOpenAI($messages1, $apiKey, true);
    
    // Clean potential markdown code blocks
    $cleanJson = preg_replace('/^```json\s*|\s*```$/', '', trim($responseJson));
    $filtroak = json_decode($cleanJson, true);

    // 2. URRATSA: Datu basean bilatu
    $db = getDbConnection();
    if (!$db) {
        echo "Errorea datu-basearekin konektatzean.";
        exit;
    }

    $sql = "SELECT p.*, k.izena as kategoria_izena 
            FROM Produktuak p 
            LEFT JOIN Kategoriak k ON p.id_kategoria = k.id 
            WHERE 1=1";
    
    $params = [];

    if (!empty($filtroak['izena'])) {
        $sql .= " AND p.izena LIKE :izena";
        $params[':izena'] = '%' . $filtroak['izena'] . '%';
    }
    if (!empty($filtroak['kategoria'])) {
        $sql .= " AND k.izena LIKE :kategoria";
        $params[':kategoria'] = '%' . $filtroak['kategoria'] . '%';
    }
    if (!empty($filtroak['prezio_min'])) {
        $sql .= " AND p.prezioa >= :prezio_min";
        $params[':prezio_min'] = $filtroak['prezio_min'];
    }
    if (!empty($filtroak['prezio_max'])) {
        $sql .= " AND p.prezioa <= :prezio_max";
        $params[':prezio_max'] = $filtroak['prezio_max'];
    }
    if (!empty($filtroak['urtea_min'])) {
        $sql .= " AND p.urtea >= :urtea_min";
        $params[':urtea_min'] = $filtroak['urtea_min'];
    }
    if (!empty($filtroak['urtea_max'])) {
        $sql .= " AND p.urtea <= :urtea_max";
        $params[':urtea_max'] = $filtroak['urtea_max'];
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();

    $produktuakTestua = "";
    if (empty($products)) {
        $produktuakTestua = "Ez da produkturik aurkitu irizpide horiekin.";
    } else {
        foreach ($products as $p) {
            $produktuakTestua .= "- {$p['izena']} ({$p['kategoria_izena']}): {$p['prezioa']}€, Urtea: {$p['urtea']}\n";
        }
    }

    // 3. URRATSA: Erantzuna sortu
    
    // Gehitu erabiltzailearen mezua historiara
    $_SESSION['txataren_mezuak'][] = ["role" => "user", "content" => $erabiltzailearen_mezua];
    
    // Sortu testuingurua LLMarentzat
    $messages2 = $_SESSION['txataren_mezuak'];
    $messages2[] = [
        "role" => "system", 
        "content" => "Erabiltzaileak egindako galderari erantzun, beheko produktu zerrendan oinarrituta. " .
                    "Zerrendan produkturik ez badago, adierazi ez duzula ezer aurkitu. " .
                    "Erantzun euskaraz, modu atseginean. Hona hemen aurkitutako produktuak:\n" . $produktuakTestua
    ];

    $botErantzuna = callOpenAI($messages2, $apiKey, false);

    // Gehitu bot-aren erantzuna historiara
    $_SESSION['txataren_mezuak'][] = ["role" => "assistant", "content" => $botErantzuna];

    echo $botErantzuna;
    exit;
}

function callOpenAI($messages, $apiKey, $jsonMode = false) {
    if (empty($apiKey)) {
        return "Errorea: API Key-a ez dago konfiguratuta.";
    }

    $url = 'https://api.openai.com/v1/chat/completions';
    
    $data = [
        "model" => "gpt-4o-mini", // Edo gpt-3.5-turbo
        "messages" => $messages,
        "temperature" => 0.7
    ];
    
    if ($jsonMode) {
        $data["response_format"] = ["type" => "json_object"];
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    // Desactivar verificación SSL para evitar error en XAMPP
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) {
        return 'Errorea API deian: ' . curl_error($ch);
    }
    
    // curl_close($ch); // Deprecated in PHP 8.x
    
    $decoded = json_decode($result, true);
    
    if (isset($decoded['choices'][0]['message']['content'])) {
        return $decoded['choices'][0]['message']['content'];
    } else {
        // Errorea edo formatu okerra
        return "Arazo bat egon da erantzuna lortzean.";
    }
}

include 'txatbot.php';
?>
