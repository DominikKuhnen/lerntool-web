<?php
session_start();

if (!isset($_SESSION["kuerzel"])) {
    header("Location: login.php");
    exit();
} else {
    header("Location: start.php");
    exit();
}
