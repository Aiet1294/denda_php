<?php

session_start();

require_once('../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php');
require_once('../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php');
require_once('../klaseak/com/leartik/daw24aiet/mezuak/mezua_db.php');
require_once('../klaseak/com/leartik/daw24aiet/eskariak/eskaria_db.php');

use com\leartik\daw24aiet\produktuak\ProduktuaDB;
use com\leartik\daw24aiet\kategoriak\KategoriaDB;
use com\leartik\daw24aiet\mezuak\MezuaDB;
use com\leartik\daw24aiet\eskariak\EskariaDB;

$admin = false;
$captcha_errorea = false;

if (isset($_POST['sartu'])) {
    // 1. Primero verificamos el Captcha
    $captcha_zuzena = false;
    if (isset($_POST['captcha']) && isset($_SESSION['captcha_emaitza'])) {
        if (intval($_POST['captcha']) === intval($_SESSION['captcha_emaitza'])) {
            $captcha_zuzena = true;
        }
    }

    // 2. Si el captcha es correcto, verificamos usuario y contraseña
    if ($captcha_zuzena) {
        if ($_POST['erabiltzailea'] == "admin" && $_POST['pasahitza'] == "admin") {
            $admin = true;
            $_SESSION["erabiltzailea"] = "admin";
        }
    } else {
        // Marcamos error de captcha para mostrar mensaje diferente si quieres
        $captcha_errorea = true;
    }

} else if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if ($admin == true) {
    // Borramos el captcha de la sesión porque ya entró
    unset($_SESSION['captcha_emaitza']);

    $produktuak = ProduktuaDB::selectProduktuak();
    $kategoriak = KategoriaDB::selectKategoriak();
    $mezuak = MezuaDB::selectMezuak();
    $eskariak = EskariaDB::selectEskariak();
    include('erakutsi.php');
} else {
    // Generamos nuevos números para el captcha
    $n1 = rand(1, 10);
    $n2 = rand(1, 10);
    $_SESSION['captcha_emaitza'] = $n1 + $n2;
    $captcha_tetsua = "$n1 + $n2"; // Esta variable se usará en login.php

    if (isset($_POST['sartu'])) {
        if ($captcha_errorea) {
            $mezua = "Captcha okerra da. Saiatu berriro.";
        } else {
            $mezua = "Datuak ez dira zuzenak";
        }
    } else {
        $mezua = "";
    }
    include('login.php');
}

?>