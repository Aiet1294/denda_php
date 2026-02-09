<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GimFit Store® - Kategoriak</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/katalogoa.css">
    <link rel="stylesheet" href="../css/katalogoa-produktuak.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
</head>

<body>
    <div class="container">
        <header style="position: relative;">
            <div class="logo-link">
                <img src="https://aetxaburus3.s3.eu-south-2.amazonaws.com/logo.jpg" alt="logoa">
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
                <a href="../txatbot/index.php" class="nav-btn">🤖 Txatbota</a>
            </div>
        </header>

        <div class="page-header">
            <h1>📂 Kategoriak</h1>
            <p>Aukeratu zure intereseko kategoria</p>
        </div>

        <?php if (!empty($kategoriak)): ?>
            <div class="kategoriak-flex">
                <?php foreach ($kategoriak as $kategoria): ?>
                    <div class="kategoria-card">
                        <div class="kategoria-header-section">
                            <div class="kategoriak-icon">
                                <?php
                                $s3BaseUrl = "https://aetxaburus3.s3.eu-south-2.amazonaws.com/kategoriak/";
                                $imagePathJpg = $s3BaseUrl . $kategoria->getId() . ".jpg";
                                $imagePathPng = $s3BaseUrl . $kategoria->getId() . ".png";
                                ?>
                                <img src="<?php echo $imagePathJpg; ?>" 
                                     alt="<?php echo htmlspecialchars($kategoria->getIzena()); ?>"
                                     onerror="if (this.src.endsWith('.jpg')) { this.src = '<?php echo $imagePathPng; ?>'; } else { this.style.display='none'; this.nextElementSibling.style.display='inline'; }">
                                <span style="display:none; font-size: 3rem;">📂</span>
                            </div>
                            <div class="kategoria-info">
                                <h2><?php echo htmlspecialchars($kategoria->getIzena()); ?></h2>
                                <div class="produktu-count">
                                    <?php echo $kategoriaProductuak[$kategoria->getId()]['kopurua']; ?> produktu
                                </div>
                            </div>
                        </div>

                        <div class="kategoria-description">
                            <?php echo htmlspecialchars($kategoria->getDeskribapena()); ?>
                        </div>

                        <?php if (!empty($kategoriaProductuak[$kategoria->getId()]['produktuak'])): ?>
                            <div class="produktuak-aurreikuspena">
                                <h3>🏆 Produktu ezagunak</h3>
                                <div class="produktuak-zerrenda">
                                    <?php foreach ($kategoriaProductuak[$kategoria->getId()]['produktuak'] as $produktua): ?>
                                        <div class="produktu-item">
                                            <span class="produktu-name"><?php echo htmlspecialchars($produktua->getIzena()); ?></span>
                                            <span class="produktu-price">
                                                <?php 
                                                if ($produktua->getDeskontua() > 0) {
                                                    echo number_format($produktua->getPrezioaDeskontuarekin(), 2, ',', '.') . '€';
                                                } else {
                                                    echo number_format($produktua->getPrezioa(), 2, ',', '.') . '€';
                                                } 
                                                ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <a href="index.php?vista=kategoria&id=<?php echo $kategoria->getId(); ?>" class="kategoria-ikusi-btn">
                            Kategoria ikusi (<?php echo $kategoriaProductuak[$kategoria->getId()]['kopurua']; ?> produktu)
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3>😕 Ez dago kategoriarik oraindik</h3>
                <p>Administratzaileak kategoriak gehitu behar ditu.</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
