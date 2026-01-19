<?php

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header('Location: ../');
    exit;
}

?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktua Ezabatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🗑️ Produktua Ezabatu</h1>
        </div>

        <div class="warning">
            <strong>⚠️ Kontuz!</strong> Ekintza hau ezin da desegin. Produktua ezabatuz gero, bere datu guztiak galdu egingo dira betirako.
        </div>

        <div class="info">
            <h3>📦 Ezabatuko den produktua</h3>
            <p><strong>ID:</strong> <?php echo $produktua->getId(); ?></p>
            <p><strong>Kategoria ID:</strong> <?php echo $produktua->getIdKategoria(); ?></p>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($produktua->getIzena()); ?></p>
            <p><strong>Prezioa:</strong> <?php echo number_format($produktua->getPrezioa(), 2); ?>€</p>
            <p><strong>Deskontua:</strong> <?php echo $produktua->getDeskontua(); ?>%</p>
            <p><strong>Nobedadea:</strong> <?php echo $produktua->getNobedadea() == '1' ? 'Bai' : 'Ez'; ?></p>
            <p><strong>Pisua:</strong> <?php echo $produktua->getPisua(); ?> kg</p>
            <p><strong>Urtea:</strong> <?php echo $produktua->getUrtea() ? $produktua->getUrtea() : '<em>Ez da zehaztu</em>'; ?></p>
        </div>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                ❌ <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $produktua->getId(); ?>">
            
            <div class="form-group">
                <label for="berrespena">✍️ Ezabatzeko berrespena *</label>
                <input type="text" id="berrespena" name="berrespena"
                    placeholder="Idatzi 'BAI' produktua ezabatzeko"
                    class="confirmation-input">
                <small style="color: #856404;">Produktua ezabatzeko, idatzi "BAI" (maiuskuletan) eremuan.</small>
            </div>
            
            <div class="form-group">
                <small>* Derrigorrezko eremua</small>
            </div>

            <div class="buttons">
                <button type="submit" name="ezabatu" class="btn btn-danger">
                    🗑️ Produktua Ezabatu
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>

</body>

</html>