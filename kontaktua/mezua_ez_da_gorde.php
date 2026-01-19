<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktua - Gimnasio Denda</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <!-- CSS Modular -->
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="../css/mezua.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <script type="text/javascript" src="api.js"></script>
</head>

<body>
        <main>
            <p>
                <?php 
                if (isset($errore_testua)) {
                    echo htmlspecialchars($errore_testua);
                } else {
                    echo "Mezua ez da gorde. Barkatu, errore bat gertatu da. Mesedez, saiatu berriro.";
                }
                ?>
            </p>
            <table cellspacing="5" cellpadding="5" border="0">
                <tr>
                    <td>Izena:</td>
                    <td><?php echo isset($_POST['izena']) ? htmlspecialchars($_POST['izena']) : ''; ?></td>
                </tr>
                <tr>
                    <td>E-mail helbidea:</td>
                    <td><?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?></td>
                </tr>
                <tr>
                    <td>Mezuaren testua:</td>
                    <td><?php echo isset($_POST['mezua']) ? htmlspecialchars($_POST['mezua']) : ''; ?></td>
                </tr>
            </table>
            <form action=".." method="get">
                <p>
                    <input type="button" id="berriz_saiatu" name="berriz_saiatu" value="Berriz Saiatu" onClick="MezuaBidali()"></td>
                    <input type="button" id="utzi" name="utzi" value="Utzi" onClick="location.href='../'"></td>
                </p>
            </form>
        </main>
    </div>
</body>

</html>
