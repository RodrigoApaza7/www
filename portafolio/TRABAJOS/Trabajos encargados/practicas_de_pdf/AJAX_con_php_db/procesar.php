<?php
$conexion = new mysqli(
    "3.16.227.140",
    "ventas_user"
    "ventas123",
    "ajax_db"
);
if ($conexion->connect_error) die("Error BD");

$nombres   = $_POST['nombres'];
$apellidos = $_POST['apellidos'];

$sql = "INSERT INTO personas(nombres, apellidos)
        VALUES ('$nombres', '$apellidos')";

$conexion->query($sql);

echo "Guardado correctamente";