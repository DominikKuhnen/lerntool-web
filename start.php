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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="start">
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
