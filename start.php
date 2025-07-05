<?php
session_start();

if (!isset($_SESSION["kuerzel"])) {
    header("Location: login.php");
    exit();
}

$kuerzel   = $_SESSION["kuerzel"];
$abteilung = $_SESSION["abteilung"];
$rolle     = $_SESSION["rolle"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <style>
        body { font-family: sans-serif; margin: 50px; }
        .container { max-width: 600px; margin: auto; }
        h1 { font-size: 24px; }
        .info { margin: 20px 0; }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
        .logout {
            margin-top: 30px;
            display: block;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Willkommen im Lerntool</h1>
        <div class="info">
            <strong>Kürzel:</strong> <?= htmlspecialchars($kuerzel) ?><br>
            <strong>Abteilung:</strong> <?= htmlspecialchars($abteilung) ?><br>
            <strong>Rolle:</strong> <?= htmlspecialchars($rolle) ?>
        </div>

        <a href="bearbeiten.php" class="button">Wissen bearbeiten</a>
        <!-- Weitere Module können hier folgen -->

        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
