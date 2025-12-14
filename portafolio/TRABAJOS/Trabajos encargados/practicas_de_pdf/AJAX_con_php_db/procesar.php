<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli(
    "3.16.227.140",
    "ventas_user",
    "ventas123",
    "ajax_db"
);

if ($conexion->connect_error) {
    die($conexion->connect_error);
}

$nombres   = $_POST['nombres'];
$apellidos = $_POST['apellidos'];

$sql = "INSERT INTO personas (nombres, apellidos)
        VALUES ('$nombres', '$apellidos')";

if (!$conexion->query($sql)) {
    die($conexion->error);
}

echo "Guardado correctamente";