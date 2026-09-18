<?php
// db.php
$host = 'localhost';
$dbname = 'login_db';
$user = 'root';
$pass = ''; // Standardmäßig ist das Passwort bei XAMPP leer

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Fehler werfen, wenn etwas schiefgeht
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindungsfehler: " . $e->getMessage());
}
?>