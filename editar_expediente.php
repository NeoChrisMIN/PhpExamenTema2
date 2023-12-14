<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Expediente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Expediente</h2>

    <?php
    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Verificar si se ha proporcionado un ID válido
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        // Obtener el ID del expediente a editar
        $idExpediente = $_GET['id'];

        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $numeroExpediente = $_POST['numeroExpediente'];
            $nif = $_POST['nif'];
            $nombreApellidos = $_POST['nombreApellidos'];
            $email = $_POST['email'];
            $telefonoMovil = $_POST['telefonoMovil'];

            // Preparar y ejecutar la consulta SQL para actualizar el expediente
            $stmt = $conexion->prepare("UPDATE expedientes SET 
                numero_expediente = :numeroExpediente,
                nif = :nif,
                nombre_apellidos = :nombreApellidos,
                email = :email,
                telefono_movil = :telefonoMovil
                WHERE id = :id");

            $stmt->bindParam(':numeroExpediente', $numeroExpediente);
            $stmt->bindParam(':nif', $nif);
            $stmt->bindParam(':nombreApellidos', $nombreApellidos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefonoMovil', $telefonoMovil);
            $stmt->bindParam(':id', $idExpediente, PDO::PARAM_INT);

            // Ejecutar la consulta y verificar si fue exitosa
            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Expediente actualizado correctamente.</div>';
            } else {
                echo '<div class="alert alert-danger">Error al actualizar expediente.</div>';
            }
        }

        // Preparar y ejecutar la consulta SQL para obtener los detalles del expediente a editar
        $stmt = $conexion->prepare("SELECT * FROM expedientes WHERE id = :id");
        $stmt->bindParam(':id', $idExpediente, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si se encontró el expediente
        if ($stmt->rowCount() > 0) {
            $expediente = $stmt->fetch(PDO::FETCH_ASSOC);

            // Mostrar el formulario de edición con los datos actuales del expediente
            ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="numeroExpediente">Número de Expediente:</label>
                    <input type="text" class="form-control" id="numeroExpediente" name="numeroExpediente" value="<?php echo $expediente['numero_expediente']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nif">NIF:</label>
                    <input type="text" class="form-control" id="nif" name="nif" value="<?php echo $expediente['nif']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nombreApellidos">Nombre y Apellidos:</label>
                    <input type="text" class="form-control" id="nombreApellidos" name="nombreApellidos" value="<?php echo $expediente['nombre_apellidos']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $expediente['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefonoMovil">Teléfono Móvil:</label>
                    <input type="tel" class="form-control" id="telefonoMovil" name="telefonoMovil" value="<?php echo $expediente['telefono_movil']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
            <?php
        } else {
            echo '<div class="alert alert-warning">No se encontró el expediente.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">ID de expediente no válido.</div>';
    }
    ?>

    <a href="listado_expedientes.php" class="btn btn-primary mt-2">Volver al Listado</a>
</div>

</body>
</html>