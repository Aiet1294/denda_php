<?php

session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}

require_once('../../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php');
require_once('../../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php');

use com\leartik\daw24aiet\produktuak\ProduktuaDB;
use com\leartik\daw24aiet\kategoriak\KategoriaDB;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        include('produktua_id_baliogabea.php');
        exit();
    }
    $id = (int)$_POST['id'];
} else {
    $id = (int)$_GET['id'];
}


$produktua = ProduktuaDB::selectProduktu($id);
if (!$produktua) {
    include('produktua_id_baliogabea.php');
    exit();
}

$errore_mezua = null;

$kategoriak = KategoriaDB::selectKategoriak();

if (isset($_POST['bidali'])) {
    $izena = trim($_POST['izena']);
    $prezioa = (float)$_POST['prezioa'];
    $kategoria_id = (int)$_POST['kategoria_id'];
    $deskontua = $_POST['deskontua'];
    $nobedadea = isset($_POST['nobedadea']) ? (int)$_POST['nobedadea'] : 0;
    $pisua = (float)$_POST['pisua'];
    $urtea = isset($_POST['urtea']) && !empty($_POST['urtea']) ? (int)$_POST['urtea'] : null;

    if (empty($izena)) {
        $errore_mezua = "Produktu izena ezin da hutsik egon.";
    } elseif ($kategoria_id <= 0) {
        $errore_mezua = "Kategoria aukeratu behar duzu.";
    }  elseif ($prezioa <= 0) {
        $errore_mezua = "Prezioa ezin da 0 edo negatiboa izan.";
    } elseif (!is_numeric($deskontua)) {
        $errore_mezua = "Deskontua zenbaki bat izan behar da.";
    } elseif ($deskontua < 0 || $deskontua > 100) {
        $errore_mezua = "Deskontua 0 eta 100 artean egon behar da.";
    } elseif (!in_array($nobedadea, [0, 1], true)) {
        $errore_mezua = "Nobedadea balio baliogabea da (0 edo 1 izan behar da).";
    } elseif ($pisua <= 0) {
        $errore_mezua = "Pisua 0 baino handiagoa izan behar da.";
    } elseif ($urtea !== null && ($urtea < 2020 || $urtea > 2030)) {
        $errore_mezua = "Urtea 2020 eta 2030 artean egon behar da.";
    }

    if ($errore_mezua === null) {
        $produktua->setIzena($izena);
        $produktua->setPrezioa($prezioa);
        $produktua->setIdKategoria($kategoria_id);
        $produktua->setDeskontua((int)$deskontua);
        $produktua->setNobedadea($nobedadea);
        $produktua->setPisua($pisua);
        $produktua->setUrtea($urtea);

        if (ProduktuaDB::updateProduktu($produktua)) {
            $kategoria_aukeratua = null;
            foreach ($kategoriak as $kat) {
                if ($kat->getId() == $kategoria_id) {
                    $kategoria_aukeratua = $kat->getIzena();
                    break;
                }
            }
            
            $produktu_aldaketak = [
                'id' => $id,
                'izena' => $izena,
                'kategoria_id' => $kategoria_id,
                'kategoria_izena' => $kategoria_aukeratua ?: 'Kategoria ezezaguna',
                'prezioa' => $prezioa,
                'deskontua' => (int)$deskontua,
                'nobedadea' => $nobedadea,
                'pisua' => $pisua,
                'urtea' => $urtea,
                'data' => date('Y-m-d H:i:s')
            ];
            include('produktua_gorde_da.php');
            exit();
        } else {
            include('produktua_ez_da_gorde.php');
            exit();
        }
    } else {
        $produktua->setIzena($izena);
        $produktua->setPrezioa($prezioa);
        $produktua->setIdKategoria($kategoria_id);
        $produktua->setDeskontua((int)$deskontua);
        $produktua->setNobedadea($nobedadea);
        $produktua->setPisua($pisua);
        $produktua->setUrtea($urtea);
    }
}

include('produktua_aldatu.php');

?>