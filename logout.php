<?php
// logout.php
session_start();

// Alle Session-Variablen löschen
$_SESSION = array();

// Session zerstören
session_destroy();

// Zurück zum Login
header("Location: login.php");
exit;
?>