<?php
// dashboard.php
session_start();

// Wenn die Session leer ist, ist der Benutzer nicht eingeloggt
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Geschützter Bereich</title>
</head>
<body>

    <h1>Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Du bist erfolgreich eingeloggt.</p>

    <p><a href="logout.php">Ausloggen</a></p>

</body>
</html>