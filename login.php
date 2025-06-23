<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = $_POST['mail'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE mail = ?");
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($contrasena, $row['contrasena'])) {
            $_SESSION['user'] = $mail;
            header('Location: reserva.php');
            exit;
        } else {
            $error = 'Contraseña incorrecta.';
        }
    } else {
        $error = 'Usuario no encontrado.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Ingresar</h2>
    <?php if(!empty($error)) echo '<p>' . $error . '</p>'; ?>
    <form method="POST" action="login.php">
        <label>Email:</label><br>
        <input type="email" name="mail" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>
        <button type="submit">Login</button>
        <a href="index.php"><button type="button">Registrarse</button></a>
    </form>
</body>
</html>
