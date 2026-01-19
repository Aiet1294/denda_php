<?php

session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}

require_once('../../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php');

use com\leartik\daw24aiet\kategoriak\KategoriaDB;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        include('kategoria_id_baliogabea.php');
        exit();
    }
    $id = (int)$_POST['id'];
} else {
    $id = (int)$_GET['id'];
}

$kategoria = KategoriaDB::selectKategoria($id);
if (!$kategoria) {
    include('kategoria_id_baliogabea.php');
    exit();
}

$errore_mezua = null;

if (isset($_POST['ezabatu'])) {
    if (!isset($_POST['berrespena']) || empty(trim($_POST['berrespena']))) {
        $errore_mezua = "Ezabatzeko berrespena beharrezkoa da. Ezin duzu hutsik utzi.";
    } elseif ($_POST['berrespena'] !== 'BAI') {
        if (strtoupper($_POST['berrespena']) === 'BAI') {
            $errore_mezua = "Berrespena maiuskuletan idatzi behar da: 'BAI' (ez 'bai').";
        } else {
            $errore_mezua = "Berrespen okerra. Idatzi 'BAI' hitza zehatz-mehatz (maiuskuletan).";
        }
    }

    if ($errore_mezua === null) {
        if (KategoriaDB::deleteKategoria($id)) {
            include('kategoria_ezabatu_da.php');
            exit();
        } else {
            include('kategoria_ez_da_ezabatu.php');
            exit();
        }
    }
}

include('kategoria_ezabatu.php');
?>