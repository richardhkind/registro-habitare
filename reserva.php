<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Lotes</title>
</head>
<body>
    <h2>Reserva de Lotes</h2>
    <p>Página en construcción.</p>
</body>
</html>
