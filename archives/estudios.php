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
    <div class="container p-5">
        <div class="container rounded shadow-lg text-center text-decoration-underline fs-1 text p-5 mb-5">
            <h1>Estudios</h1>
        </div>
        <?php
        ob_start();
        // Conexión a la base de datos
        require 'conexion.php';

        // Realización de la consulta para obtener el número de áreas
        $sql_areas = "SELECT COUNT(`id`) FROM `area`;";
        $resultado_areas = $conn->query($sql_areas);
        if ($resultado_areas->num_rows > 0) {
            $fila_areas = $resultado_areas->fetch_assoc();
            $num_areas = $fila_areas["COUNT(`id`)"];
        } else {
            $num_areas = 0;
        }

        // Ciclo para realizar la consulta por cada área
        for ($i = 1; $i <= $num_areas; $i++) {
            // Consulta para obtener los estudios de cada área
            $sql_estudios = "SELECT `id`, `estudio`, `descripcion`, `ruta_imagen` FROM `estudio` WHERE `area_id` = $i;";
            $resultado_estudios = $conn->query($sql_estudios);

            // Consulta para obtener el nombre del área correspondiente
            $sql_area_nombre = "SELECT `area` FROM `area` WHERE `id` = $i;";
            $resultado_area_nombre = $conn->query($sql_area_nombre);
            $fila_area_nombre = $resultado_area_nombre->fetch_assoc();
            $area_nombre = $fila_area_nombre["area"];

            // Imprimir los resultados de la consulta
            if ($resultado_estudios->num_rows > 0) {
                echo "<div class='d-flex row mb-5' id='$area_nombre'>";
                echo "<h2 class='col-md-12'>$area_nombre</h2><br>";
                while ($fila_estudios = $resultado_estudios->fetch_assoc()) {
                    echo "<div class='flex-fill col-md-6 mb-3 '>";
                    echo "  <div class='card card-body align-top mb-3' style='background-color: #ffffff; height: 100%;'>";
                    echo "      <div class='container text-center' style='width: auto; height:200px;'>";
                    echo "          <img class='estudio img-fluid' src='estudios_img/" . $fila_estudios["ruta_imagen"] . "' alt='Imagen " . $fila_estudios["id"] . "' />";
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
        }
        ?>
    </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>