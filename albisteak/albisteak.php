<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albisteak - GimFit Store</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/hasiera-produktuak.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <style>
        .albiste-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: 1px solid #e1e1e1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .albiste-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        .albiste-titulua {
            font-size: 1.4rem;
            color: #2c3e50;
            margin-bottom: 12px;
            font-weight: 700;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            display: inline-block;
        }

        .albiste-data {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 16px;
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .albiste-edukia {
            color: #555;
            line-height: 1.6;
            flex-grow: 1;
            font-size: 1rem;
        }

        .albisteak-zerrenda {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
    </style>
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
                <a href="index.php" class="nav-btn active">📰 Albisteak</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
            </div>
        </header>

        <div class="produktuak-section">
            <h2>📰 Azken Albisteak</h2>
            
            <?php if (!empty($albisteak)): ?>
                <div class="albisteak-zerrenda">
                    <?php foreach ($albisteak as $albiste): ?>
                        <article class="albiste-card">
                            <div style="font-size: 0.8rem; color: #888; margin-bottom: 5px;">
                                ID: <?= htmlspecialchars($albiste['id'] ?? '') ?>
                            </div>

                            <h3 class="albiste-titulua">
                                <?= htmlspecialchars($albiste['izenburua'] ?? '') ?>
                            </h3>
                            
                            <div class="albiste-laburpena" style="margin-bottom: 15px; font-weight: 500; font-style: italic; color: #555;">
                                <?= nl2br(htmlspecialchars($albiste['laburpena'] ?? '')) ?>
                            </div>
                            
                            <div class="albiste-edukia">
                                <?= nl2br(htmlspecialchars($albiste['xehetasunak'] ?? '')) ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state" style="text-align: center; padding: 40px; background: #f9f9f9; border-radius: 8px;">
                    <h3>😕 Ez da albisterik aurkitu</h3>
                    <p>Momentu honetan ez dago albisterik eskuragarri. Mesedez, saiatu beranduago.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
