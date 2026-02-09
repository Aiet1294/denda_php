<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GimFit Store® - Eskaria</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/hasiera-produktuak.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <style>
        .eskaria-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            background-color: white;
        }
        .success {
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
        .btn-home {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
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
                <a href="../albisteak/index.php" class="nav-btn">📰 Albisteak</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
                <a href="../txatbot/index.php" class="nav-btn">🤖 Txatbota</a>
            </div>
        </header>

        <div class="eskaria-container">
            <?php if ($mota == "success") { ?>
                <h1 class="success">✅ Eskaria Burututa!</h1>
                <p><?php echo $mezu; ?></p>
                <p>Eskerrik asko zure erosketagatik.</p>
            <?php } else { ?>
                <h1 class="error">❌ Errorea</h1>
                <p><?php echo $mezu; ?></p>
                <a href="index.php" style="color: #007bff;">Saiatu berriro</a>
            <?php } ?>
            
            <a href="../hasiera/index.php" class="btn-home">🏠 Itzuli Hasierara</a>
        </div>
    </div>
</body>
</html>
