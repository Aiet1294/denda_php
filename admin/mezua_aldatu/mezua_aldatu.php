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
    <title>Mezua Aldatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Mezua Aldatu</h1>
        </div>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <div class="info" style="margin-bottom: 20px;">
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($mezua->getIzena()); ?></p>
            <p><strong>Emaila:</strong> <?php echo htmlspecialchars($mezua->getEmail()); ?></p>
            <p><strong>Mezua:</strong></p>
            <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; border: 1px solid #ddd;">
                <?php echo nl2br(htmlspecialchars($mezua->getMezua())); ?>
            </div>
        </div>

        <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?php echo $mezua->getIdMezua(); ?>">

            <div class="form-group checkbox-group" style="margin-top: 20px; padding: 10px; background-color: #f1f1f1; border-radius: 5px;">
                <label for="erantzunda" style="font-weight: bold; display: flex; align-items: center; cursor: pointer;">
                    Erantzunda:
                    <input type="checkbox" id="erantzunda" name="erantzunda" <?php echo $mezua->getErantzunda() ? 'checked' : ''; ?> style="margin-left: 10px; width: 20px; height: 20px;">
                </label>
            </div>

            <div class="buttons" style="margin-top: 20px;">
                <button type="submit" name="bidali" class="btn btn-primary">Gorde Aldaketak</button>
                <a href="../index.php" class="btn btn-secondary">Utzi</a>
            </div>
        </form>
    </div>
</body>

</html>
