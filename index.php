<?php
require_once __DIR__ . '/db_config.php';

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin');

define('APP_NAME', 'Gimnasio Denda');
define('APP_VERSION', '2.0');

function getDbConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    } catch (PDOException $e) {
        error_log("Datu base konexio errorea: " . $e->getMessage());
        return null;
    }
}

function isAdmin() {
    session_start();
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function loginAdmin($erabiltzailea, $pasahitza) {
    if ($erabiltzailea === ADMIN_USER && $pasahitza === ADMIN_PASS) {
        session_start();
        $_SESSION['admin'] = true;
        $_SESSION['admin_user'] = $erabiltzailea;
        return true;
    }
    return false;
}

function logoutAdmin() {
    session_start();
    session_destroy();
}

function formatPrice($zenbakia) {
    return number_format($zenbakia, 2, ',', '.') . ' €';
}

function safe($testua) {
    return htmlspecialchars($testua, ENT_QUOTES, 'UTF-8');
}

if (basename($_SERVER['PHP_SELF']) === 'index.php' && (dirname($_SERVER['PHP_SELF']) === '/denda_php' || dirname($_SERVER['PHP_SELF']) === '/')) {
    header('Location: hasiera/index.php');
    exit();
}

?>
