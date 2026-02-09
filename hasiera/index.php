<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

require_once '../index.php';
require_once '../klaseak/com/leartik/daw24aiet/produktuak/produktua_db.php';

use com\leartik\daw24aiet\produktuak\ProduktuaDB;

function produktuaToArray($obj) {
    return [
        'id' => $obj->getId(),
        'izena' => $obj->getIzena(),
        'prezioa' => $obj->getPrezioa(),
        'deskontua' => $obj->getDeskontua(),
        'nobedadeak' => $obj->getNobedadea(),
        'pisua' => $obj->getPisua(),
        'urtea' => $obj->getUrtea()
    ];
}

// Nobedadeak eskuratu zuzenean DB-tik
$nobedadeakObjects = ProduktuaDB::selectNobedadeak(6);
$nobedadeak = array_map('produktuaToArray', $nobedadeakObjects);

// Eskaintzak eskuratu zuzenean DB-tik
$eskaintzakObjects = ProduktuaDB::selectEskaintzak(6);
$eskaintzak = array_map('produktuaToArray', $eskaintzakObjects);

include 'hasiera.php';


?>