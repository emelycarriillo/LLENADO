<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "thomson");

// Verificación de conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para insertar el registro con la zona horaria configurada
if (isset($_POST['cliente']) && isset($_POST['zona']) && isset($_POST['cantidad'])) {
  $cliente = $_POST['cliente'];
  $zona = $_POST['zona'];
  $cantidad = $_POST['cantidad'];

  // Configurar la zona horaria a -04:00 en la consulta
  $consulta = "SET time_zone = '-04:00';";
  $resultado = $conexion->query($consulta);

  if (!$resultado) {
    echo "Error al configurar la zona horaria: " . $conexion->error;
  } else {
    // Obtener la hora actual en la zona horaria configurada
    $fechaHora = date('Y-m-d H:i:s');

    // Consulta para insertar el registro
    $consulta = "INSERT INTO llenados (cliente, zona, cantidad, fecha) VALUES ('$cliente', '$zona', '$cantidad', '$fechaHora')";
    $resultado = $conexion->query($consulta);

    if ($resultado) {
      header('Location: index.php');
    } else {
      echo "Error al insertar el registro: " . $conexion->error;
    }
  }
}
?>