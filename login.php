<?php
session_start();

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kuerzel = strtoupper(trim($_POST["kuerzel"]));

    if (($handle = fopen("mitarbeiter2.csv", "r")) !== FALSE) {
        $header = fgetcsv($handle, 1000, ";"); // Header überspringen

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $csvKuerzel = strtoupper(trim($data[2])); // Spalte 3: Kürzel
            $abteilung  = trim($data[6]);             // Spalte 7: Abteilung
            $rolle      = strtoupper(trim($data[8])); // Spalte 9: Rolle

            if ($kuerzel == $csvKuerzel) {
                $_SESSION["kuerzel"]   = $kuerzel;
                $_SESSION["abteilung"] = $abteilung;
                $_SESSION["rolle"]     = $rolle;
                fclose($handle);
                header("Location: start.php");
                exit();
            }
        }

        fclose($handle);
        $loginError = "Ungültiges Kürzel!";
    } else {
        $loginError = "Fehler beim Öffnen der Mitarbeiterdatei.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="login">
    <div class="container">
        <h2>Login</h2>
        <form method="post">
            <label for="kuerzel">Kürzel:</label>
            <input type="text" name="kuerzel" required>
            <input type="submit" value="Login">
            <?php if ($loginError): ?>
                <p class="error"><?= htmlspecialchars($loginError) ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
