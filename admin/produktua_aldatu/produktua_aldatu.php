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
    <title>Produktua Aldatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📝 Produktua Aldatu</h1>
        </div>

        <div class="current-info">
            <h3>📦 Oraingo datuak</h3>
            <p><strong>ID:</strong> <?php echo $produktua->getId(); ?></p>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($produktua->getIzena()); ?></p>
            <p><strong>Prezioa:</strong> <?php echo number_format($produktua->getPrezioa(), 2); ?>€</p>
            <p><strong>Kategoria ID:</strong> <?php echo $produktua->getIdKategoria(); ?></p>
            <p><strong>Deskontua:</strong> <?php echo $produktua->getDeskontua(); ?>%</p>
            <p><strong>Nobedadea:</strong> <?php echo $produktua->getNobedadea() == '1' ? 'Bai' : 'Ez'; ?></p>
            <p><strong>Pisua:</strong> <?php echo $produktua->getPisua(); ?> kg</p>
            <p><strong>Urtea:</strong> <?php echo $produktua->getUrtea(); ?></p>
        </div>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                ❌ <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $produktua->getId(); ?>">
            
            <div class="form-group">
                <label for="izena">📦 Produktu Izena *</label>
                <input type="text" id="izena" name="izena"
                    value="<?php echo htmlspecialchars($produktua->getIzena()); ?>"
                    maxlength="100">
                <span id="izena-error" class="field-error" style="display: none;"></span>
            </div>



            <div class="form-group">
                <label for="prezioa">💰 Prezioa (€) *</label>
                <input type="text" id="prezioa" name="prezioa"
                    value="<?php echo $produktua->getPrezioa(); ?>">
                <span id="prezioa-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="kategoria_id">📁 Kategoria *</label>
                <select id="kategoria_id" name="kategoria_id">
                    <option value="">-- Aukeratu kategoria --</option>
                    <?php foreach ($kategoriak as $kategoria): ?>
                        <option value="<?php echo $kategoria->getId(); ?>"
                            <?php echo ($kategoria->getId() == $produktua->getIdKategoria()) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($kategoria->getIzena()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span id="kategoria-error" class="field-error" style="display: none;"></span>
            </div>
            <div class="form-group">
                <label for="deskontua">🏷️ Deskontua (%)</label>
                <input type="text" id="deskontua" name="deskontua"
                    value="<?php echo $produktua->getDeskontua(); ?>">
                <span id="deskontua-error" class="field-error" style="display: none;"></span>
            </div>
            <div class="form-group">
                <label for="nobedadea">🆕 Nobedadea</label>
                <select id="nobedadea" name="nobedadea">
                    <option value="1" <?php echo ($produktua->getNobedadea() == 1) ? 'selected' : ''; ?>>Bai</option>
                    <option value="0" <?php echo ($produktua->getNobedadea() == 0) ? 'selected' : ''; ?>>Ez</option>
                </select>
                <span id="nobedadea-error" class="field-error" style="display: none;"></span>
            </div>
            <div class="form-group">
                <label for="pisua">⚖️ Pisua (kg) *</label>
                <input type="text" id="pisua" name="pisua"
                    value="<?php echo $produktua->getPisua(); ?>">
                <span id="pisua-error" class="field-error" style="display: none;"></span>
            </div>
            <div class="form-group">
                <label for="urtea">📅 Urtea</label>
                <input type="text" id="urtea" name="urtea"
                    value="<?php echo $produktua->getUrtea(); ?>">
                <span id="urtea-error" class="field-error" style="display: none;"></span>
            </div>
            <div class="form-group">
                <small>* Derrigorrezko eremuak</small>
            </div>
            
            <div class="form-group">
                <label for="id_display">🆔 Produktu ID</label>
                <input type="text" id="id_display" name="id_display"
                    value="<?php echo $produktua->getId(); ?>"
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