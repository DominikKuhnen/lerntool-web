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
    <title>Startmenü</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f7f7f7;
            margin: 50px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
        }
        .button {
            display: block;
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Willkommen <?= htmlspecialchars($kuerzel) ?> (<?= htmlspecialchars($rolle) ?> – <?= htmlspecialchars($abteilung) ?>)</h1>

    <a class="button" href="lernen.php">📘 Lernen</a>
    <a class="button" href="suchen.php">🔍 Suchen</a>
    <a class="button" href="bearbeiten.php">✏️ Bearbeiten</a>
    <a class="button" href="hinzufuegen.php">➕ Wissen hinzufügen</a>

    <p><a href="logout.php">Abmelden</a></p>
</div>
</body>
</html>
