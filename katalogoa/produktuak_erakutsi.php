
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GimFit Store® - Produktuak</title>
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
                <img src="../img/logo.jpg" alt="logoa">
                <h1 class="logo">GimFit Store®</h1>
            </div>
            <a href="../saskia/index.php" class="nav-btn" style="position: absolute; top: 40px; right: 40px;">🛒 Saskia</a>
            <p class="subtitle">Zure gimnasioko ekipo ezin hobea aurkitu!</p>
            <div class="nav-links">
                <a href="../hasiera/index.php" class="nav-btn">🏠 Hasiera</a>
                <a href="../admin/index.php" class="nav-btn admin">⚙️ Admin Gunea</a>
                <a href="../katalogoa/index.php" class="nav-btn">📂 Katalogoa</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
            </div>
        </header>

        <div class="page-header">
            <h1>🛒 Produktuak</h1>
            <p>Gure dendan eskuragarri dauden produktuak</p>
        </div>

        <?php if (!empty($kategoriak)): ?>
            <?php foreach ($kategoriak as $kategoria): ?>
                <div class="kategoria-section-flex">
                    <div class="kategoria-header">
                        <h2>📂 <?php echo htmlspecialchars($kategoria->getIzena()); ?></h2>
                        <p class="kategoria-description"><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>
                        <p class="produktu-kopurua">
                            <?php echo count($kategoriaProductuak[$kategoria->getId()]); ?> produktu
                        </p>
                    </div>

                    <?php if (!empty($kategoriaProductuak[$kategoria->getId()])): ?>
                        <div class="produktuak-flex">
                            <?php foreach ($kategoriaProductuak[$kategoria->getId()] as $produktua): ?>
                                <div class="produktu-card">
                                    <div class="produktu-detail">
                                        <div class="produktu-image-large">
                                            <?php
                                            $imagePathJpg = "../img/produktuak/" . $produktua->getId() . ".jpg";
                                            $imagePathPng = "../img/produktuak/" . $produktua->getId() . ".png";
                                            
                                            if (file_exists($imagePathJpg)): 
                                                $imagePath = $imagePathJpg;
                                            elseif (file_exists($imagePathPng)):
                                                $imagePath = $imagePathPng;
                                            else:
                                                $imagePath = null;
                                            endif;
                                            
                                            if ($imagePath): 
                                            ?>
                                                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($produktua->getIzena()); ?>">
                                            <?php else: ?>
                                                🏋️‍♂️
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <h3><?php echo htmlspecialchars($produktua->getIzena()); ?></h3>
                                    
                                    <div class="produktu-description">
                                        <strong>Nobedadea:</strong> 
                                        <?php echo $produktua->getNobedadea() ? 'Bai' : 'Ez'; ?><br>
                                        ⚖️ <?php echo $produktua->getPisua(); ?> kg | 📅 <?php echo $produktua->getUrtea(); ?>
                                    </div>

                                    <div class="produktu-price">
                                        <?php if ($produktua->getDeskontua() > 0): ?>
                                            <?php echo number_format($produktua->getPrezioaDeskontuarekin(), 2, ',', '.'); ?>€
                                            <span class="prezio-marratua">
                                                <?php echo number_format($produktua->getPrezioa(), 2, ',', '.'); ?>€
                                            </span>
                                            <span class="deskontua-etiketa">-<?php echo $produktua->getDeskontua(); ?>%</span>
                                        <?php else: ?>
                                            <?php echo number_format($produktua->getPrezioa(), 2, ',', '.'); ?>€
                                        <?php endif; ?>
                                    </div>
                                    <a href="index.php?vista=produktua&id=<?php echo $produktua->getId(); ?>" class="produktu-link">
                                    Xehetasunak
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="ez-produktu">Kategoria honetan ez dago produkturik oraindik.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <h3>😕 Ez dago kategoriarik oraindik</h3>
                <p>Ez dago produktu eskuragarri.</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>