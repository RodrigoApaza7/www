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

$resultado = $conexion->query("SELECT * FROM personas");

$datos = [];

while($fila = $resultado->fetch_assoc()){
    $datos[] = [
        $fila['id'],
        $fila['nombres'],
        $fila['apellidos']
    ];
}

echo json_encode($datos);