<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

require_once '../index.php';

// Nobedadeak eskuratu API-tik
$json_nobedadeak = file_get_contents("http://localhost/denda_php/api/produktuak/?mota=nobedadeak");
$nobedadeak = [];
if ($json_nobedadeak != null) {
    $nobedadeak = json_decode($json_nobedadeak, true);
    // Lehenengo 6ak bakarrik hartu
    $nobedadeak = array_slice($nobedadeak, 0, 6);
}

// Eskaintzak eskuratu API-tik
$json_eskaintzak = file_get_contents("http://localhost/denda_php/api/produktuak/?mota=eskaintzak");
$eskaintzak = [];
if ($json_eskaintzak != null) {
    $eskaintzak = json_decode($json_eskaintzak, true);
    // Lehenengo 6ak bakarrik hartu
    $eskaintzak = array_slice($eskaintzak, 0, 6);
}

include 'hasiera.php';

?>