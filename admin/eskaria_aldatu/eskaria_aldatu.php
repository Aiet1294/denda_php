<?php
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] != "admin") {
    header("Location: ../");
    exit();
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eskaria Aldatu - Bezero Denda</title>
    <link rel="stylesheet" href="../css/admin-style.css">
    <style>
        .product-list {
            margin-top: 10px;
            border-top: 1px solid #eee;
        }
        .product-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .bidalita-section {
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid #c8e6c9;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            font-size: 1.1em;
            font-weight: bold;
            color: #2e7d32;
            cursor: pointer;
        }
        .checkbox-label input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✏️ Eskariaren Egoera Aldatu</h1>
        </div>

        <div class="info">
            <h3>👤 Bezeroaren Datuak</h3>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getIzena()); ?></p>
            <p><strong>Abizena:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getAbizena()); ?></p>
            <p><strong>Helbidea:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getHelbidea()); ?></p>
            <p><strong>Herria:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getHerria()); ?></p>
            <p><strong>PostaKodea:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getPostaKodea()); ?></p>
            <p><strong>Probintzia:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getProbintzia()); ?></p>
            <p><strong>Emaila:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getEmaila()); ?></p>
        </div>

        <div class="info">
            <h3>📦 Eskariaren Xehetasunak</h3>
            <p><strong>Eskariaren ID-a:</strong> <?php echo $eskaria->getId(); ?></p>
            <p><strong>Data:</strong> <?php echo $eskaria->getData(); ?></p>
            
            <div class="product-list">
                <h3>Produktuak:</h3>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left;">Produktua</th>
                            <th style="padding: 10px; text-align: right;">Prezioa</th>
                            <th style="padding: 10px; text-align: center;">Kopurua</th>
                            <th style="padding: 10px; text-align: right;">Azpitotala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totala = 0;
                        foreach ($eskaria->getDetaileak() as $detailea): 
                            $azpitotala = $detailea->getPrezioa() * $detailea->getKopurua();
                            $totala += $azpitotala;
                        ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 10px;"><?php echo htmlspecialchars($detailea->getProduktua()->getIzena()); ?></td>
                                <td style="padding: 10px; text-align: right;"><?php echo number_format($detailea->getPrezioa(), 2); ?> €</td>
                                <td style="padding: 10px; text-align: center;"><?php echo $detailea->getKopurua(); ?></td>
                                <td style="padding: 10px; text-align: right;"><?php echo number_format($azpitotala, 2); ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div style="margin-top: 15px; text-align: right;">
                <h3>Guztira: <?php echo number_format($totala, 2); ?> €</h3>
            </div>
        </div>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $eskaria->getId(); ?>">
            
            <div class="bidalita-section">
                <h3>Eskariaren egoera:</h3>
                <label class="checkbox-label" style="font-weight: normal; color: #333;">
                    <input type="checkbox" name="balidatu" value="1" <?php echo ($eskaria->getBalidatu() == 1) ? 'checked' : ''; ?>>
                    Eskaria Bidali
                </label>
            </div>

            <div class="buttons">
                <button type="submit" name="gorde" class="btn btn-primary">
                    💾 Gorde Aldaketak
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>
</body>
</html>