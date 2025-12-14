<?php
$conexion = new mysqli(
    "3.16.227.140",
    "ventas_user"
    "ventas123",
    "ajax_db"
);
if ($conexion->connect_error) die("Error BD");

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