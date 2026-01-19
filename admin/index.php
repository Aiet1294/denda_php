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

if (isset($_POST['sartu'])) {
    if ($_POST['erabiltzailea'] == "admin" && $_POST['pasahitza'] == "admin") {
        $admin = true;
        $_SESSION["erabiltzailea"] = "admin";
    }
} else if (isset($_SESSION['erabiltzailea']) && $_SESSION['erabiltzailea'] == "admin") {
    $admin = true;
}

if ($admin == true) {
    $produktuak = ProduktuaDB::selectProduktuak();
    $kategoriak = KategoriaDB::selectKategoriak();
    $mezuak = MezuaDB::selectMezuak();
    $eskariak = EskariaDB::selectEskariak();
    include('erakutsi.php');
} else {
    if (isset($_POST['sartu'])) {
        $mezua = "Datuak ez dira zuzenak";
    } else {
        $mezua = "";
    }
    include('login.php');
}

?> 
