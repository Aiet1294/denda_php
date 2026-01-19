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
    
<body>
    <div class="container">
        <div class="header">
            <h1>🗑️ Eskaria Ezabatu</h1>
        </div>

        <div class="warning">
            <strong>⚠️ Kontuz!</strong> Ekintza hau ezin da desegin. Eskaria ezabatuz gero, bere datu guztiak galdu egingo dira betirako.
        </div>

        <div class="info">
            <h3>📦 Bezeroaren Datuak</h3>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getIzena()); ?></p>
            <p><strong>Abizena:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getAbizena()); ?></p>
            <p><strong>Helbidea:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getHelbidea()); ?></p>
            <p><strong>Herria:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getHerria()); ?></p>
            <p><strong>PostaKodea:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getPostaKodea()); ?></p>
            <p><strong>Probintzia:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getProbintzia()); ?></p>
            <p><strong>Emaila:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getEmaila()); ?></p>
        </div>

        <div class="info">
            <h3>📦 Eskariaren Datuak</h3>
            <p><strong>ID-a:</strong> <?php echo $eskaria->getId(); ?></p>
            <p><strong>Eskari Data:</strong> <?php echo $eskaria->getData(); ?></p>
            <p><strong>Produktuak:</strong></p>
            <ul>
            <?php 
                $totala = 0;
                foreach ($eskaria->getDetaileak() as $detailea) {
                    echo "<li>" . htmlspecialchars($detailea->getProduktua()->getIzena()) . " (x" . $detailea->getKopurua() . ") - " . number_format($detailea->getPrezioa(), 2) . "€</li>";
                    $totala += $detailea->getPrezioa() * $detailea->getKopurua();
                }
            ?>
            </ul>
            <p><strong>Guztira:</strong> <?php echo number_format($totala, 2); ?>€</p>   
        </div>
        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                ❌ <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $eskaria->getId(); ?>">
            
            <div class="form-group">
                <label for="berrespena">✍️ Ezabatzeko berrespena *</label>
                <input type="text" id="berrespena" name="berrespena"
                    placeholder="Idatzi 'BAI' eskaria ezabatzeko"
                    class="confirmation-input">
                <small style="color: #856404;">Eskaria ezabatzeko, idatzi "BAI" (maiuskuletan) eremuan.</small>
            </div>
            
            <div class="form-group">
                <small>* Derrigorrezko eremua</small>
            </div>

            <div class="buttons">
                <button type="submit" name="ezabatu" class="btn btn-danger">
                    🗑️ Eskaria Ezabatu
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>

</body>
</html>