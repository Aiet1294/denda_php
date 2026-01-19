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
    <title>Kategoria Aldatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📝 Kategoria Aldatu</h1>
        </div>

        <div class="current-info">
            <h3>📁 Oraingo datuak</h3>
            <p><strong>ID:</strong> <?php echo $kategoria->getId(); ?></p>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($kategoria->getIzena()); ?></p>
            <p><strong>Deskribapena:</strong> <?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>
            <p><strong>Sortze data:</strong> <?php echo $kategoria->getSortzeData(); ?></p>
        </div>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                ❌ <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $kategoria->getId(); ?>">
            
            <div class="form-group">
                <label for="izena">📁 Kategoria Izena *</label>
                <input type="text" id="izena" name="izena"
                    value="<?php echo htmlspecialchars($kategoria->getIzena()); ?>"
                    maxlength="50">
                <span id="izena-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="deskribapena">📝 Deskribapena</label>
                <textarea id="deskribapena" name="deskribapena" 
                        maxlength="255" placeholder="Kategoriaren deskribapena (aukerakoa)"><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></textarea>
                <span id="deskribapena-error" class="field-error" style="display: none;"></span>
            </div>
            
            <div class="form-group">
                <small>* Derrigorrezko eremuak</small>
            </div>
            
            <div class="form-group">
                <label for="id_display">🆔 Kategoria ID</label>
                <input type="text" id="id_display" name="id_display"
                    value="<?php echo $kategoria->getId(); ?>"
                    readonly disabled>
            </div>

            <div class="buttons">
                <button type="submit" name="bidali" class="btn btn-primary">
                    💾 Aldaketak Gorde
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>

</body>

</html>
