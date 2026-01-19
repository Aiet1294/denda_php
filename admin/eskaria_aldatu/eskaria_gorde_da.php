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
    <title>Eskaria Aldatuta - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
    <meta http-equiv="refresh" content="3;url=../">
</head>
<body>
    <div class="container">
        <div class="success-box" style="text-align: center; padding: 50px;">
            <h1>✅ Eskariaren egoera aldatuta!</h1>
            <p>Aldaketak ondo gorde dira.</p>
            <p>3 segundu barru hasierara berbideratuko zara...</p>
            <a href="../" class="btn btn-primary">Itzuli orain</a>
        </div>
    </div>
</body>
</html>
