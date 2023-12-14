<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Expediente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Detalle de Expediente</h2>

    <?php
    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Verificar si se ha proporcionado un ID válido
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        // Obtener el ID del expediente a mostrar
        $idExpediente = $_GET['id'];

        // Preparar y ejecutar la consulta SQL para obtener los detalles del expediente
        $stmt = $conexion->prepare("SELECT * FROM expedientes WHERE id = :id");
        $stmt->bindParam(':id', $idExpediente, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se encontró el expediente
        if ($stmt->rowCount() > 0) {
            $expediente = $stmt->fetch(PDO::FETCH_ASSOC);

            // Mostrar los detalles del expediente
            echo '<table class="table">';
            echo '<tr><th>Número de Expediente</th><td>' . $expediente['numero_expediente'] . '</td></tr>';
            echo '<tr><th>NIF</th><td>' . $expediente['nif'] . '</td></tr>';
            echo '<tr><th>Nombre y Apellidos</th><td>' . $expediente['nombre_apellidos'] . '</td></tr>';
            echo '<tr><th>Email</th><td>' . $expediente['email'] . '</td></tr>';
            echo '<tr><th>Teléfono Móvil</th><td>' . $expediente['telefono_movil'] . '</td></tr>';
            echo '<tr><th>Foto</th><td><img src="' . $expediente['foto'] . '" width="50" height="50" alt="Foto"></td></tr>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning">No se encontró el expediente.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">ID de expediente no válido.</div>';
    }
    ?>

    <a href="listado_expedientes.php" class="btn btn-primary">Volver al Listado</a>
</div>

</body>
</html>