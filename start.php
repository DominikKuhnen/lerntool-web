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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Willkommen <?= htmlspecialchars($kuerzel) ?> (<?= htmlspecialchars($rolle) ?> – <?= htmlspecialchars($abteilung) ?>)</h1>

    <div class="card-grid">
        <a class="card card-learn" href="lernen.php">
            <div class="icon">📘</div>
            <div>Lernen</div>
        </a>
        <a class="card card-search" href="suchen.php">
            <div class="icon">🔍</div>
            <div>Suchen</div>
        </a>
        <a class="card card-edit" href="bearbeiten.php">
            <div class="icon">✏️</div>
            <div>Bearbeiten</div>
        </a>
        <a class="card card-add" href="hinzufuegen.php">
            <div class="icon">➕</div>
            <div>Wissen hinzufügen</div>
        </a>
    </div>

    <p><a href="logout.php">Abmelden</a></p>
</div>
</body>
</html>
