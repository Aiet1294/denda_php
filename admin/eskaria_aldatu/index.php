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

$eskaria = EskariaDB::selectEskaria($id);
if (!$eskaria) {
    include('eskaria_id_baliogabea.php');
    exit();
}

if (isset($_POST['gorde'])) {
    
    $balidatu = isset($_POST['balidatu']) ? (int)$_POST['balidatu'] : 0;
    
    if ($balidatu !== 0 && $balidatu !== 1) {
        // Balioa ez bada 0 edo 1, 0 behartuko dugu edo errorea eman
        $balidatu = 0;
    }

    if (EskariaDB::updateBalidatu($id, $balidatu)) {
        include('eskaria_gorde_da.php');
    } else {
        include('eskaria_ez_da_gorde.php');
    }
    exit();
}

include('eskaria_aldatu.php');
?>


