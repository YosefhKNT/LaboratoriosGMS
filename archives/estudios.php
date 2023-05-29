<!DOCTYPE html>
<html lang="es">

<head>
    <title>GMS | Estudios Clínicos</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesEstudios.css">
    <?php
    include("../Plantillas/head.html");
    ?>
</head>

<body>
    <?php
    include("../Plantillas/nav.html");
    ?>
    <div class="container rounded shadow-lg text-center text-decoration-underline fs-1 text p-3 my-3">
        <h1>Estudios</h1>
    </div>
    <div class="container p-5">

        <?php
        ob_start();
        // Conexión a la base de datos
        require 'conexion.php';

        //* Ciclo para realizar la consulta por cada área
        // Consulta para obtener los estudios de cada área
        $sql_estudios = "SELECT `id`, `estudio`, `descripcion`, `ruta_imagen` FROM `estudio`;";
        $resultado_estudios = $conn->query($sql_estudios);

        // Imprimir los resultados de la consulta
        if ($resultado_estudios->num_rows > 0) {
            echo "<div class='row mb-5'>";
            while ($fila_estudios = $resultado_estudios->fetch_assoc()) {
                echo "<div class='flex-fill col-md-6 mb-3 '>";
                echo "  <div class='card card-body align-top mb-3' style='background-color: #ffffff; height: 100%;'>";
                echo "      <div class='container text-center' style='width: auto; height:200px;'>";
                echo "          <img class='estudio img-fluid' src='" . $fila_estudios["ruta_imagen"] . "' alt='Imagen " . $fila_estudios["id"] . "' />";
                echo "      </div>";
                echo "      <h2 class='align-top'>" . $fila_estudios["estudio"] . "</h2>";
                echo "      <p style='text-align: justify;'>" . $fila_estudios["descripcion"] . "</p>";
                echo "  </div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No se encontraron estudios para el área $i";
        }
        //*/

        ?>
    </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>