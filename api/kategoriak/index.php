<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

try {
    $db = new PDO('sqlite:../../db/denda.db');
// ... (el resto del código permanece igual)

    // GET eskaerak kudeatu
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // ID-a balidatu
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "SELECT * FROM kategoriak WHERE id=" . $id;
            $erregistroak = $db->query($sql);

            if ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $kategoria = array(
                    'id' => $erregistroa['id'],
                    'izena' => $erregistroa['izena'],
                    'deskribapena' => $erregistroa['deskribapena']
                );
                echo json_encode($kategoria, JSON_UNESCAPED_UNICODE);

            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen kategoriarik.']);
            }
        } else {
            $sql = "SELECT * FROM kategoriak ORDER BY id";
            $erregistroak = $db->query($sql);

            if($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {
                $kategoriak = array();
                $i = 0;
                do {
                    $kategoriak[$i] = array(
                        'id' => $erregistroa['id'],
                        'izena' => $erregistroa['izena'],
                        'deskribapena' => $erregistroa['deskribapena']
                    );
                    $i++;
                } while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC));
            } else {
                $kategoriak = [];
            }


            echo json_encode($kategoriak, JSON_UNESCAPED_UNICODE);
        }
    }
    
    // POST eskaerak kudeatu
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $errors = [];
        if (!isset($data['izena'])) {
            $errors[] = 'izena falta da.';
        }
        if (!isset($data['deskribapena'])) {
            $errors[] = 'deskribapena falta da.';
        }

        if (empty($errors)) {
            try {
                $db->beginTransaction();

                $izena = $data['izena'];
                $deskribapena = $data['deskribapena'];

                $sql = "INSERT INTO kategoriak (izena, deskribapena) VALUES (:izena, :deskribapena)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':izena', $izena);
                $stmt->bindParam(':deskribapena', $deskribapena);

                if ($stmt->execute()) {
                    $lastId = $db->lastInsertId();
                    $db->commit(); // Transakzioa onartu
                    http_response_code(201);
                    echo json_encode(['id' => $lastId]);
                } else {
                    $db->rollBack(); // Errorea egon bada, desegin
                    http_response_code(500);
                    $errorInfo = $stmt->errorInfo();
                    echo json_encode(['error' => 'Errorea kategoria sortzean.', 'db_error' => $errorInfo[2]]);
                }
            } catch (Exception $e) {
                $db->rollBack(); // Salbuespenik badago, desegin
                http_response_code(500);
                echo json_encode(['error' => 'Errorea transakzioan: ' . $e->getMessage()]);
            }
        } else {
                http_response_code(400);
                echo json_encode(['error' => 'Datu falta edo baliogabeak.', 'details' => $errors]);
        }
    } 

    // PUT eskaerak kudeatu
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);

        $errors = [];
        if (!isset($_GET['id'])) {
            $errors[] = 'Kategoriaren IDa falta da URLan (?id=...).';
        }
        if (!isset($data['izena'])) {
            $errors[] = 'izena falta da.';
        }
        if (!isset($data['deskribapena'])) {
            $errors[] = 'deskribapena falta da.';
        }

        if (empty($errors)) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $izena = $data['izena'];
            $deskribapena = $data['deskribapena'];

            $sql = "UPDATE kategoriak SET izena = :izena, deskribapena = :deskribapena WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':izena', $izena);
            $stmt->bindParam(':deskribapena', $deskribapena);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Kategoria ondo aldatu da.']);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen kategoriarik.']);
                }
            } else {
                http_response_code(500);
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['error' => 'Errorea kategoria aldatzean.', 'db_error' => $errorInfo[2]]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Datu falta edo baliogabeak.', 'details' => $errors]);
        }
    }

    // DELETE eskaerak kudeatu
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "DELETE FROM kategoriak WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Kategoria ondo ezabatu da.']);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen kategoriarik.']);
                }
            } else {
                http_response_code(500);
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['error' => 'Errorea kategoria ezabatzean.', 'db_error' => $errorInfo[2]]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'IDa beharrezkoa da.']);
        }
    }

    if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST', 'PUT', 'DELETE'])) {
        http_response_code(405);
        echo json_encode(['error' => 'Metodo ez onartua.']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB Konexio errorea: ' . $e->getMessage()]);
}
?>
