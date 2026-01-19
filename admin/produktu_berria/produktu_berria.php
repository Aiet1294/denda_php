<?php
if (!isset($kategoriak) || !isset($form_data)) {
    die("Errorea: Fitxategi hau ezin da zuzenean kargatu.");
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <title>Produktu berria - Admin</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>➕ Produktu berria gehitu</h1>
            <div>
                <a href="../../index.php" class="logout-link">Hasiera</a>
                <a href="../" class="logout-link">Admin</a>
            </div>
        </div>

        <?php if (!empty($mezua)): ?>
            <div class="alert alert-<?= $mota == 'success' ? 'success' : 'error' ?>">
                ❌ <?= htmlspecialchars($mezua) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="izena">📦 Produktuaren izena *</label>
                <input type="text" id="izena" name="izena" value="<?= htmlspecialchars($form_data['izena']) ?>">
                <span id="izena-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="id_kategoria">📁 Kategoria *</label>
                <select id="id_kategoria" name="id_kategoria">
                    <option value="">-- Aukeratu kategoria --</option>
                    <?php foreach ($kategoriak as $id => $izena): ?>
                        <option value="<?= $id ?>" <?= ($form_data['id_kategoria'] == $id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($izena) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span id="kategoria-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="prezioa">💰 Prezioa (€) *</label>
                <input type="text" id="prezioa" name="prezioa" value="<?= htmlspecialchars($form_data['prezioa']) ?>">
                <span id="prezioa-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="deskontua">🏷️ Deskontua (%)</label>
                <input type="text" id="deskontua" name="deskontua" value="<?= htmlspecialchars($form_data['deskontua']) ?>">
                <span id="deskontua-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="nobedadea">🆕 Nobedadea</label>
                <select id="nobedadea" name="nobedadea">
                    <option value="1" <?= ($form_data['nobedadea'] == 1) ? 'selected' : '' ?>>Bai</option>
                    <option value="0" <?= ($form_data['nobedadea'] == 0) ? 'selected' : '' ?>>Ez</option>
                </select>
                <span id="nobedadea-error" class="field-error" style="display: none;"></span>

                <div class="form-group">
                    <label for="pisua">⚖️ Pisua (kg) *</label>
                    <input type="text" id="pisua" name="pisua" value="<?= htmlspecialchars($form_data['pisua']) ?>">
                    <span id="pisua-error" class="field-error" style="display: none;"></span>
                </div>

                <div class="form-group">
                    <label for="urtea">📅 Urtea</label>
                    <input type="text" id="urtea" name="urtea" value="<?= htmlspecialchars($form_data['urtea']) ?>">
                    <span id="urtea-error" class="field-error" style="display: none;"></span>
                </div>

                <div class="form-group">
                    <small>* Derrigorrezko eremuak</small>
                </div>

                <div class="buttons">
                    <button type="submit" name="gorde" class="btn btn-primary">
                        💾 Produktua gorde
                    </button>
                    <a href="../" class="btn btn-secondary">
                        ❌ Utzi
                    </a>
                </div>
        </form>
    </div>

</body>

</html>