<?php
session_start();

// E-Mail des angemeldeten Nutzers ermitteln
$email = '';
if (!empty($_SERVER['AUTH_USER'])) {
    $email = $_SERVER['AUTH_USER'];
} elseif (!empty($_SERVER['REMOTE_USER'])) {
    $email = $_SERVER['REMOTE_USER'];
} elseif (!empty($_SERVER['LOGON_USER'])) {
    $email = $_SERVER['LOGON_USER'];
}

// Vorname aus der E-Mail extrahieren (Format: Vorname.Nachname@...)
$firstName = '';
if (!empty($email)) {
    $localPart = explode('@', $email)[0];
    $nameParts = explode('.', $localPart);
    $firstName = ucfirst(strtolower($nameParts[0] ?? ''));

    // Speichere den Vornamen als Kürzel in der Session
    $_SESSION['kuerzel'] = $firstName;
}

// Weiterleitung nach Klick auf den Login-Button
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: start.php');
    exit();
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
      <main>
        <?php if ($firstName): ?>
            <p>Hallo <?= htmlspecialchars($firstName) ?>!</p>
            <p><?= htmlspecialchars($email) ?></p>
        <?php else: ?>
            <p>Keine E-Mail gefunden.</p>
        <?php endif; ?>

        <form method="post">
            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>
