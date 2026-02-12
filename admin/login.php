<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bezero Denda - Administrazioa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #333;
            margin: 0;
            font-size: 28px;
        }

        .login-header p {
            color: #666;
            margin: 10px 0 0 0;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .credentials {
            background-color: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #0c5aa6;
        }

        .credentials strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🔐 Administrazioa</h1>
            <p>Sartu zure kredentzialekin</p>
        </div>

        <div class="credentials">
            <strong>Proba kredentialak:</strong>
            Erabiltzailea: <strong>admin</strong><br>
            Pasahitza: <strong>admin</strong>
        </div>

        <?php if (!empty($mezua)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($mezua); ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="erabiltzailea">Erabiltzailea</label>
                <input type="text" name="erabiltzailea" id="erabiltzailea">
            </div>

            <div class="form-group">
                <label for="pasahitza">Pasahitza</label>
                <input type="password" name="pasahitza" id="pasahitza">
            </div>

            <div class="form-group">
                <label>Ebatzi eragiketa: <?php echo $captcha_tetsua; ?> = ?</label>
                <input type="number" name="captcha" required class="form-control" placeholder="Emaitza">
            </div>

            <button type="submit" name="sartu" class="submit-btn">
                Sartu administrazioan
            </button>
        </form>

        <div class="back-link">
            <a href="../">← Dendara itzuli</a>
        </div>
    </div>
</body>

</html>