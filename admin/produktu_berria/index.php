<?php
session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != 'admin') {
    header('Location: ../');
    exit;
}

require_once('../../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php');
require_once('../../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php');

use com\leartik\daw24aiet\produktuak\Produktua;
use com\leartik\daw24aiet\produktuak\ProduktuaDB;
use com\leartik\daw24aiet\kategoriak\KategoriaDB;

$mezua = '';
$mota = 'error';

$form_data = [
    'izena' => '',
    'id_kategoria' => 0,
    'prezioa' => '',
    'deskontua' => 0,
    'nobedadea' => 0,
    'pisua' => '',
    'urtea' => date('Y')
];

$errore_mezua = null;

if (isset($_POST['gorde'])) {
    $izena = trim($_POST['izena']);
    $id_kategoria = (int)$_POST['id_kategoria'];
    $prezioa = (float)$_POST['prezioa'];
    $deskontua = $_POST['deskontua'];
    $nobedadea = isset($_POST['nobedadea']) ? (int)$_POST['nobedadea'] : 0;
    $pisua = (float)$_POST['pisua'];
    $urtea = isset($_POST['urtea']) && !empty($_POST['urtea']) ? (int)$_POST['urtea'] : null;

    $form_data = [
        'izena' => $izena,
        'id_kategoria' => $id_kategoria,
        'prezioa' => $prezioa,
        'deskontua' => $deskontua,
        'nobedadea' => $nobedadea,
        'pisua' => $pisua,
        'urtea' => $urtea ?? date('Y')
    ];

    if (empty($izena)) {
        $errore_mezua = "Produktu izena ezin da hutsik egon.";
    }elseif ($id_kategoria <= 0) {
        $errore_mezua = "Kategoria aukeratu behar duzu."; 
    } elseif ($prezioa <= 0) {
        $errore_mezua = "Prezioa ezin da 0 edo negatiboa izan.";
    } elseif (!is_numeric($deskontua)) {
        $errore_mezua = "Deskontua zenbaki bat izan behar da.";
    } elseif ($deskontua < 0 || $deskontua > 100) {
        $errore_mezua = "Deskontua 0 eta 100 artean egon behar da.";
    } elseif (!in_array($nobedadea, [0, 1], true)) {
        $errore_mezua = "Nobedadea 0 edo 1 izan behar da.";
    } elseif ($pisua <= 0) {
        $errore_mezua = "Pisua 0 baino handiagoa izan behar da.";
    } elseif ($urtea !== null && ($urtea < 2020 || $urtea > 2030)) {
        $errore_mezua = "Urtea 2020 eta 2030 artean egon behar da.";
    }

    if ($errore_mezua === null) {
        $produktua = new Produktua(null, $id_kategoria, $izena, $prezioa, (int)$deskontua, $nobedadea, $pisua, $urtea);

        if (ProduktuaDB::insertProduktu($produktua)) {
            $produktu_berria = [
                'izena' => $izena,
                'id_kategoria' => $id_kategoria,
                'kategoria_izena' => isset($kategoriak[$id_kategoria]) ? $kategoriak[$id_kategoria] : 'Kategoria ezezaguna',
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
        $mezua = $errore_mezua;
        $mota = 'error';
    }
}

$kategoria_objektuak = KategoriaDB::selectKategoriak();
$kategoriak = [];
foreach ($kategoria_objektuak as $kat) {
    $kategoriak[$kat->getId()] = $kat->getIzena();
}


include('produktu_berria.php');

?>