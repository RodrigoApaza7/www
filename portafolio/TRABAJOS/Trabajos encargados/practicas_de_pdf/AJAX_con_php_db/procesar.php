<?php
$conexion = new mysqli("localhost", "root", "", "ajaxbd");
if ($conexion->connect_error) die("Error BD");

$nombres   = $_POST['nombres'];
$apellidos = $_POST['apellidos'];

$sql = "INSERT INTO personas(nombres, apellidos)
        VALUES ('$nombres', '$apellidos')";

$conexion->query($sql);

echo "Guardado correctamente";