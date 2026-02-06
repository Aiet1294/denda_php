<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>API Test - Nobedadeak eta Eskaintzak</h2>";

function testUrl($url) {
    echo "<h3>Testing: <a href='$url' target='_blank'>$url</a></h3>";
    $content = @file_get_contents($url);
    
    if ($content === FALSE) {
        $error = error_get_last();
        echo "<p style='color:red'>❌ Error fetching URL: " . $error['message'] . "</p>";
    } else {
        $json = json_decode($content, true);
        if ($json === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "<p style='color:red'>❌ Invalid JSON response</p>";
            echo "<pre>" . htmlspecialchars(substr($content, 0, 500)) . "...</pre>";
        } else {
            $count = is_array($json) ? count($json) : 0;
            echo "<p style='color:green'>✅ JSON OK. Items found: $count</p>";
            if ($count > 0) {
                echo "<pre>" . print_r(array_slice($json, 0, 2), true) . "</pre>";
            } else {
                echo "<p style='color:orange'>⚠️ Empty array returned.</p>";
            }
        }
    }
    echo "<hr>";
}

$baseUrl = "http://localhost/denda_php/api/produktuak/";

testUrl($baseUrl . "?mota=nobedadeak");
testUrl($baseUrl . "?mota=eskaintzak");
testUrl($baseUrl); // All products

?>