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
    <title>Errorea - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>
    <div class="container">
        <div class="error-box" style="text-align: center; padding: 50px; color: red;">
            <h1>❌ Errorea!</h1>
            <p>Ezin izan da eskaria eguneratu.</p>
            <a href="index.php?id=<?php echo $id; ?>" class="btn btn-secondary">Saiatu berriro</a>
            <a href="../" class="btn btn-primary">Itzuli zerrendara</a>
        </div>
    </div>
</body>
</html>
