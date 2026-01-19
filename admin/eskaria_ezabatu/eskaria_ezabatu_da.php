<?php
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eskaria Ezabatuta - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>
    <div class="container">
        <div class="success-box">
            <h1>✅ Eskaria ezabatuta!</h1>
            <p>Eskaria arrakastaz ezabatu da datu-basetik.</p>
        </div>
        
        <a href="../" class="btn btn-primary">Administraziora itzuli</a>
    </div>
</body>
</html>
