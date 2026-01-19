<?php

// Administrazio egoera egiaztatu
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
    <title>Kategoria Aldatu - Bezero Denda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            margin: 20px 0;
        }

        .current-info {
            background-color: #e7f3ff;
            padding: 15px;
            border: 1px solid #b3d9ff;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .current-info h3 {
            margin: 0 0 10px 0;
            color: #0066cc;
        }

        .current-info p {
            margin: 5px 0;
            color: #333;
        }

        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .input-error {
            border-color: #dc3545 !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>📝 Kategoria Aldatu</h1>

        <div class="current-info">
            <h3>📁 Oraingo datuak</h3>
            <p><strong>ID:</strong> <?php echo $kategoria->getId(); ?></p>
            <p><strong>Izena:</strong> <?php echo htmlspecialchars($kategoria->getIzena()); ?></p>
            <p><strong>Deskribapena:</strong> <?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></p>
            <p><strong>Sortze data:</strong> <?php echo $kategoria->getSortzeData(); ?></p>
        </div>

        <?php if (isset($errore_mezua)): ?>
            <div class="error">
                ❌ <?php echo htmlspecialchars($errore_mezua); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            
            <input type="hidden" name="id" value="<?php echo $kategoria->getId(); ?>">
            
            <div class="form-group">
                <label for="izena">📁 Kategoria Izena *</label>
                <input type="text" id="izena" name="izena"
                    value="<?php echo htmlspecialchars($kategoria->getIzena()); ?>"
                    maxlength="50">
                <span id="izena-error" class="field-error" style="display: none;"></span>
            </div>

            <div class="form-group">
                <label for="deskribapena">📝 Deskribapena</label>
                <textarea id="deskribapena" name="deskribapena" 
                        maxlength="255" placeholder="Kategoriaren deskribapena (aukerakoa)"><?php echo htmlspecialchars($kategoria->getDeskribapena()); ?></textarea>
                <span id="deskribapena-error" class="field-error" style="display: none;"></span>
            </div>
            
            <div class="form-group">
                <small>* Derrigorrezko eremuak</small>
            </div>
            
            <div class="form-group">
                <label for="id_display">🆔 Kategoria ID</label>
                <input type="text" id="id_display" name="id_display"
                    value="<?php echo $kategoria->getId(); ?>"
                    readonly disabled>
            </div>

            <div class="buttons">
                <button type="submit" name="bidali" class="btn btn-primary">
                    💾 Aldaketak Gorde
                </button>
                <a href="../" class="btn btn-secondary">
                    ❌ Utzi
                </a>
            </div>
        </form>
    </div>

</body>

</html>
