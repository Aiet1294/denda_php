<?php if (!isset($isAjax) || !$isAjax): ?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .search-container {
            text-align: center;
            margin: 20px 0;
        }
        #bilatzailea {
            padding: 12px 20px;
            width: 60%;
            border-radius: 25px;
            border: 2px solid #ddd;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        #bilatzailea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 2px 10px rgba(52, 152, 219, 0.2);
        }
        .search-wrapper {
            position: relative;
            display: inline-block;
            width: 60%;
        }
        #bilatzailea {
            width: 100%;
        }
        #proposamenak {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 1000;
            display: none;
            overflow: hidden;
            text-align: left;
        }
        .proposamen-item {
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .proposamen-item:hover {
            background-color: #f1f1f1;
            color: #3498db;
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
                <a href="../katalogoa/index.php?vista=produktuak" class="nav-btn">📦 Produktuak</a>
                <a href="../albisteak/index.php" class="nav-btn">📰 Albisteak</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
            </div>
        </header>

        <div class="page-header">
            <h1>🛒 Produktuak</h1>
            <p>Gure dendan eskuragarri dauden produktuak</p>
        </div>

        <div class="search-container">
            <div class="search-wrapper">
                <input type="text" id="bilatzailea" placeholder="🔍 Bilatu produktuak izenaren bidez..." autocomplete="off">
                <div id="proposamenak"></div>
            </div>
        </div>

        <div id="produktuak-zerrenda">
<?php endif; ?>

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
                                                $s3BaseUrl = "https://aetxaburus3.s3.eu-south-2.amazonaws.com/produktuak/";
                                                $imagePathJpg = $s3BaseUrl . $produktua->getId() . ".jpg";
                                                $imagePathPng = $s3BaseUrl . $produktua->getId() . ".png";
                                                ?>
                                                <img src="<?php echo $imagePathJpg; ?>" 
                                                     alt="<?php echo htmlspecialchars($produktua->getIzena()); ?>"
                                                     onerror="if (this.src.endsWith('.jpg')) { this.src = '<?php echo $imagePathPng; ?>'; } else { this.style.display='none'; this.nextElementSibling.style.display='inline'; }">
                                                <span style="display:none; font-size: 3rem;">🏋️‍♂️</span>
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
                    <h3>😕 Ez dago produkturik</h3>
                    <?php if (isset($term) && !empty($term)): ?>
                        <p>Ez da aurkitu "<?php echo htmlspecialchars($term); ?>" bilaketarekin bat datorren produkturik.</p>
                    <?php else: ?>
                        <p>Ez dago produktu eskuragarri.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

<?php if (!isset($isAjax) || !$isAjax): ?>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            
            $('#bilatzailea').on('input', function(){
                var term = $(this).val();
                
                $.ajax({
                    url: 'index.php?vista=ajax_bilatu',
                    method: 'POST',
                    data: {term: term},
                    success: function(response){
                        $('#produktuak-zerrenda').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Errorea (filter): " + status + " " + error);
                    }
                });

                if(term.length > 0) {
                    $.ajax({
                        url: 'index.php?vista=ajax_proposamenak',
                        method: 'POST',
                        data: {term: term},
                        dataType: 'json',
                        success: function(response){
                            var html = '';
                            if(response.length > 0) {
                                $.each(response, function(index, value){
                                    html += '<div class="proposamen-item">' + value + '</div>';
                                });
                                $('#proposamenak').html(html).show();
                            } else {
                                $('#proposamenak').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Errorea (sugestions): " + status + " " + error);
                        }
                    });
                } else {
                    $('#proposamenak').hide();
                }
            });

            $(document).on('click', '.proposamen-item', function(){
                var selectedText = $(this).text();
                $('#bilatzailea').val(selectedText);
                $('#proposamenak').hide();
                
                $('#bilatzailea').trigger('input');
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-wrapper').length) {
                    $('#proposamenak').hide();
                }
            });
        });
    </script>
</body>
</html>
<?php endif; ?>
