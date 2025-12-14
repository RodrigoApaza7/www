<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli(
    "localhost",
    "ventas_user",
    "ventas123",
    "ajax_db"
);

if ($conexion->connect_error) {
    die($conexion->connect_error);
}

$sql = "INSERT INTO personas (nombres, apellidos)
        VALUES ('AAA', 'BBB')";

if (!$conexion->query($sql)) {
    die($conexion->error);
}

echo "INSERT OK";