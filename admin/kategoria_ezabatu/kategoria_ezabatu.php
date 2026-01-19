<?php

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}

require_once('../../klaseak/com/leartik/daw24aiet/kategoriak/kategoria_db.php');
use com\leartik\daw24aiet\kategoriak\KategoriaDB;

?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoria Ezabatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🗑️ Kategoria Ezabatu</h1>
        </div>

        <div class="warning">
            <strong>⚠️ Kontuz!</strong> Ekintza hau ezin da desegin. Kategoria ezabatuz gero, bere datu guztiak galdu egingo dira betirako.
            <?php 
            $produktuKopurua = KategoriaDB::getProduktuKopuruaKategorian($kategoria->getId());
            if ($produktuKopurua > 0): 
            ?>
                <br><br><strong>📦 Oharra:</strong> Kategoria honekin batera <?php echo $produktuKopurua; ?> produktu ere ezabatuko dira automatikoki.
            <?php endif; ?>
        </div>

        <div class="info">
            <h3>📁 Ezabatuko den kategoria</h3>
            <p><strong>ID:</strong> <?php echo $kategoria->getId(); ?></p>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($kategoria->getIzena()); ?></p>
            <p><strong>Deskribapena:</strong> <?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>
            <p><strong>Sortze data:</strong> <?php echo $kategoria->getSortzeData(); ?></p>
            
            <?php 
            $produktuKopurua = KategoriaDB::getProduktuKopuruaKategorian($kategoria->getId());
            if ($produktuKopurua > 0): 
            ?>
                <p><strong>🔗 Lotutako produktuak:</strong> 
                    <span style="color: #dc3545; font-weight: bold;"><?php echo $produktuKopurua; ?> produktu</span>
                </p>
            <?php else: ?>
                <p><strong>🔗 Lotutako produktuak:</strong> 
                    <span style="color: #28a745; font-weight: bold;">Bat ere ez</span>
                </p>
            <?php endif; ?>
        </div>
        
        <?php if ($produktuKopurua > 0): ?>
        <div style="background-color: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeaa7; border-radius: 6px; margin-bottom: 20px;">
            <strong>📦 Produktuak:</strong> Kategoria hau ezabatzean, <?php echo $produktuKopurua; ?> produktu ere 
            automatikoki ezabatuko dira (CASCADE konfigurazioa). Ziur al zaude jarraitu nahi duzula?
        </div>
        <?php endif; ?>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                ❌ <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $kategoria->getId(); ?>">
            
            <div class="form-group">
                <label for="berrespena">✍️ Ezabatzeko berrespena *</label>
                <input type="text" id="berrespena" name="berrespena"
                    placeholder="Idatzi 'BAI' kategoria ezabatzeko"
                    class="confirmation-input">
            </div>
            
            <div class="form-group">
                <small>* Derrigorrezko eremua</small>
            </div>

            <div class="buttons">
                <button type="submit" name="ezabatu" class="btn btn-danger">
                    🗑️ Kategoria Ezabatu
                    <?php if ($produktuKopurua > 0): ?>
                        (eta <?php echo $produktuKopurua; ?> produktu)
                    <?php endif; ?>
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>

</body>

</html>
