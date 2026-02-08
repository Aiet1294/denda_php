<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasiera - Gimnasio Denda</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/hasiera-produktuak.css">
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
                <a href="index.php" class="nav-btn">🏠 Hasiera</a>
                <a href="../admin/index.php" class="nav-btn admin">⚙️ Admin Gunea</a>
                <a href="../katalogoa/index.php" class="nav-btn">📂 Katalogoa</a>
                <a href="../katalogoa/index.php?vista=produktuak" class="nav-btn">📦 Produktuak</a>
                <a href="../albisteak/index.php" class="nav-btn">📰 Albisteak</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
                <a href="../txatbot/index.php" class="nav-btn">🤖 Txatbota</a>
            </div>
        </header>

        <div class="produktuak-section">
            <h2>🆕 Nobedadeak</h2>
            <?php if (!empty($nobedadeak)): ?>
                <div class="produktuak-grid">
                    <?php foreach ($nobedadeak as $produktua): ?>
                        <div class="produktu-card">
                            <div class="produktu-image">
                                <?php
                                $s3BaseUrl = "https://aetxaburus3.s3.eu-south-2.amazonaws.com/produktuak/";
                                $imagePathJpg = $s3BaseUrl . $produktua['id'] . ".jpg";
                                $imagePathPng = $s3BaseUrl . $produktua['id'] . ".png";
                                ?>
                                <img src="<?php echo $imagePathJpg; ?>" 
                                     alt="<?php echo htmlspecialchars($produktua['izena']); ?>"
                                     onerror="if (this.src.endsWith('.jpg')) { this.src = '<?php echo $imagePathPng; ?>'; } else { this.style.display='none'; this.nextElementSibling.style.display='inline'; }">
                                <span style="display:none; font-size: 3rem;">🏋️‍♂️</span>
                            </div>
                            <h3><?php echo htmlspecialchars($produktua['izena']); ?></h3>
                            <div class="produktu-description">
                                <strong>Nobedadeak:</strong> 
                                <?php echo $produktua['nobedadeak'] ? 'Bai' : 'Ez'; ?><br>
                                ⚖️ <?php echo $produktua['pisua']; ?> kg | 📅 <?php echo $produktua['urtea']; ?>
                            </div>
                            <div class="produktu-price">
                                <?php if ($produktua['deskontua'] > 0): ?>
                                    <?php 
                                    $prezioaDeskontuarekin = $produktua['prezioa'] - ($produktua['prezioa'] * $produktua['deskontua'] / 100);
                                    echo number_format($prezioaDeskontuarekin, 2, ',', '.'); 
                                    ?>€
                                    <span class="prezio-marratua">
                                        <?php echo number_format($produktua['prezioa'], 2, ',', '.'); ?>€
                                    </span>
                                <?php else: ?>
                                    <?php echo number_format($produktua['prezioa'], 2, ',', '.'); ?>€
                                <?php endif; ?>
                            </div>
                            <div class="produktu-stock">
                                <?php if ($produktua['deskontua'] > 0): ?>
                                    <span class="discount-text">-<?php echo $produktua['deskontua']; ?>%</span>
                                <?php else: ?>
                                    <span class="available-text">Eskuragarri</span>
                                <?php endif; ?>
                            </div>
                            <a href="../katalogoa/index.php?vista=produktua&id=<?php echo $produktua['id']; ?>" class="produktu-link">
                                Xehetasunak
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>😕 Ez dago nobedade berririk oraindik</h3>
                    <p>Laster gehiago etorriko dira!</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="produktuak-section">
            <h2>💰 Eskaintzak</h2>
            <?php if (!empty($eskaintzak)): ?>
                <div class="produktuak-grid">
                    <?php foreach ($eskaintzak as $produktua): ?>
                        <div class="produktu-card">
                            <div class="produktu-image">
                                <?php
                                $s3BaseUrl = "https://aetxaburus3.s3.eu-south-2.amazonaws.com/produktuak/";
                                $imagePathJpg = $s3BaseUrl . $produktua['id'] . ".jpg";
                                $imagePathPng = $s3BaseUrl . $produktua['id'] . ".png";
                                ?>
                                <img src="<?php echo $imagePathJpg; ?>" 
                                     alt="<?php echo htmlspecialchars($produktua['izena']); ?>"
                                     onerror="if (this.src.endsWith('.jpg')) { this.src = '<?php echo $imagePathPng; ?>'; } else { this.style.display='none'; this.nextElementSibling.style.display='inline'; }">
                                <span style="display:none; font-size: 3rem;">🏋️‍♂️</span>
                            </div>
                            <h3><?php echo htmlspecialchars($produktua['izena']); ?></h3>
                            <div class="produktu-description">
                                <strong>Nobedadeak:</strong> 
                                <?php echo $produktua['nobedadeak'] ? 'Bai' : 'Ez'; ?><br>
                                ⚖️ <?php echo $produktua['pisua']; ?> kg | 📅 <?php echo $produktua['urtea']; ?>
                            </div>
                            <div class="produktu-price">
                                <?php if ($produktua['deskontua'] > 0): ?>
                                    <?php 
                                    $prezioaDeskontuarekin = $produktua['prezioa'] - ($produktua['prezioa'] * $produktua['deskontua'] / 100);
                                    echo number_format($prezioaDeskontuarekin, 2, ',', '.'); 
                                    ?>€
                                    <span class="prezio-marratua">
                                        <?php echo number_format($produktua['prezioa'], 2, ',', '.'); ?>€
                                    </span>
                                <?php else: ?>
                                    <?php echo number_format($produktua['prezioa'], 2, ',', '.'); ?>€
                                <?php endif; ?>
                            </div>
                            <div class="produktu-stock">
                                <?php if ($produktua['deskontua'] > 0): ?>
                                    <span class="discount-text">-<?php echo $produktua['deskontua']; ?>%</span>
                                <?php else: ?>
                                    <span class="available-text">Eskuragarri</span>
                                <?php endif; ?>
                            </div>
                            <a href="../katalogoa/index.php?vista=produktua&id=<?php echo $produktua['id']; ?>" class="produktu-link">
                                Xehetasunak
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>😕 Ez dago eskaintza berririk oraindik</h3>
                    <p>Egon adi, eskaintza bikainak datoz!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
