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
    <title>Kategoria Aldatuta - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>
    <div class="container">
        <div class="success-box">
            <h1>✅ Kategoria aldatuta!</h1>
            <p>Kategoriaren datuak arrakastaz eguneratu dira datu-basean.</p>
        </div>
        
        <?php if (isset($kategoria_aldaketak)): ?>
        <div class="changes-box">
            <h3>📝 Aldatutako datuak</h3>
            <div class="change-item">
                <span class="change-label">ID:</span>
                <span class="change-value"><?php echo htmlspecialchars($kategoria_aldaketak['id']); ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Izena:</span>
                <span class="change-value"><?php echo htmlspecialchars($kategoria_aldaketak['izena']); ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Deskribapena:</span>
                <span class="change-value"><?php echo htmlspecialchars($kategoria_aldaketak['deskribapena'] ?: 'Ez da deskribapenik gehitu'); ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Aldaketa data:</span>
                <span class="change-value"><?php echo htmlspecialchars($kategoria_aldaketak['data']); ?></span>
            </div>
        </div>
        <?php endif; ?>
        
        <a href="../" class="btn btn-primary">Administraziora itzuli</a>
    </div>
</body>
</html>
