<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_config.php';

echo "<h2>Datu-basearen konexio proba AWS-ra</h2>";

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color:green'>✅ Konexioa ondo burutu da!</p>";
    
    // Taulak zerrendatu
    echo "<h3>Taulak:</h3>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";

    // Produktuak taularen egitura ikusi
    if (in_array('Produktuak', $tables) || in_array('produktuak', $tables)) {
        $tableName = in_array('Produktuak', $tables) ? 'Produktuak' : 'produktuak';
        echo "<h3>$tableName taularen egitura:</h3>";
        $columns = $pdo->query("DESCRIBE $tableName")->fetchAll(PDO::FETCH_ASSOC);
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        foreach ($columns as $col) {
            echo "<tr>";
            foreach ($col as $val) {
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        // Produktuen kopurua
        $count = $pdo->query("SELECT COUNT(*) FROM $tableName")->fetchColumn();
        echo "<h3>Produktuak guztira: $count</h3>";

        // Lehenengo 5 produktuak erakutsi debug egiteko
        if ($count > 0) {
            echo "<h3>Lehenengo 5 produktuak:</h3>";
            $products = $pdo->query("SELECT * FROM $tableName LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
             echo "<pre>";
             print_r($products);
             echo "</pre>";
        }

    } else {
        echo "<p style='color:red'>❌ Ez da 'Produktuak' taula aurkitu.</p>";
    }

} catch (PDOException $e) {
    echo "<p style='color:red'>❌ Errorea konexioan: " . $e->getMessage() . "</p>";
}
?>