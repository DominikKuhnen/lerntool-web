<?php
session_start();

if (!isset($_SESSION["kuerzel"])) {
    header("Location: login.php");
    exit();
}

$kuerzel   = $_SESSION["kuerzel"];
$abteilung = $_SESSION["abteilung"];
$rolle     = $_SESSION["rolle"];

$fragen = [];
$tippModus = false;

// Lernmodus bestimmen
if (isset($_GET['modus']) && $_GET['modus'] === 'tipp') {
    $tippModus = true;
    $datei = __DIR__ . '/daten/tipps.csv';
    if (file_exists($datei)) {
        $handle = fopen($datei, "r");
        $kopf = fgetcsv($handle);
        while (($z = fgetcsv($handle)) !== false) {
            if ($z[6] === 'Freigegeben' && $z[7] === $abteilung) {
                $fragen[] = ['id' => $z[0], 'text' => $z[1], 'kat' => $z[2]];
            }
        }
        fclose($handle);
    }
} else {
    $datei = __DIR__ . '/daten/fragen.csv';
    if (file_exists($datei)) {
        $handle = fopen($datei, "r");
        $kopf = fgetcsv($handle);
        while (($z = fgetcsv($handle)) !== false) {
            if ($z[6] === 'Freigegeben' && $z[7] === $abteilung) {
                $fragen[] = [
                    'id' => $z[0], 'frage' => $z[1], 'a' => $z[2], 'b' => $z[3], 'c' => $z[4], 'richtig' => $z[5]
                ];
            }
        }
        fclose($handle);
    }
}

$index = isset($_GET['i']) ? (int)$_GET['i'] : 0;
$gesamt = count($fragen);

if ($index < 0) $index = 0;
if ($index >= $gesamt) $index = $gesamt - 1;

$eintrag = $fragen[$index] ?? null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lernen</title>
    <style>
        body { font-family: sans-serif; margin: 50px; }
        .container { max-width: 700px; margin: auto; }
        h2 { font-size: 22px; }
        .box { background: #f0f0f0; padding: 20px; margin-top: 20px; border-radius: 5px; }
        .navigation { margin-top: 20px; }
        .navigation a {
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .navigation a:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h1>Lernen – <?= $tippModus ? 'Tipps' : 'Fragen' ?></h1>
    <p><strong><?= $index+1 ?>/<?= $gesamt ?></strong></p>

    <?php if ($eintrag): ?>
        <div class="box">
            <?php if ($tippModus): ?>
                <h2><?= htmlspecialchars($eintrag['text']) ?></h2>
                <p><strong>Kategorie:</strong> <?= htmlspecialchars($eintrag['kat']) ?></p>
            <?php else: ?>
                <h2><?= htmlspecialchars($eintrag['frage']) ?></h2>
                <ul>
                    <li>A) <?= htmlspecialchars($eintrag['a']) ?></li>
                    <li>B) <?= htmlspecialchars($eintrag['b']) ?></li>
                    <li>C) <?= htmlspecialchars($eintrag['c']) ?></li>
                </ul>
                <p><em>(Richtige Antwort: <?= htmlspecialchars($eintrag['richtig']) ?>)</em></p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>Keine freigegebenen Einträge für deine Abteilung gefunden.</p>
    <?php endif; ?>

    <div class="navigation">
        <?php if ($index > 0): ?>
            <a href="lernen.php?modus=<?= $tippModus ? 'tipp' : 'frage' ?>&i=<?= $index-1 ?>">Zurück</a>
        <?php endif; ?>

        <?php if ($index < $gesamt - 1): ?>
            <a href="lernen.php?modus=<?= $tippModus ? 'tipp' : 'frage' ?>&i=<?= $index+1 ?>">Weiter</a>
        <?php endif; ?>
    </div>

    <p><a href="start.php">Zurück zur Startseite</a></p>
</div>
</body>
</html>
