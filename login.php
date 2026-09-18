<?php
// login.php
session_start();
require 'db.php';

$fehler = '';

// Wurde das Formular abgeschickt?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // 1. Suche den Benutzer mit Prepared Statement (Schutz vor SQL-Injection)
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(array(':username' => $username));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Prüfen, ob der Benutzer existiert UND das Passwort stimmt
        if ($user && password_verify($password, $user['password'])) {
            // Login erfolgreich: Wir merken uns den Benutzer in der Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Weiterleitung zur geschützten Seite
            header("Location: dashboard.php");
            exit;
        } else {
            $fehler = "Benutzername oder Passwort ist falsch.";
        }
    } else {
        $fehler = "Bitte alle Felder ausfüllen.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Einfacher Login</title>
</head>
<body>

    <h1>Login</h1>

    <!-- Fehlermeldung ausgeben, falls vorhanden -->
    <?php if ($fehler): ?>
        <p><strong><?php echo $fehler; ?></strong></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="username">Benutzername:</label><br>
        <input type="text" id="username" name="username"><br><br>

        <label for="password">Passwort:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Einloggen">
    </form>

</body>
</html>