<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_POST);
exit;
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

$sql = "INSERT INTO personas(nombres, apellidos)
        VALUES ('$nombres', '$apellidos')";

$conexion->query($sql);

echo "Guardado correctamente";