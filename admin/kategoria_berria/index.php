<?php
session_start();

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != 'admin') {
    header('Location: ../');
    exit;
}

require_once('../../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php');

use com\leartik\daw24aiet\kategoriak\Kategoria;
use com\leartik\daw24aiet\kategoriak\KategoriaDB;

$mezua = '';
$mota = 'error';

$form_data = [
    'izena' => '',
    'deskribapena' => ''
];

$errore_mezua = null;

if (isset($_POST['gorde'])) {
    $izena = trim($_POST['izena']);
    $deskribapena = trim($_POST['deskribapena']);

    $form_data = [
        'izena' => $izena,
        'deskribapena' => $deskribapena
    ];

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
        $kategoria = new Kategoria(null, $izena, $deskribapena, date('Y-m-d H:i:s'));

        if (KategoriaDB::insertKategoria($kategoria)) {
            $kategoria_berria = [
                'izena' => $izena,
                'deskribapena' => $deskribapena,
                'data' => date('Y-m-d H:i:s')
            ];
            include('kategoria_gorde_da.php');
            exit();
        } else {
            include('kategoria_ez_da_gorde.php');
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

include('kategoria_berria.php');

?>
