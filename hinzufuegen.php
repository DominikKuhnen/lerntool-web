<?php
session_start();
if (!isset($_SESSION["kuerzel"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Wissen hinzufügen</title>
    <style>
        body { font-family: sans-serif; background: #f0f0f0; padding: 50px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        input, textarea, select { width: 100%; margin-bottom: 15px; padding: 10px; font-size: 16px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        button { padding: 10px 20px; font-size: 16px; }
    </style>
</head>
<body>
<div class="container">
    <h2>➕ Wissen hinzufügen</h2>
    <form method="post" action="speichere_wissen.php">
        <label>Kategorie:</label>
        <input type="text" name="kategorie" required>

        <label>Frage:</label>
        <textarea name="frage" required></textarea>

        <label>Antwort A:</label>
        <input type="text" name="a" required>

        <label>Antwort B:</label>
        <input type="text" name="b" required>

        <label>Antwort C:</label>
        <input type="text" name="c" required>

        <label>Richtige Antwort:</label>
        <select name="richtig" required>
            <option value="">Bitte wählen</option>
            <option value="A">Antwort A</option>
            <option value="B">Antwort B</option>
            <option value="C">Antwort C</option>
        </select>

        <button type="submit">Speichern</button>
    </form>
    <br>
    <a href="start.php">⬅️ Zurück zum Menü</a>
</div>
</body>
</html>
