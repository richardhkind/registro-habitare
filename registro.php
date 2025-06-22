<?php
require 'db.php';

$nombre = $_POST['nombre'];
$mail = $_POST['mail'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$check = $conn->prepare("SELECT * FROM usuarios WHERE mail = ?");
$check->bind_param("s", $mail);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "Este correo ya está registrado.";
} else {
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, mail, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $mail, $contrasena);
    if ($stmt->execute()) {
        echo "¡Registro exitoso!";
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}
?>