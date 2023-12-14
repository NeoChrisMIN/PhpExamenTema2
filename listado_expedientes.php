<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Expedientes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Listado de Expedientes</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Número de Expediente</th>
                <th>NIF</th>
                <th>Nombre y Apellidos</th>
                <th>Email</th>
                <th>Teléfono Móvil</th>
                <th>Foto</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Incluir el archivo de conexión a la base de datos
            include 'conexion.php';

            // Número de registros por página
            $registrosPorPagina = 10;

            // Obtener el número total de registros
            $totalRegistros = $conexion->query("SELECT COUNT(*) FROM expedientes")->fetchColumn();

            // Calcular el número total de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

            // Página actual (por defecto es la primera página)
            $paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

            // Calcular el índice del primer registro en la página actual
            $indiceInicio = ($paginaActual - 1) * $registrosPorPagina;

            // Consultar los expedientes para la página actual
            $stmt = $conexion->prepare("SELECT * FROM expedientes LIMIT :inicio, :registrosPorPagina");
            $stmt->bindParam(':inicio', $indiceInicio, PDO::PARAM_INT);
            $stmt->bindParam(':registrosPorPagina', $registrosPorPagina, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['numero_expediente'] . '</td>';
                echo '<td>' . $row['nif'] . '</td>';
                echo '<td>' . $row['nombre_apellidos'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['telefono_movil'] . '</td>';
                echo '<td><img src="' . $row['foto'] . '" width="50" height="50" alt="Foto"></td>';
                echo '<td>';
                echo '<a href="editar_expediente.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Editar</a> ';
                echo '<a href="#" onclick="confirmarEliminar(' . $row['id'] . ')" class="btn btn-danger btn-sm">Eliminar</a>';
                echo '<a href="detalle_expediente.php?id=' . $row['id'] . '" class="btn btn-info btn-sm">Detalle</a>';
                
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script>
    function confirmarEliminar(idExpediente) {
        // Mostrar un cuadro de diálogo de confirmación
        var confirmacion = confirm("¿Estás seguro de que deseas eliminar este expediente?");

        // Si el usuario hace clic en "Aceptar", redirigir al script de eliminación
        if (confirmacion) {
            window.location.href = 'eliminar_expediente.php?id=' + idExpediente;
        }
    }
</script>

</body>
</html>