<?php
require_once '../index.php';
require_once '../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php';
require_once '../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php';

use com\leartik\daw24aiet\kategoriak\KategoriaDB;
use com\leartik\daw24aiet\produktuak\ProduktuaDB;

$vista = isset($_GET['vista']) ? $_GET['vista'] : 'hasiera';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$kategoriak = [];
$kategoria = null;
$produktuak = [];
$produktua = null;
$kategoriaProductuak = [];
$eskaintzak = [];
$errorMezua = '';

switch ($vista) {
    case 'kategoriak':
        $kategoriak = KategoriaDB::selectKategoriak();
        
        foreach ($kategoriak as $kat) {
            $katProduktuak = ProduktuaDB::selectProduktuakKategoriarenArabera($kat->getId());
            $kategoriaProductuak[$kat->getId()] = [
                'kopurua' => count($katProduktuak),
                'produktuak' => array_slice($katProduktuak, 0, 3)
            ];
        }
        include 'kategoriak_erakutsi.php';
        break;

    case 'kategoria':
        if ($id <= 0) {
            include 'kategoria_id_baliogabea.php';
            exit;
        }
        
        $kategoria = KategoriaDB::selectKategoria($id);
        if (!$kategoria) {
            include 'kategoria_id_baliogabea.php';
            exit;
        }
        
        $produktuak = ProduktuaDB::selectProduktuakKategoriarenArabera($id);
        $eskaintzak = array_filter($produktuak, function($p) { return $p->getDeskontua() > 0; });
        
        include 'kategoria_erakutsi.php';
        break;

    case 'produktuak':
        $kategoriak = KategoriaDB::selectKategoriak();
        
        foreach ($kategoriak as $kat) {
            $katProduktuak = ProduktuaDB::selectProduktuakKategoriarenArabera($kat->getId());
            if (!empty($katProduktuak)) {
                $kategoriaProductuak[$kat->getId()] = $katProduktuak;
            }
        }
        
        $kategoriakFiltratuak = [];
        foreach ($kategoriak as $k) {
            if (isset($kategoriaProductuak[$k->getId()])) {
                $kategoriakFiltratuak[] = $k;
            }
        }
        $kategoriak = $kategoriakFiltratuak;
        
        include 'produktuak_erakutsi.php';
        break;

    case 'ajax_bilatu':
        $term = isset($_POST['term']) ? $_POST['term'] : '';
        
        $kategoriak = KategoriaDB::selectKategoriak();
        $kategoriaProductuak = [];

        foreach ($kategoriak as $kat) {
            if (!empty($term)) {
                $katProduktuak = ProduktuaDB::selectProduktuakByKategoriaAndTerm($kat->getId(), $term);
            } else {
                $katProduktuak = ProduktuaDB::selectProduktuakKategoriarenArabera($kat->getId());
            }
            
            if (!empty($katProduktuak)) {
                $kategoriaProductuak[$kat->getId()] = $katProduktuak;
            }
        }

        $kategoriakFiltratuak = [];
        foreach ($kategoriak as $k) {
            if (isset($kategoriaProductuak[$k->getId()])) {
                $kategoriakFiltratuak[] = $k;
            }
        }
        $kategoriak = $kategoriakFiltratuak;
        
        $isAjax = true;
        include 'produktuak_erakutsi.php';
        break;

    case 'ajax_proposamenak':
        header('Content-Type: application/json');
        $term = isset($_POST['term']) ? $_POST['term'] : '';
        $names = [];

        if (!empty($term)) {
            $produktuak = ProduktuaDB::selectProduktuakByTerm($term);
            foreach ($produktuak as $p) {
                $names[] = $p->getIzena();
            }
        }
        echo json_encode($names);
        break;

    case 'produktua':
        if ($id <= 0) {
            include 'produktua_id_baliogabea.php';
            exit;
        }
        
        $produktua = ProduktuaDB::selectProduktu($id);
        if (!$produktua) {
            include 'produktua_id_baliogabea.php';
            exit;
        }
        
        $kategoria = KategoriaDB::selectKategoria($produktua->getIdKategoria());
        
        include 'produktua_erakutsi.php';
        break;

    default:
        $kategoriak = KategoriaDB::selectKategoriak();
        
        if (file_exists('hasiera.php')) {
            include 'hasiera.php';
        } else {
            header('Location: index.php?vista=kategoriak');
            exit;
        }
        break;
}
?>
