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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>➕ Wissen hinzufügen</h2>
    <form method="post" action="speichere_wissen.php">
        <label>Kategorie:</label>
        <input class="form-control" type="text" name="kategorie" required>

        <label>Frage:</label>
        <textarea class="form-control" name="frage" required></textarea>

        <label>Antwort A:</label>
        <input class="form-control" type="text" name="a" required>

        <label>Antwort B:</label>
        <input class="form-control" type="text" name="b" required>

        <label>Antwort C:</label>
        <input class="form-control" type="text" name="c" required>

        <label>Richtige Antwort:</label>
        <select class="form-control" name="richtig" required>
            <option value="">Bitte wählen</option>
            <option value="A">Antwort A</option>
            <option value="B">Antwort B</option>
            <option value="C">Antwort C</option>
        </select>

        <button class="btn btn-primary" type="submit">Speichern</button>
    </form>
    <br>
    <a href="start.php">⬅️ Zurück zum Menü</a>
</div>
</body>
</html>
