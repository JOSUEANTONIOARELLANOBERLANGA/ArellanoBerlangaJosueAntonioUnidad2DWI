<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "jaabweb";

$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error); 
    die("Error de conexión con la base de datos. Contacta al administrador.");
}

$conn->set_charset("utf8mb4");
?>
