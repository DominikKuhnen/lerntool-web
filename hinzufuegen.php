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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="hinzufuegen">
codex/replace-div-containers-with-html5-tags
    <main>
        <section>
            <h2>➕ Wissen hinzufügen</h2>
            <form method="post" action="speichere_wissen.php">
                <label>Kategorie:</label>
                <input type="text" name="kategorie" required>
<div class="container">
    <h2>➕ Wissen hinzufügen</h2>
    <form method="post" action="speichere_wissen.php">
        <label>Kategorie:</label>
        <input type="text" name="kategorie" required>
main

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
        </section>
        <nav aria-label="Zurück">
            <a href="start.php">⬅️ Zurück zum Menü</a>
        </nav>
    </main>
</body>
</html>
