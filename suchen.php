<?php
session_start();

if (!isset($_SESSION["kuerzel"])) {
    header("Location: login.php");
    exit();
}

$kuerzel   = $_SESSION["kuerzel"];
$abteilung = $_SESSION["abteilung"];
$rolle     = $_SESSION["rolle"];

function filterCsv($file, $typ, $suchbegriff, $kategorie, $status) {
    $ergebnisse = [];
    if (!file_exists($file)) return $ergebnisse;

    $handle = fopen($file, "r");
    $kopf = fgetcsv($handle);
    while (($z = fgetcsv($handle)) !== false) {
        $text = $typ === 'frage' ? $z[1] : $z[1];
        $kat = $typ === 'frage' ? $z[7] : $z[2];
        $stat = $typ === 'frage' ? $z[6] : $z[3];

        if ((empty($suchbegriff) || stripos($text, $suchbegriff) !== false) &&
            (empty($kategorie) || $kat === $kategorie) &&
            (empty($status) || $stat === $status)) {
            $ergebnisse[] = $z;
        }
    }
    fclose($handle);
    return $ergebnisse;
}

$typ = $_GET['typ'] ?? 'frage';
$suchbegriff = $_GET['q'] ?? '';
$kategorie = $_GET['kat'] ?? '';
$status = $_GET['status'] ?? '';
$datei = $typ === 'frage' ? 'daten/fragen.csv' : 'daten/tipps.csv';
$daten = filterCsv($datei, $typ, $suchbegriff, $kategorie, $status);

$title = "Suche";
$styles = <<<CSS
body { font-family: sans-serif; margin: 50px; }
table { border-collapse: collapse; width: 100%; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 8px; }
th { background-color: #eee; }
input, select { padding: 5px; }
.form { margin-bottom: 20px; }
a.button { text-decoration: none; color: #007BFF; }
CSS;

include 'header.php';
?>
    <h1>Suche im Lerntool</h1>
    <form class="form" method="get">
        <label>Typ:
            <select name="typ">
                <option value="frage" <?= $typ === 'frage' ? 'selected' : '' ?>>Fragen</option>
                <option value="tipp" <?= $typ === 'tipp' ? 'selected' : '' ?>>Tipps</option>
            </select>
        </label>
        <label>Stichwort: <input type="text" name="q" value="<?= htmlspecialchars($suchbegriff) ?>"></label>
        <label>Kategorie: <input type="text" name="kat" value="<?= htmlspecialchars($kategorie) ?>"></label>
        <label>Status: <input type="text" name="status" value="<?= htmlspecialchars($status) ?>"></label>
        <button type="submit">Suchen</button>
    </form>

    <?php if (count($daten) > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Text</th>
            <th>Kategorie</th>
            <th>Status</th>
            <th>Aktion</th>
        </tr>
        <?php foreach ($daten as $eintrag): ?>
            <tr>
                <td><?= htmlspecialchars($eintrag[0]) ?></td>
                <td><?= htmlspecialchars($eintrag[1]) ?></td>
                <td><?= $typ === 'frage' ? htmlspecialchars($eintrag[7]) : htmlspecialchars($eintrag[2]) ?></td>
                <td><?= $typ === 'frage' ? htmlspecialchars($eintrag[6]) : htmlspecialchars($eintrag[3]) ?></td>
                <td><a class="button" href="bearbeiten.php?typ=<?= $typ ?>&id=<?= urlencode($eintrag[0]) ?>">Bearbeiten</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Keine Einträge gefunden.</p>
    <?php endif; ?>

    <p><a href="start.php">Zurück zur Startseite</a></p>
<?php include 'footer.php'; ?>
