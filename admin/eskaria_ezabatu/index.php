<?php

session_start();


if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}

require_once('../../klaseak/com/leartik/daw24aiet/eskariak/eskaria_db.php');

use com\leartik\daw24aiet\eskariak\EskariaDB;


if (isset($_POST['id'])) {
    $id_raw = $_POST['id'];
} elseif (isset($_GET['id'])) {
    $id_raw = $_GET['id'];
} else {
    include('eskaria_id_baliogabea.php');
    exit();
}

if (filter_var($id_raw, FILTER_VALIDATE_INT) === false) {
    include('eskaria_id_baliogabea.php');
    exit();
}

$id = (int)$id_raw;

if ($id <= 0) {
    include('eskaria_id_baliogabea.php');
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
        if (EskariaDB::deleteEskaria($id)) {
            include('eskaria_ezabatu_da.php');
            exit();
        } else {
            include('eskaria_ez_da_ezabatu.php'); 
            exit();
        }
    }
}

$eskaria = EskariaDB::selectEskaria($id);

if (!$eskaria) {
    include('eskaria_id_baliogabea.php');
    exit();
}

include('eskaria_ezabatu.php');
?>