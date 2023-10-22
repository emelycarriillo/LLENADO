<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplicación de llenado de botellones</title>
  <script src="https://kit.fontawesome.com/46928f7b05.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>Aplicación de llenado de botellones</h1>
    <div class="row">
      <div class="col-md-6">
        <form action="llenados.php" method="post">
          <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="cliente" name="cliente" required>
          </div>
          <div class="mb-3">
            <label for="zona" class="form-label">Zona</label>
            <input type="text" class="form-control" id="zona" name="zona" required>
          </div>
          <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
      <div class="col-md-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Cliente</th>
              <th>Zona</th>
              <th>Cantidad</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <div class="text-right m-2">
              <a href="fpdf/reporte.php" target="_blank" class="btn btn-primary"><i class="fa-regular fa-file-pdf"></i>Generar reportes</a>
          </div>
          <tbody>
            <?php
              // Conexión a la base de datos
              $conexion = new mysqli("localhost", "root", "", "thomson");

              // Consulta para obtener los registros
              $consulta = "SELECT cliente, zona, cantidad, fecha FROM llenados ORDER BY fecha DESC";
              $resultado = $conexion->query($consulta);

              // Recorrer los resultados
              while ($registro = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$registro['cliente']}</td>";
                echo "<td>{$registro['zona']}</td>";
                echo "<td>{$registro['cantidad']}</td>";

                // Formatear la fecha y hora
                $fechaHora = date("d/m/Y H:i:s", strtotime($registro['fecha']));
                echo "<td>{$fechaHora}</td>";

                echo "</tr>";
              }

              // Cerrar la conexión a la base de datos
              $conexion->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function () {
      // Llama a la función para cargar los datos al cargar la página
      cargarDatos();

      // Función para cargar datos utilizando AJAX
      function cargarDatos() {
        $.ajax({
          url: 'get_data.php',
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            // Recorre los datos y muéstralos en la página
            var html = '<table>';
            html += '<tr><th>ID</th><th>Nombre</th><th>Correo</th></tr>';
            for (var i = 0; i < data.length; i++) {
              html += '<tr>';
              html += '<td>' + data[i].cliente + '</td>';
              html += '<td>' + data[i].zona + '</td>';
              html += '<td>' + data[i].cantidad + '</td>';
              html += '<td>' + data[i].fecha + '</td>';
              html += '</tr>';
            }
            html += '</table>';
            $('#datos').html(html);
          },
          error: function (error) {
            console.log(error);
          }
        });
      }
    });
  </script>
</body>
</html>