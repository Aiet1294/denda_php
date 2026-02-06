<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktua - Gimnasio Denda</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <!-- CSS Modular -->
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/kontaktua.css">
    <link rel="stylesheet" href="../css/mezua.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <script type="text/javascript" src="api.js?v=<?php echo time(); ?>"></script>
</head>

<body>
    <div class="container">
        <header style="position: relative;">
            <div class="logo-link">
                <img src="../img/logo.jpg" alt="logoa">
                <h1 class="logo">GimFit Store®</h1>
            </div>
            <a href="../saskia/index.php" class="nav-btn" style="position: absolute; top: 40px; right: 40px;">🛒 Saskia</a>
            <p class="subtitle">Zure gimnasioko ekipo ezin hobea aurkitu!</p>
            <div class="nav-links">
                <a href="../hasiera/index.php" class="nav-btn">🏠 Hasiera</a>
                <a href="../admin/index.php" class="nav-btn admin">⚙️ Admin Gunea</a>
                <a href="../katalogoa/index.php" class="nav-btn">📂 Katalogoa</a>
                <a href="../katalogoa/index.php?vista=produktuak" class="nav-btn">📦 Produktuak</a>
                <a href="../albisteak/index.php" class="nav-btn">📰 Albisteak</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
            </div>
        </header>

        <main>
            <div class="page-header">
                <h1>Kontaktua</h1>
                <p>Idatzi mezu bat zerbait behar izan eskero</p>
            </div>
            
            <?php if (isset($erroreak) && count($erroreak) > 0): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb;">
                    <ul>
                        <?php foreach ($erroreak as $errorea): ?>
                            <p><?php echo $errorea; ?></p>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div id="mezua-edukia" class="form-container">
                <form action="index.php" method="POST">
                    <p>
                        <label for="izena">Izena</label>
                        <input type="text" id="izena" name="izena" size="50" maxlength="50" value="<?php echo isset($izena) ? htmlspecialchars($izena) : ''; ?>">
                    </p>
                    <p>
                        <label for="email">E-mail helbidea</label>
                        <input type="text" id="email" name="email" size="50" maxlength="50" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                    </p>
                    <p>
                        <label for="mezua">Mezuaren testua</label>
                        <textarea id="mezua" name="mezua"><?php echo isset($mezua_testua) ? htmlspecialchars($mezua_testua) : ''; ?></textarea>
                    </p>
                    <p>
                        <input type="button" id="bidali" name="bidali" value="Bidali" onclick="mezuaBidali()">
                        <input type="button" id="utzi" name="utzi" value="Utzi" onClick="location.href='../'">
                    </p>
                </form>
            </div>
        </main>
    </div>
</body>

</html>