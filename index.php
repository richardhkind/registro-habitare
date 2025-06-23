<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuarios</title>
</head>
<body>
  <h2>Formulario de Registro</h2>
  <form action="registro.php" method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="mail" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="contrasena" required><br><br>

    <button type="submit">Registrarse</button>
  </form>
  <p>
    <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
  </p>
</body>
</html>
