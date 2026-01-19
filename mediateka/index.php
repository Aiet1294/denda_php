<?php
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    require_once '../index.php';

    require_once '../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php';
    use com\leartik\daw24aiet\produktuak\ProduktuaDB;

    $produktuak = ProduktuaDB::selectProduktuak();

    include 'mediateka.php';
?>
