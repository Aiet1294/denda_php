<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GimFit Store® - Eskaria Osatu</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/hasiera-produktuak.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <style>
        .eskaria-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-submit {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            text-align: center;
        }
        .btn-submit:hover {
            background-color: #218838;
        }
        .order-summary {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            text-align: right;
            margin-top: 10px;
        }
    </style>
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

        <div class="eskaria-container">
            <div class="nav">
                <a href="../saskia/index.php">⬅️ Itzuli Saskira</a>
            </div>

            <h1>📋 Eskariaren Datuak</h1>
            
            <?php if (isset($erroreak) && count($erroreak) > 0): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb;">
                    <ul>
                        <?php foreach ($erroreak as $errorea): ?>
                            <p><?php echo $errorea; ?></p>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="order-summary">
                <h3>Eskaeraren Laburpena</h3>
                <p>Produktuak: <?php echo $saskia->getDetaileKopurua(); ?></p>
                <p>Eskatutako Produktuen Izena(k):<br>
                <?php foreach ($saskia->getDetaileak() as $detailea) 
                    { echo "• " . $detailea->getProduktua()->getIzena() . 
                    "<br>"; } ?>
                </p>
                <div class="total-price">Guztira: <?php echo $totala; ?> €</div>
            </div>

            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="izena">Izena:</label>
                    <input type="text" id="izena" name="izena" value="<?php echo isset($izena) ? htmlspecialchars($izena) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="abizena">Abizena:</label>
                    <input type="text" id="abizena" name="abizena" value="<?php echo isset($abizena) ? htmlspecialchars($abizena) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="emaila">Emaila:</label>
                    <input type="text" id="emaila" name="emaila" value="<?php echo isset($emaila) ? htmlspecialchars($emaila) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="helbidea">Helbidea:</label>
                    <input type="text" id="helbidea" name="helbidea" value="<?php echo isset($helbidea) ? htmlspecialchars($helbidea) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="herria">Herria:</label>
                    <input type="text" id="herria" name="herria" value="<?php echo isset($herria) ? htmlspecialchars($herria) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="postaKodea">Posta Kodea:</label>
                    <input type="text" id="postaKodea" name="postaKodea" value="<?php echo isset($postaKodea) ? htmlspecialchars($postaKodea) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="probintzia">Probintzia:</label>
                    <input type="text" id="probintzia" name="probintzia" value="<?php echo isset($probintzia) ? htmlspecialchars($probintzia) : ''; ?>">
                </div>
                
                <button type="submit" name="eskaria_amaitu" class="btn-submit">✅ Eskaria Amaitu</button>
            </form>
        </div>
    </div>
</body>
</html>
