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
    <title>Produktua Aldatu Da - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>
    <div class="container">
        <div class="success-box">
        <h1>✅ Produktua Ondo Aldatu Da</h1>
        <p>Produktua zuzen aldatu da datu-basean.</p>
        </div>
        
        <?php if (isset($produktu_aldaketak)): ?>
        <div class="changes-box">
            <h3>📝 Aldatutako datuak</h3>
            <div class="change-item">
                <span class="change-label">ID:</span>
                <span class="change-value"><?php echo htmlspecialchars($produktu_aldaketak['id']); ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Izena:</span>
                <span class="change-value"><?php echo htmlspecialchars($produktu_aldaketak['izena']); ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Kategoria:</span>
                <span class="change-value"><?php echo htmlspecialchars($produktu_aldaketak['kategoria_izena']); ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Prezioa:</span>
                <span class="change-value"><?php echo number_format($produktu_aldaketak['prezioa'], 2); ?>€</span>
            </div>
            <div class="change-item">
                <span class="change-label">Deskontua:</span>
                <span class="change-value"><?php echo $produktu_aldaketak['deskontua']; ?>%</span>
            </div>
            <div class="change-item">
                <span class="change-label">Nobedadea:</span>
                <span class="change-value">
                    <?php echo $produktu_aldaketak['nobedadea'] == '1' ? 'Bai' : 'Ez'; ?>
                </span>
            </div>
            <div class="change-item">
                <span class="change-label">Pisua:</span>
                <span class="change-value"><?php echo number_format($produktu_aldaketak['pisua'], 2); ?>kg</span>
            </div>
            <div class="change-item">
                <span class="change-label">Urtea:</span>
                <span class="change-value"><?php echo $produktu_aldaketak['urtea'] ?: 'Ez da zehaztu'; ?></span>
            </div>
            <div class="change-item">
                <span class="change-label">Aldaketa data:</span>
                <span class="change-value"><?php echo htmlspecialchars($produktu_aldaketak['data']); ?></span>
            </div>
        </div>
        <?php endif; ?>
        
        <p>Orain produktuen zerrenda eguneratuta ikusi dezakezu.</p>
        
        <a href="../" class="btn btn-primary">🏠 Itzuli adminera</a>
    </div>
</body>
</html>