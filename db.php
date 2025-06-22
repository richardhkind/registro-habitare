<?php
$host = "localhost";
$user = "cvjhbqmy_ADMIN";
$password = ".RHKcd393013";
$database = "cvjhbqmy_VENTAS";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>