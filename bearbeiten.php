<?php
session_start();
if (!isset($_SESSION['kuerzel'])) {
  header("Location: index.php");
  exit();
}

$kuerzel = $_SESSION['kuerzel'];
$rolle = $_SESSION['rolle'];

// Inhalte laden
$typ = $_GET['typ'] ?? 'frage';
$eintraege = [];

if ($typ === 'frage') {
  $datei = __DIR__ . '/daten/fragen.csv';
  if (file_exists($datei)) {
    $handle = fopen($datei, "r");
    $kopf = fgetcsv($handle);
    while (($z = fgetcsv($handle)) !== false) {
      $eintraege[] = ['id' => $z[0], 'text' => $z[1], 'kat' => $z[6]];
    }
    fclose($handle);
  } else {
    // 🧪 Demo-Daten für Canvas-Vorschau
    $eintraege = [
      ['id' => 'F001', 'text' => 'Was ist ein Relais?', 'kat' => 'Elektro'],
      ['id' => 'F002', 'text' => 'Wie funktioniert ein PNP-Sensor?', 'kat' => 'Sensorik'],
      ['id' => 'F003', 'text' => 'Was ist der Unterschied zwischen SPS und IPC?', 'kat' => 'Steuerung'],
    ];
  }
} else {
  $datei = __DIR__ . '/daten/tipps.csv';
  if (file_exists($datei)) {
    $handle = fopen($datei, "r");
    $kopf = fgetcsv($handle);
    while (($z = fgetcsv($handle)) !== false) {
      $eintraege[] = ['id' => $z[0], 'text' => $z[1], 'kat' => $z[2]];
    }
    fclose($handle);
  } else {
    // 🧪 Demo-Daten für Canvas-Vorschau
    $eintraege = [
      ['id' => 'T101', 'text' => 'Steckerverbindungen regelmäßig auf festen Sitz prüfen.', 'kat' => 'Wartung'],
      ['id' => 'T102', 'text' => 'Fehlerspeicher der SPS nach Stromausfall kontrollieren.', 'kat' => 'SPS'],
      ['id' => 'T103', 'text' => 'Bei Druckluftproblemen zuerst Filter prüfen.', 'kat' => 'Pneumatik'],
    ];
  }
}

// Formular wurde gespeichert
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $typ = $_POST['typ'];
  $id = $_POST['id'];
  $kategorie = $_POST['kategorie'];
  $neuerText = trim($_POST['text']);

  if ($typ === 'frage') {
    $datei = __DIR__ . '/daten/fragen.csv';
    $handle = fopen($datei, "r");
    $kopf = fgetcsv($handle);
    $alle = [];
    while (($zeile = fgetcsv($handle)) !== false) {
      if ($zeile[0] == $id) {
        $zeile[1] = $neuerText;
        $zeile[6] = $kategorie;
        $zeile[7] = 'nein';
        $zeile[12] = $kuerzel;
      }
      $alle[] = $zeile;
    }
    fclose($handle);
    $handle = fopen($datei, "w");
    fputcsv($handle, $kopf);
    foreach ($alle as $zeile) fputcsv($handle, $zeile);
    fclose($handle);
  }

  if ($typ === 'tipp') {
    $datei = __DIR__ . '/daten/tipps.csv';
    $handle = fopen($datei, "r");
    $kopf = fgetcsv($handle);
    $alle = [];
    while (($zeile = fgetcsv($handle)) !== false) {
      if ($zeile[0] == $id) {
        $zeile[1] = $neuerText;
        $zeile[2] = $kategorie;
        $zeile[3] = 'nein';
        $zeile[8] = $kuerzel;
      }
      $alle[] = $zeile;
    }
    fclose($handle);
    $handle = fopen($datei, "w");
    fputcsv($handle, $kopf);
    foreach ($alle as $zeile) fputcsv($handle, $zeile);
    fclose($handle);
  }

  header("Location: bearbeiten.php?typ=$typ&saved=1");
  exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>✏️ Bearbeiten</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      padding: 40px;
      background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
      color: #333;
    }
    h1 {
      margin-bottom: 20px;
      color: #004085;
    }
    .formular {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin-bottom: 30px;
    }
    textarea {
      width: 100%;
      height: 100px;
      margin-bottom: 15px;
      font-family: inherit;
      font-size: 1rem;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    select, input[type="text"] {
      padding: 10px;
      width: 100%;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }
    button {
      padding: 10px 20px;
      background-color: #007bff;
      border: none;
      color: white;
      font-size: 1rem;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }
    button:hover {
      background-color: #0056b3;
    }
    .success {
      color: green;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <h1>✏️ Bearbeiten von Fragen und Tipps</h1>
  <?php if (isset($_GET['saved'])) echo "<p class='success'>✅ Änderung gespeichert</p>"; ?>
  <form class="formular" method="get">
    <label>Typ wählen:</label>
    <select name="typ" onchange="this.form.submit()">
      <option value="frage" <?= $typ==='frage'?'selected':'' ?>>Fragen</option>
      <option value="tipp" <?= $typ==='tipp'?'selected':'' ?>>Tipps</option>
    </select>
  </form>

  <form class="formular" method="post">
    <input type="hidden" name="typ" value="<?= htmlspecialchars($typ) ?>">
    <label>Eintrag auswählen:</label>
    <select name="id" onchange="zeigeDetails(this.value)">
      <option value="">-- bitte wählen --</option>
      <?php foreach ($eintraege as $e): ?>
        <option value="<?= $e['id'] ?>"><?= $e['id'] ?> – <?= htmlspecialchars(mb_strimwidth($e['text'], 0, 60, '...')) ?></option>
      <?php endforeach; ?>
    </select>

    <label>Text:</label>
    <textarea name="text" id="textfeld" required></textarea>

    <label>Kategorie:</label>
    <input type="text" name="kategorie" id="katfeld" required>

    <button type="submit">📂 Speichern</button>
  </form>

  <script>
    const daten = <?= json_encode($eintraege) ?>;
    function zeigeDetails(id) {
      const eintrag = daten.find(e => e.id === id);
      if (eintrag) {
        document.getElementById('textfeld').value = eintrag.text;
        document.getElementById('katfeld').value = eintrag.kat;
      } else {
        document.getElementById('textfeld').value = '';
        document.getElementById('katfeld').value = '';
      }
    }
  </script>
</body>
</html>
