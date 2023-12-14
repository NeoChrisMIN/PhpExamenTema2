<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Expedientes</title>
    <!-- Agrega enlaces a los archivos de estilo de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Añadir Nuevo Expediente</h2>

    <form action="procesar_formulario.php" method="post" enctype="multipart/form-data">
        <!-- Número de Expediente -->
        <div class="form-group">
            <label for="numeroExpediente">Número de Expediente:</label>
            <input type="text" class="form-control" id="numeroExpediente" name="numeroExpediente" required>
        </div>

        <!-- NIF -->
        <div class="form-group">
            <label for="nif">NIF:</label>
            <input type="text" class="form-control" id="nif" name="nif" required>
        </div>

        <!-- Nombre y Apellidos -->
        <div class="form-group">
            <label for="nombreApellidos">Nombre y Apellidos:</label>
            <input type="text" class="form-control" id="nombreApellidos" name="nombreApellidos" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Teléfono Móvil -->
        <div class="form-group">
            <label for="telefonoMovil">Teléfono Móvil:</label>
            <input type="tel" class="form-control" id="telefonoMovil" name="telefonoMovil" required>
        </div>

        <!-- Foto -->
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" class="form-control-file" id="foto" name="foto">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Expediente</button>
    </form>
</div>

<!-- Agrega enlaces a los archivos de script de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>