<?php
require('../klaseak/com/leartik/daw24aiet/produktuak/produktua.php');
require('../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php');
require('../klaseak/com/leartik/daw24aiet/detaileak/detailea.php');
require('../klaseak/com/leartik/daw24aiet/saskiak/saskia.php');
require('../klaseak/com/leartik/daw24aiet/eskariak/eskaria_db.php');

session_start();

use com\leartik\daw24aiet\produktuak\ProduktuaDB;
use com\leartik\daw24aiet\detaileak\Detailea;
use com\leartik\daw24aiet\saskiak\Saskia;

if (!isset($_SESSION['saskia'])) {
    $saskia = new Saskia();
    $_SESSION['saskia'] = $saskia;
} else {
    $saskia = $_SESSION['saskia'];
}

if (isset($_POST['gehitu'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $kopurua = isset($_POST['kopurua']) ? $_POST['kopurua'] : null;
    if (is_numeric($id) && $id > 0 && is_numeric($kopurua) && $kopurua > 0) {
        $produktua = ProduktuaDB::selectProduktu($id);
        if ($produktua) {
            $detailea = new Detailea();
            $detailea->setProduktua($produktua);
            $detailea->setKopurua($kopurua);
            $saskia->detaileaGehitu($detailea);
            $_SESSION['saskia'] = $saskia;
        }
    }
}

if (isset($_POST['eguneratu'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $kopurua = isset($_POST['kopurua']) ? $_POST['kopurua'] : null;

    if (!is_numeric($id) || $id <= 0) {
        $mezua = "Errorea: Produktuaren ID zenbaki positiboa izan behar da.";
    }
    if (!preg_match("/^[0-9]+$/", $id)) {
        $mezua = "Errorea: Produktuaren ID zenbaki bat izan behar da.";
    }
    if (!is_numeric($kopurua) || $kopurua <= 0) {
        $mezua = "Errorea: Kopurua zenbaki positiboa izan behar da.";
    }
    if (!preg_match("/^[0-9]+$/", $kopurua)) {
        $mezua = "Errorea: Kopurua zenbaki bat izan behar da.";
    }
    
    if (is_numeric($id) && $id > 0 && is_numeric($kopurua) && $kopurua > 0) {
        $produktua = ProduktuaDB::selectProduktu($id);
        if ($produktua) {
            $detailea = new Detailea();
            $detailea->setProduktua($produktua);
            $detailea->setKopurua($kopurua);
            $saskia->detaileaAldatu($detailea);
            $_SESSION['saskia'] = $saskia;
        }
    }
}

if (isset($_POST['ezabatu'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (!is_numeric($id) || $id <= 0) {
        $mezua = "Errorea: Produktuaren ID zenbaki positiboa izan behar da.";
    }
    
    if (!preg_match("/^[0-9]+$/", $id)) {
        $mezua = "Errorea: Produktuaren ID zenbaki bat izan behar da.";
    }

    if (is_numeric($id) && $id > 0) {
        $produktua = ProduktuaDB::selectProduktu($id);
        if ($produktua) {
            $detailea = new Detailea();
            $detailea->setProduktua($produktua);
            $saskia->detaileaEzabatu($detailea);
            $_SESSION['saskia'] = $saskia;
        }
    }
}

include('saskia_erakutsi.php');
?>
