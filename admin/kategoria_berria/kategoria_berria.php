<?php
if (!isset($form_data)) {
    die("Errorea: Fitxategi hau ezin da zuzenean kargatu.");
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <title>Kategoria berria - Admin</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>➕ Kategoria berria gehitu</h1>
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
                <label for="izena">📁 Kategoria izena *</label>
                <input type="text" id="izena" name="izena"
                    value="<?= htmlspecialchars($form_data['izena']) ?>"
                    maxlength="50">
                <span id="izena-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="deskribapena">📝 Deskribapena</label>
                <textarea id="deskribapena" name="deskribapena"
                    maxlength="255" placeholder="Kategoriaren deskribapena (aukerakoa)"><?= htmlspecialchars($form_data['deskribapena']) ?></textarea>
                <span id="deskribapena-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <small>* Derrigorrezko eremuak</small>
            </div>

            <div class="buttons">
                <button type="submit" name="gorde" class="btn btn-primary">
                    💾 Kategoria gorde
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>

</body>

</html>