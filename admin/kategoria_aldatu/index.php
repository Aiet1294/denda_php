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

if (isset($_POST['bidali'])) {
    $izena = trim($_POST['izena']);
    $deskribapena = trim($_POST['deskribapena']);

    if (empty($izena)) {
        $errore_mezua = "Kategoria izena ezin da hutsik egon.";
    } elseif (strlen($izena) < 2) {
        $errore_mezua = "Kategoria izena gutxienez 2 karaktere izan behar du.";
    } elseif (strlen($izena) > 50) {
        $errore_mezua = "Kategoria izena gehienez 50 karaktere izan behar du.";
    } elseif (strlen($deskribapena) > 255) {
        $errore_mezua = "Deskribapena gehienez 255 karaktere izan behar du.";
    }

    if ($errore_mezua === null) {
        $kategoria->setIzena($izena);
        $kategoria->setDeskribapena($deskribapena);

        if (KategoriaDB::updateKategoria($kategoria)) {
            $kategoria_aldaketak = [
                'izena' => $izena,
                'deskribapena' => $deskribapena,
                'id' => $id,
                'data' => date('Y-m-d H:i:s')
            ];
            include('kategoria_gorde_da.php');
            exit();
        } else {
            include('kategoria_ez_da_gorde.php');
            exit();
        }
    } else {
        $kategoria->setIzena($izena);
        $kategoria->setDeskribapena($deskribapena);
    }
}

include('kategoria_aldatu.php');

?>