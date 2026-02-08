<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txatbota - Gimnasio Denda</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <!-- Main styles -->
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/hasiera-produktuak.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    
    <!-- Chatbot specific styles -->
    <style>
        #chat-main-wrapper {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        #chat-container {
            width: 100%;
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        #chat-container h2 {
            color: #333;
            margin-top: 0;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        #txataren-mezuak {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background: #fafafa;
            border-radius: 4px;
        }
        
        #txataren-mezuak p {
            margin: 8px 0;
            padding: 10px;
            border-radius: 8px;
            line-height: 1.5;
        }
        
        .user-msg { 
            background-color: #e3f2fd; 
            text-align: right; 
            margin-left: 20%;
            border-bottom-right-radius: 0 !important;
        }
        
        .bot-msg { 
            background-color: #f1f8e9; 
            text-align: left; 
            margin-right: 20%;
            border-bottom-left-radius: 0 !important;
        }

        .chat-input-area {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        textarea#erabiltzailearen-mezua {
            flex-grow: 1;
            height: 50px;
            resize: none;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }

        input#bidali {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0 25px;
            height: 52px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        input#bidali:hover { 
            background-color: #0056b3; 
        }

        /* Nav active state for Txatbota */
        .nav-links a[href*="txatbot"] {
            border-bottom: 2px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header copied from hasiera.php -->
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

        <!-- Main Content (Chatbot) -->
        <div id="chat-main-wrapper">
            <div id="chat-container">
                <h2>💬 Denda Laguntzailea</h2>
                
                <div id="txataren-mezuak">
                    <?php
                    if (isset($_SESSION['txataren_mezuak'])) {
                        foreach ($_SESSION['txataren_mezuak'] as $msg) {
                            $class = ($msg['role'] === 'user') ? 'user-msg' : 'bot-msg';
                            $roleName = ($msg['role'] === 'user') ? 'Zuk' : 'Bot-ak';
                            echo "<p class='$class'><strong>$roleName:</strong> " . htmlspecialchars($msg['content']) . "</p>";
                        }
                    } else {
                        echo "<p class='bot-msg'><strong>Bot-ak:</strong> Kaixo! Zerbaitetan lagun zaitzaket? Galdetu produktuei buruz libreki.</p>";
                    }
                    ?>
                </div>
                
                <div class="chat-input-area">
                    <textarea id="erabiltzailearen-mezua" placeholder="Idatzi zure galdera hemen... (Adib: 'Erakutsi 20€ baino gutxiagoko kamisetak')"></textarea>
                    <input type="button" id="bidali" value="Bidali" onClick="mezuaBidali()">
                </div>
            </div>
        </div>

    </div>

    <script>
    function mezuaBidali() {
        var mezuaInput = document.getElementById('erabiltzailearen-mezua');
        var mezua = mezuaInput.value;
        
        if (mezua.trim() == "") {
            alert("Mezuaren testua falta da");
            return;
        }
        
        var mezuakDiv = document.getElementById('txataren-mezuak');
        
        // Erakutsi erabiltzailearen mezua berehala
        var erabiltzaileaP = document.createElement('p');
        erabiltzaileaP.className = 'user-msg';
        erabiltzaileaP.innerHTML = "<strong>Zuk:</strong> " + mezua.replace(/</g, "&lt;").replace(/>/g, "&gt;");
        mezuakDiv.appendChild(erabiltzaileaP);
        
        // Garbitu inputa
        mezuaInput.value = '';
        mezuakDiv.scrollTop = mezuakDiv.scrollHeight;

        // Loading adierazlea
        var loadingP = document.createElement('p');
        loadingP.id = 'loading-msg';
        loadingP.className = 'bot-msg';
        loadingP.innerHTML = "<em>Pentsatzen...</em>";
        mezuakDiv.appendChild(loadingP);
        mezuakDiv.scrollTop = mezuakDiv.scrollHeight;
        
        var httpRequest = new XMLHttpRequest();
        httpRequest.open("POST", "index.php", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send("erabiltzailearen_mezua=" + encodeURIComponent(mezua));
        
        httpRequest.onreadystatechange = function() {
            if (this.readyState == 4) {
                // Kendu loading mezua
                var loadingEl = document.getElementById('loading-msg');
                if (loadingEl) loadingEl.remove();

                if (this.status == 200) {
                    var botP = document.createElement('p');
                    botP.className = 'bot-msg';
                    // Response is plain text/markdown from txatbot.php
                    botP.innerHTML = "<strong>Bot-ak:</strong> " + this.responseText.replace(/\n/g, "<br>");
                    mezuakDiv.appendChild(botP);
                } else {
                    var errorP = document.createElement('p');
                    errorP.style.color = 'red';
                    errorP.innerHTML = "Errorea komunikazioan: " + this.status;
                    mezuakDiv.appendChild(errorP);
                }
                mezuakDiv.scrollTop = mezuakDiv.scrollHeight;
            }
        };
    }
    
    // Enter tekla sakatzean bidali
    document.getElementById('erabiltzailearen-mezua').addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            mezuaBidali();
        }
    });

    // Auto-scroll to bottom on load
    var mezuakDiv = document.getElementById('txataren-mezuak');
    mezuakDiv.scrollTop = mezuakDiv.scrollHeight;
    </script>
</body>
</html>
