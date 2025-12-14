<?php
$conexion = new mysqli("localhost", "root", "", "ajaxbd");
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