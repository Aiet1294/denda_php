<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezero Denda - Administrazioa</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📊 Administrazio gunea</h1>
            <a href="logout.php" class="logout-link">Irten</a>
        </div>

        <!-- Kategorien sekzioa -->
        <div class="section">
            <h2>Kategoriak</h2>
            <?php if (isset($kategoriak) && count($kategoriak) > 0): ?>
                <ul>
                    <?php foreach ($kategoriak as $kategoria): ?>
                        <li>
                            <strong>Izena:</strong> <?php echo htmlspecialchars($kategoria->getIzena()); ?>
                            <span class="action-links">
                                [<a href="kategoria_aldatu/?id=<?php echo $kategoria->getId(); ?>" class="edit">Aldatu</a>]
                                [<a href="kategoria_ezabatu/?id=<?php echo $kategoria->getId(); ?>" class="delete">Ezabatu</a>]
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Ez dago kategoriarik.</p>
            <?php endif; ?>
            <div class="actions">
                <button type="button" name="sartu" onclick="location.href='kategoria_berria/'" class="btn btn-success">Kategoria berria gehitu</button>
            </div>
        </div>

        <!-- Banatzailea -->
        <hr class="separator">

        <!-- Produktuen sekzioa -->
        <div class="section">
            <h2>Produktuak</h2>
            <?php if (isset($produktuak) && count($produktuak) > 0): ?>
                <ul>
                    <?php foreach ($produktuak as $produktua): ?>
                        <li>
                            <strong>Izena:</strong> <?php echo htmlspecialchars($produktua->getIzena()); ?>
                            <span class="action-links">
                                [<a href="produktua_aldatu/?id=<?php echo $produktua->getId(); ?>" class="edit">Aldatu</a>]
                                [<a href="produktua_ezabatu/?id=<?php echo $produktua->getId(); ?>" class="delete">Ezabatu</a>]
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Ez dago produkturik.</p>
            <?php endif; ?>
            <div class="actions">
                <button type="button" name="sartu" onclick="location.href='produktu_berria/'" class="btn btn-success">Produktu berria gehitu</button>
            </div>
        </div>

        <hr class="separator">

        <!-- Mezuen sekzioa -->
        <div class="section">
            <h2>Mezuak</h2>
            <?php if (isset($mezuak) && count($mezuak) > 0): ?>
                <ul>
                    <?php foreach ($mezuak as $mezua): ?>
                        <li>
                            <strong>Sortze-data:</strong> <?php echo htmlspecialchars($mezua->getSortzeData()); ?>
                            <strong>Izena:</strong> <?php echo htmlspecialchars($mezua->getIzena()); ?>
                            <strong>Erantzunda:</strong> <?php echo $mezua->getErantzunda() ? 'Bai' : 'Ez'; ?>
                            <span class="action-links">
                                [<a href="mezua_aldatu/?id=<?php echo $mezua->getIdMezua(); ?>" class="edit">Aldatu</a>]
                                [<a href="mezua_ezabatu/?id=<?php echo $mezua->getIdMezua(); ?>" class="delete">Ezabatu</a>]
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Ez dago mezurik.</p>
            <?php endif; ?>
        </div>

        <hr class="separator">

        <div class="section">
            <h2>Eskariak</h2>
            <?php if (isset($eskariak) && count($eskariak) > 0): ?>
                <ul>
                    <?php foreach ($eskariak as $eskaria): ?>
                        <li>
                            <strong>ID:</strong> <?php echo htmlspecialchars($eskaria->getId()); ?>
                            <strong>Bezeroa:</strong> <?php echo htmlspecialchars($eskaria->getBezeroa()->getIzena() . " " . $eskaria->getBezeroa()->getAbizena()); ?>
                            <strong>Data:</strong> <?php echo htmlspecialchars($eskaria->getData()); ?>
                            <strong>Egoera:</strong> <?php echo $eskaria->getBalidatu() ? 'Bidalita' : 'Prestatzen'; ?>
                            <span class="action-links">
                                [<a href="eskaria_aldatu/?id=<?php echo $eskaria->getId(); ?>" class="edit">Aldatu</a>]
                                [<a href="eskaria_ezabatu/?id=<?php echo $eskaria->getId(); ?>" class="delete">Ezabatu</a>]
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Ez dago eskariarik.</p>
            <?php endif; ?>
        </div>
        <div class="footer">
            <p>&copy; 2023 Bezero Denda. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>