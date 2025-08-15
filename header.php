<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Lerntool' ?></title>
    <style>
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #eee;
            padding: 10px;
        }
        nav a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }
        nav a.active {
            font-weight: bold;
        }
        .user {
            font-size: 0.9em;
        }
    </style>
<?php if (!empty($styles)): ?>
    <style>
<?= $styles ?>
    </style>
<?php endif; ?>
</head>
<body>
<header>
    <div class="logo">Lerntool</div>
    <nav>
        <a href="start.php" class="<?= $current === 'start.php' ? 'active' : '' ?>">Start</a>
        <a href="lernen.php" class="<?= $current === 'lernen.php' ? 'active' : '' ?>">Lernen</a>
        <a href="suchen.php" class="<?= $current === 'suchen.php' ? 'active' : '' ?>">Suchen</a>
        <a href="bearbeiten.php" class="<?= $current === 'bearbeiten.php' ? 'active' : '' ?>">Bearbeiten</a>
        <a href="hinzufuegen.php" class="<?= $current === 'hinzufuegen.php' ? 'active' : '' ?>">Hinzufügen</a>
    </nav>
    <div class="user">
        <?= isset($_SESSION['kuerzel']) ? htmlspecialchars($_SESSION['kuerzel']) : 'Nicht angemeldet' ?>
    </div>
</header>
<main>
