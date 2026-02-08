<?php
if (!isset($produktua)) {
    header("Location: index.php?vista=produktuak");
    exit;
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produktua ? htmlspecialchars($produktua->getIzena()) : 'Produktua'; ?> - GimFit Store®</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/produktua.css">
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
            </div>
        </header>

        
        <div class="row g-4">
            
            <div class="col-lg-6">
                <div class="produktu-image-container">
                    <?php
                    $s3BaseUrl = "https://aetxaburus3.s3.eu-south-2.amazonaws.com/produktuak/";
                    $imagePathJpg = $s3BaseUrl . $produktua->getId() . ".jpg";
                    $imagePathPng = $s3BaseUrl . $produktua->getId() . ".png";
                    ?>
                    <img src="<?php echo $imagePathJpg; ?>" 
                        alt="<?php echo htmlspecialchars($produktua->getIzena()); ?>" 
                        class="img-fluid"
                        onerror="if (this.src.endsWith('.jpg')) { this.src = '<?php echo $imagePathPng; ?>'; } else { this.style.display='none'; this.nextElementSibling.style.display='block'; }">
                    <div class="produktu-placeholder" style="display:none;">
                        🏋️‍♂️
                    </div>
                </div>
            </div>

            
            <div class="col-lg-6">
                
                <h1 class="product-title display-5"><?php echo htmlspecialchars($produktua->getIzena()); ?></h1>
                
                <?php if ($kategoria): ?>
                    <div class="mb-3">
                        <span class="product-category-badge">
                            <i class="bi bi-folder"></i> <?php echo htmlspecialchars($kategoria->getIzena()); ?>
                        </span>
                    </div>
                <?php endif; ?>

                
                <div class="mb-3">
                    <?php if ($produktua->getNobedadea()): ?>
                        <span class="novedad-badge">
                            <i class="bi bi-star-fill"></i> Nobedadea
                        </span>
                    <?php endif; ?>
                </div>

                
                <div class="price-display mb-4">
                    <?php if ($produktua->getDeskontua() > 0): ?>
                        <div class="price-current">
                            <?php echo number_format($produktua->getPrezioaDeskontuarekin(), 2, ',', '.'); ?>€
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="price-original me-2">
                                <?php echo number_format($produktua->getPrezioa(), 2, ',', '.'); ?>€
                            </span>
                            <span class="discount-badge">
                                -<?php echo $produktua->getDeskontua(); ?>%
                            </span>
                        </div>
                        <div class="savings-info mt-2">
                            <i class="bi bi-piggy-bank"></i> 
                            Aurreztu: <?php echo number_format($produktua->getAurreztutakoDirua(), 2, ',', '.'); ?>€
                        </div>
                    <?php else: ?>
                        <div class="price-current">
                            <?php echo number_format($produktua->getPrezioa(), 2, ',', '.'); ?>€
                        </div>
                    <?php endif; ?>
                </div>

                <form action="../saskia/index.php" method="POST" class="mt-4 mb-4">
                    <div class="d-flex flex-column align-items-center mb-3">
                        <label for="prod-id" class="form-label mb-1 fw-bold text-muted" style="font-size: 0.8rem;">PRODUKTUAREN AID (ID)</label>
                        <input type="text" id="prod-id" name="id" class="form-control text-center bg-light" value="<?php echo $produktua->getId(); ?>" readonly style="width: 80px; font-family: monospace; border: 1px solid #dee2e6;">
                    </div>
                
                    <div class="d-flex gap-2 align-items-center justify-content-center">
                        <div class="input-group" style="width: 150px;">
                            <span class="input-group-text">Kopurua</span>
                            <input type="number" name="kopurua" class="form-control" value="1" min="1" required>
                        </div>
                        <button type="submit" name="gehitu" class="btn btn-primary btn-lg">
                            <i class="bi bi-cart-plus"></i> Saskira gehitu
                        </button>
                    </div>
                </form>

                
                <div class="spec-card card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-clipboard-data"></i> Espezifikazioak
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="spec-item d-flex justify-content-between align-items-center py-3">
                            <span class="fw-semibold text-muted">
                                <i class="bi bi-weight"></i> Pisua:
                            </span>
                            <span class="text-dark fw-medium"><?php echo $produktua->getPisua(); ?> kg</span>
                        </div>
                        <div class="spec-item d-flex justify-content-between align-items-center py-3">
                            <span class="fw-semibold text-muted">
                                <i class="bi bi-calendar"></i> Urtea:
                            </span>
                            <span class="text-dark fw-medium"><?php echo $produktua->getUrtea(); ?></span>
                        </div>
                        <div class="spec-item d-flex justify-content-between align-items-center py-3">
                            <span class="fw-semibold text-muted">
                                <i class="bi bi-clock"></i> Sortze data:
                            </span>
                            <span class="text-dark fw-medium"><?php echo date('Y-m-d', strtotime($produktua->getSortzeData())); ?></span>
                        </div>
                        <?php if ($produktua->getDeskontua() > 0): ?>
                            <div class="spec-item d-flex justify-content-between align-items-center py-3">
                                <span class="fw-semibold text-muted">
                                    <i class="bi bi-percent"></i> Deskontua:
                                </span>
                                <span class="text-danger fw-bold"><?php echo $produktua->getDeskontua(); ?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row mt-5">
            <div class="col-12">
                <?php if ($kategoria): ?>
                    <a href="index.php?vista=kategoria&id=<?php echo $kategoria->getId(); ?>" class="back-button">
                        <i class="bi bi-arrow-left"></i>
                        <?php echo htmlspecialchars($kategoria->getIzena()); ?> kategoria ikusi
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
