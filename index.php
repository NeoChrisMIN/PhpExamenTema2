<!DOCTYPE html>
<html>

<head>
    <metacharset="UTF-8">
    <title>Base de Datos con PHP y PDO</title>
    <!--Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- Referencia a la CDN dela hoja de estilos de Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-
        PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpB
        fshb" crossorigin="anonymous">
</head>

<body class="cuerpo">
<?php include('conexion.php'); ?>
<div class="ml-4">
</div>


  <div class="container centrar">
      <div class="container cuerpo text-center">
        <p>
        <h2>Base de Datos</h2>
        </p>
      </div>
      <ul>
        <h4>Expedientes</h4>
        <li> <a href="registrar_expediente.php">Añadir expediente</a> </li>
        <li> <a href="listado_expedientes.php">Listado expediente</a> </li>
      </ul>
  </div>
</body>

</html>