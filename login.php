<?php
// login.php - Handle user login for HABITARE platform

session_start();

// Database configuration
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'cvjhbqmy_HABITARE';

// Create connection
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($email === '' || $password === '') {
        $error = 'Por favor ingrese correo y contraseña';
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $mysqli->prepare('SELECT CONTRASENA, ROLL FROM USUARIOS WHERE EMAIL = ? LIMIT 1');
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($dbPassword, $roll);
                $stmt->fetch();
                // Verify that stored password seems to be SHA-256
                if (!preg_match('/^[A-Fa-f0-9]{64}$/', $dbPassword)) {
                    $error = 'Formato de contraseña inválido.';
                } else {
                    $hash = hash('sha256', $password);
                    if (hash_equals($dbPassword, $hash)) {
                        // Credentials valid
                        $_SESSION['usuario'] = $email;
                        $_SESSION['roll'] = $roll;

                        switch ($roll) {
                            case 'Usuario':
                                header('Location: usuario/index.php');
                                break;
                            case 'Supervisor':
                                header('Location: supervisor/index.php');
                                break;
                            case 'Administrativo':
                                header('Location: administrativo/index.php');
                                break;
                            case 'Desarollador':
                                header('Location: desarrollador/index.php');
                                break;
                            default:
                                header('Location: index.php');
                                break;
                        }
                        exit();
                    } else {
                        $error = 'Correo o contraseña incorrectos';
                    }
                }
            } else {
                $error = 'Correo o contraseña incorrectos';
            }
            $stmt->close();
        } else {
            $error = 'Error en la consulta: ' . $mysqli->error;
        }
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
    <form action="login.php" method="post">
        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Ingresar</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>
