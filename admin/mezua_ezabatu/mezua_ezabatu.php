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
    <title>Mezua Ezabatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Mezua Ezabatu</h1>
        </div>

        <div class="warning">
            Ziur zaude <strong><?php echo htmlspecialchars($mezua->getIzena()); ?></strong>-(r)en mezua ezabatu nahi duzula? Ekintza hau ezin da desegin.
        </div>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?php echo $mezua->getIdMezua(); ?>">

            <div class="form-group">
                <label for="berrespena">Idatzi "BAI" ezabatzeko:</label>
                <input type="text" id="berrespena" name="berrespena" required placeholder="BAI">
            </div>

            <div class="buttons">
                <button type="submit" name="ezabatu" class="btn btn-danger">Ezabatu</button>
                <a href="../index.php" class="btn btn-secondary">Utzi</a>
            </div>
        </form>
    </div>
</body>

</html>
