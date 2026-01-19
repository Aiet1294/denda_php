<?php
require_once('../klaseak/com/leartik/daw24aiet/eskariak/eskaria_db.php');
require_once('../klaseak/com/leartik/daw24aiet/saskiak/saskia.php');
require_once('../klaseak/com/leartik/daw24aiet/detaileak/detailea.php');
require_once('../klaseak/com/leartik/daw24aiet/produktuak/produktua.php');

session_start();

use com\leartik\daw24aiet\eskariak\EskariaDB;
use com\leartik\daw24aiet\eskariak\Eskaria;
use com\leartik\daw24aiet\bezeroak\Bezeroa;


if (!isset($_SESSION['saskia'])) {
    header('Location: ../saskia/index.php');
    exit();
}

$saskia = $_SESSION['saskia'];

if ($saskia->getDetaileKopurua() == 0) {
    header('Location: ../saskia/index.php');
    exit();
}

if (isset($_POST['eskaria_amaitu'])) {
    
    // Datuak lortu eta garbitu
    $izena = isset($_POST['izena']) ? trim($_POST['izena']) : '';
    $abizena = isset($_POST['abizena']) ? trim($_POST['abizena']) : '';
    $emaila = isset($_POST['emaila']) ? trim($_POST['emaila']) : '';
    $helbidea = isset($_POST['helbidea']) ? trim($_POST['helbidea']) : '';
    $herria = isset($_POST['herria']) ? trim($_POST['herria']) : '';
    $postaKodea = isset($_POST['postaKodea']) ? trim($_POST['postaKodea']) : '';
    $probintzia = isset($_POST['probintzia']) ? trim($_POST['probintzia']) : '';

    // Balidazioak
    $erroreak = [];

    if (empty($izena)) {
        $erroreak[] = "Izena derrigorrezkoa da.";
    } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $izena)) {
        $erroreak[] = "Izena baliogabea da. Hizkiak soilik onartzen dira.";
    }

    if (empty($abizena)) {
        $erroreak[] = "Abizena derrigorrezkoa da.";
    } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $abizena)) {
        $erroreak[] = "Abizena baliogabea da. Hizkiak soilik onartzen dira.";
    }

    if (empty($emaila)) {
        $erroreak[] = "Emaila derrigorrezkoa da.";
    } elseif (!filter_var($emaila, FILTER_VALIDATE_EMAIL)) {
        $erroreak[] = "Emailaren formatua ez da zuzena.";
    }

    if (empty($helbidea)) {
        $erroreak[] = "Helbidea derrigorrezkoa da.";
    } elseif (!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s.,'-]+$/", $helbidea)) {
        $erroreak[] = "Helbidea baliogabea da.";
    }

    if (empty($herria)) {
        $erroreak[] = "Herria derrigorrezkoa da.";
    } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $herria)) {
        $erroreak[] = "Herria baliogabea da. Hizkiak soilik onartzen dira.";
    }

    if (empty($postaKodea)) {
        $erroreak[] = "Posta kodea derrigorrezkoa da.";
    } elseif (!ctype_digit($postaKodea) || strlen($postaKodea) != 5) {
        $erroreak[] = "Posta kodea baliogabea da. 5 zenbaki izan behar ditu.";
    }

    if (empty($probintzia)) {
        $erroreak[] = "Probintzia derrigorrezkoa da.";
    } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $probintzia)) {
        $erroreak[] = "Probintzia baliogabea da. Hizkiak soilik onartzen dira.";
    }

    if (count($erroreak) > 0) {
        // Erroreak badaude, berriro inprimakia erakutsi errore mezuekin
        $totala = 0;
        foreach ($saskia->getDetaileak() as $detailea) {
            $totala += $detailea->getProduktua()->getPrezioa() * $detailea->getKopurua();
        }
        include('eskaria_inprimakia.php');
    } else {
        // Bezeroa sortu
        $bezeroa = new Bezeroa(0, $izena, $abizena, $helbidea, $herria, $postaKodea, $probintzia, $emaila);

        // Eskaria sortu
        $eskaria = new Eskaria(0, date('Y-m-d H:i:s'), $bezeroa, $saskia->getDetaileak());

        // DB-an gorde
        $id = EskariaDB::insertEskaria($eskaria);

        if ($id > 0) {
            // Saskia hustu
            unset($_SESSION['saskia']);
            $mezu = "Eskaria ondo gorde da! Eskariaren IDa: " . $id;
            $mota = "success";
            include('eskaria_eginda.php');
        } else {
            $mezu = "Arazo bat egon da eskaria gordetzerakoan.";
            $mota = "error";
            include('eskaria_ez_da_egin.php');
        }
    }

} else {
    // Kalkulatu totala inprimakia erakusteko
    $totala = 0;
    foreach ($saskia->getDetaileak() as $detailea) {
        $totala += $detailea->getProduktua()->getPrezioa() * $detailea->getKopurua();
    }
    include('eskaria_inprimakia.php');
}
?>
