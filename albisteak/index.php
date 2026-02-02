<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

require_once '../index.php';


$json_albisteak = file_get_contents("http://localhost/zerbitzari_06_03/apicrud/index.php");
$albisteak = [];
if ($json_albisteak != null) {
    $albisteak = json_decode($json_albisteak, true);
    
    usort($albisteak, function($a, $b) {
        return $b['id'] - $a['id'];
    });

    $albisteak = array_slice($albisteak, 0, 6);
}


include 'albisteak.php';

?>