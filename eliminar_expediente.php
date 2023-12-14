<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha proporcionado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtener el ID del expediente a eliminar
    $idExpediente = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para eliminar el expediente
    $stmt = $conexion->prepare("DELETE FROM expedientes WHERE id = :id");
    $stmt->bindParam(':id', $idExpediente, PDO::PARAM_INT);

    // Ejecutar la consulta y verificar si fue exitosa
    if ($stmt->execute()) {
        // Redirigir a la página de listado de expedientes con un mensaje de éxito
        header('Location: listado_expedientes.php?mensaje=Expediente eliminado correctamente');
        exit();
    } else {
        // Redirigir a la página de listado de expedientes con un mensaje de error
        header('Location: listado_expedientes.php?mensaje=Error al eliminar expediente');
        exit();
    }
} else {
    // Redirigir a la página de listado de expedientes si no se proporcionó un ID válido
    header('Location: listado_expedientes.php');
    exit();
}
?>
