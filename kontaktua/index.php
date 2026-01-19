<?php

require_once('../klaseak/com/leartik/daw24aiet/mezuak/mezua.php');
require_once('../klaseak/com/leartik/daw24aiet/mezuak/mezua_db.php');

use com\leartik\daw24aiet\mezuak\Mezua;
use com\leartik\daw24aiet\mezuak\MezuaDB;

session_start();

if (isset($_POST['bidali'])) {

    // Datuak lortu eta garbitu
    $izena = isset($_POST['izena']) ? trim($_POST['izena']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mezua_testua = isset($_POST['mezua']) ? trim($_POST['mezua']) : '';

    // Balidazioak
    $erroreak = [];

    if (empty($izena)) {
        $erroreak[] = "Izena derrigorrezkoa da.";
    } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $izena)) {
        $erroreak[] = "Izena baliogabea da. Hizkiak soilik onartzen dira.";
    }

    if (empty($email)) {
        $erroreak[] = "Emaila derrigorrezkoa da.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erroreak[] = "Emailaren formatua ez da zuzena.";
    }

    if (empty($mezua_testua)) {
        $erroreak[] = "Mezuaren testua derrigorrezkoa da.";
    }

    if (count($erroreak) > 0) {
        include('mezu_berria.php');
    } else {
        $mezua = new Mezua();
        $mezua->setIzena($izena);
        $mezua->setEmail($email);
        $mezua->setMezua($mezua_testua);
        $mezua->setSortzeData(date('Y-m-d H:i:s'));

        if (MezuaDB::insertMezua($mezua) > 0) {
            include('mezua_gorde_da.php');
        } else {
            $errore_testua = "Errore bat gertatu da datu-basean gordetzerakoan.";
            include('mezua_ez_da_gorde.php');
        }
    }
} else {
    include('mezu_berria.php');
}
?>