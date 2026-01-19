<?php

session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}

require_once('../../klaseak/com/leartik/daw24aiet/mezuak/mezua_db.php');

use com\leartik\daw24aiet\mezuak\MezuaDB;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        include('mezua_id_baliogabea.php');
        exit();
    }
    $id = (int)$_POST['id'];
} else {
    $id = (int)$_GET['id'];
}

$mezua = MezuaDB::selectMezua($id);
if (!$mezua) {
    include('mezua_id_baliogabea.php');
    exit();
}

$errore_mezua = null;

if (isset($_POST['bidali'])) {
    // Bakarrik erantzunda egoera aldatzen dugu
    $erantzunda = isset($_POST['erantzunda']);

    $mezua->setErantzunda($erantzunda);

    if (MezuaDB::updateMezua($mezua)) {
        include('mezua_gorde_da.php');
        exit();
    } else {
        include('mezua_ez_da_gorde.php');
        exit();
    }
}

include('mezua_aldatu.php');

?>
