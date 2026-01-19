<?php
if (!isset($kategoria)) {
    header("Location: index.php?vista=kategoriak");
    exit;
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $kategoria ? htmlspecialchars($kategoria->getIzena()) : 'Kategoria'; ?> - GimFit Store®</title>
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

        <div class="katalogoa-header">
            <h1>
                <div class="kategoria-icon">
                    <?php
                    $imagePathJpg = "../img/kategoriak/" . $kategoria->getId() . ".jpg";
                    $imagePathPng = "../img/kategoriak/" . $kategoria->getId() . ".png";
                    
                    if (file_exists($imagePathJpg)): 
                        $imagePath = $imagePathJpg;
                    elseif (file_exists($imagePathPng)):
                        $imagePath = $imagePathPng;
                    else:
                        $imagePath = null;
                    endif;
                    
                    if ($imagePath): 
                    ?>
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($kategoria->getIzena()); ?>">
                    <?php else: ?>
                        📂
                    <?php endif; ?>
                </div>
                <?php echo htmlspecialchars($kategoria->getIzena()); ?>
            </h1>
            <p><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>
        </div>

        <div class="back-buttons">
            <a href="index.php?vista=kategoriak" class="kategoriak-botoia">📂 Kategoria guztiak</a>
        </div>

        <div class="kategoria-estatistikak">
            <div class="stat-item">
                <div class="stat-number"><?php echo count($produktuak); ?></div>
                <div class="stat-label">Produktu guztira</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <?php echo count($eskaintzak); ?>
                </div>
                <div class="stat-label">Eskaintzetan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    <?php echo date('Y-m-d', strtotime($kategoria->getSortzeData())); ?>
                </div>
                <div class="stat-label">Sortze data</div>
            </div>
        </div>

        <div class="products-section">
            <h2>🛍️ Kategoriako produktuak</h2>
            
            <?php if (!empty($produktuak)): ?>
                <div class="produktuak-flex">
                    <?php foreach ($produktuak as $produktua): ?>
                        <div class="produktu-card">
                            <div class="produktu-image">
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
                            
                            <h3><?php echo htmlspecialchars($produktua->getIzena()); ?></h3>
                            
                            <div class="produktu-description">
                                <strong>Nobedadea:</strong> 
                                <?php echo $produktua->getNobedadea() ? 'Bai' : 'Ez'; ?>
                            </div>

                            <div class="product-specs">
                                <div class="spec-item">
                                    <span>⚖️</span> <?php echo $produktua->getPisua(); ?> kg
                                </div>
                                <div class="spec-item">
                                    <span>📅</span> <?php echo $produktua->getUrtea(); ?>
                                </div>
                            </div>

                            <div class="product-price">
                                <?php if ($produktua->getDeskontua() > 0): ?>
                                    <span class="prezio-oraingoa"><?php echo number_format($produktua->getPrezioaDeskontuarekin(), 2, ',', '.'); ?>€</span>
                                    <span class="prezio-originala"><?php echo number_format($produktua->getPrezioa(), 2, ',', '.'); ?>€</span>
                                    <span class="deskontua-etiketa">-<?php echo $produktua->getDeskontua(); ?>%</span>
                                <?php else: ?>
                                    <span class="prezio-oraingoa"><?php echo number_format($produktua->getPrezioa(), 2, ',', '.'); ?>€</span>
                                <?php endif; ?>
                            </div>

                            <a href="index.php?vista=produktua&id=<?php echo $produktua->getId(); ?>" class="produktu-link">
                                Xehetasunak ikusi
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>😕 Ez dago produkturik kategoria honetan</h3>
                    <p>Laster produktu gehiago gehituko dira kategoria honetan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
