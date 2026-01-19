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
            <p>Mezua gorde da. Eskerrik asko zurekin harremanetan jartzeagatik!</p>
            <table cellspacing="5" cellpadding="5" border="0">
                <tr>
                    <td>Izena:</td>
                    <td><?php echo htmlspecialchars($_POST['izena']); ?></td>
                </tr>
                <tr>
                    <td>E-mail helbidea:</td>
                    <td><?php echo htmlspecialchars($_POST['email']); ?></td>
                </tr>
                <tr>
                    <td>Mezuaren testua:</td>
                    <td><?php echo htmlspecialchars($_POST['mezua']); ?></td>
                </tr>
            </table>
            <form action=".." method="get">
                <p>
                    <input type="button" id="mezua_berria" name="mezua_berria" value="Mezu Berria" onClick="location.href='index.php'">
                    <input type="button" id="itxi" name="itxi" value="Itxi" onClick="location.href='../'">
                </p>
            </form>
        </main>
    </div>
</body>

</html>
