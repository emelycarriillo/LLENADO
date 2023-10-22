<?php
$conexion = new mysqli("localhost", "root", "", "thomson");
//$conexion = new mysqli("localhost", "emelycar_emely", "ARAemely01*", "emelycar_thomson");


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$query = "SELECT cliente, zona, cantidad, fecha FROM llenados";
$resultado = $conexion->query($query);

$data = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $data[] = $fila;
    }
}

echo json_encode($data);

$conexion->close();
?>