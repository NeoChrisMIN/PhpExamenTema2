<?php
try {
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Incluir el archivo de conexión a la base de datos
        include 'conexion.php';

        // Obtener datos del formulario
        $numeroExpediente = $_POST['numeroExpediente'];
        $nif = $_POST['nif'];
        $nombreApellidos = $_POST['nombreApellidos'];
        $email = $_POST['email'];
        $telefonoMovil = $_POST['telefonoMovil'];

        // Subir la foto al servidor (si se proporciona)
        $foto = 'default_image.jpg'; // Valor predeterminado
        if ($_FILES['foto']['error'] == 0) {
            $foto = 'uploads/' . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
        }

        // Preparar la consulta SQL
        $sql = "INSERT INTO expedientes (numero_expediente, nif, nombre_apellidos, email, telefono_movil, foto) 
                VALUES (:numeroExpediente, :nif, :nombreApellidos, :email, :telefonoMovil, :foto)";

        // Ejecutar la consulta con valores seguros
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':numeroExpediente', $numeroExpediente);
        $stmt->bindParam(':nif', $nif);
        $stmt->bindParam(':nombreApellidos', $nombreApellidos);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefonoMovil', $telefonoMovil);
        $stmt->bindParam(':foto', $foto);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo '<div class="alert alert-success">' .
                'Expediente agregado con éxito.' .
                '</div>';
        } else {
            throw new Exception('Error al agregar expediente: ' . $stmt->errorInfo()[2]);
        }

        // Cerrar la conexión
        $conexion = null;
    }
} catch (Exception $e) {
    echo '<div class="alert alert-danger">' .
        'Error: ' . $e->getMessage() .
        '</div>';
}
?>