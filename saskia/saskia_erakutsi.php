<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GimFit Store® - Saskia</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/katalogoa.css">
    <link rel="stylesheet" href="../css/katalogoa-produktuak.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <link rel="stylesheet" href="../css/saskia.css">
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

        <div class="page-header">
            <h1>🛒 Saskia</h1>
            <p>Zure erosketa saskia</p>
        </div>

        <?php if (isset($mezua)) { ?>
            <div style="color: red; text-align: center; margin-bottom: 20px;">
                <?php echo $mezua; ?>
            </div>
        <?php } ?>

        <?php if (count($saskia->getDetaileak()) > 0) { ?>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Produktua</th>
                        <th>Prezioa</th>
                        <th>Kopurua</th>
                        <th>Guztira</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($saskia->getDetaileak() as $detailea) { ?>
                <tr valign="top">
                    <td><?php echo $detailea->getProduktua()->getIzena() ?></td>
                    <td><?php echo $detailea->getProduktua()->getPrezioa() ?> &euro;</td>
                    <td>
                        <form action="index.php" method="POST">
                            <input type="number" name="kopurua" value="<?php echo $detailea->getKopurua() ?>">
                            ID: <input type="text" name="id" value="<?php echo $detailea->getProduktua()->getId() ?>" readonly style="width: 40px; text-align: center; border: 1px solid #ccc; margin-right: 5px;">
                            <button type="submit" name="eguneratu" class="btn-icon" title="Eguneratu">🔄 Gehitu</button>
                        </form>
                    </td>
                    <td><?php echo $detailea->getProduktua()->getPrezioa() * $detailea->getKopurua() ?> &euro;</td>
                    <td>
                        <form action="index.php" method="POST">
                            ID: <input type="text" name="id" value="<?php echo $detailea->getProduktua()->getId() ?>" readonly style="width: 40px; text-align: center; border: 1px solid #ccc; margin-right: 5px;">
                            <button type="submit" name="ezabatu" class="btn-icon btn-icon-delete" title="Ezabatu">🗑️ Ezabatu</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <a href="../eskaria/index.php" class="btn">Eskaria egin</a>
        <?php } else { ?>
            <div class="empty-state" style="text-align: center; padding: 40px; background: white; border-radius: 8px; margin-top: 20px;">
                <h3>🛒 Saskia hutsik dago</h3>
                <p>Ez duzu produkturik gehitu oraindik.</p>
                <a href="../katalogoa/index.php?vista=produktuak" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Ikusi Produktuak</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
