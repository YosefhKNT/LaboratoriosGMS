<?php
ob_start();
// Conexión a la base de datos
require 'conexion.php';

// Verificación de inicio de sesión
if (isset($_POST['ConsultarCita'])) {
    // Verificación de inicio de sesión
    $folio = $_POST['folio'];
    $clave = $_POST['clave'];

    $query = "SELECT * FROM citas WHERE id='$folio' AND clave='$clave'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Inicio de sesión exitoso
        session_start();
        //echo "Inicio de sesión exitoso";
        $_SESSION['folio'] = $folio;
        header("Location: infoCitas.php");
    } else {
        // Inicio de sesión fallido
        echo "Folio y/o clave incorrectos";
    }
}
?>

<html>

<head>
    <title>GMS | Consultar</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesConsultaCyR.css">
    <link rel="stylesheet" type="text/css" href="../styles/stylesNav.css">
    <?php
    include("../Plantillas/head.html");
    ?>
</head>

<body>
    <?php
    include("../Plantillas/nav.html");
    ?>
    <div class="contenedor" id="contene" onload="document.body.classList.add('animate__animated', 'animate__fadeInDown');">


        <!----------------------------------CONSULTA DE CITAS Y RESULTADOS------------------------------------>
        <div class="form-container" id="consulta_cita">
            <h1>Consulta de citas y resultados</h1>

            <form action="" method="post" class="text-center mx-5">

                <div class=" form-floating mb-3">
                    <input class="form-control form-control-lg" type="text" name="folio" placeholder="Folio">
                    <label for="Folio">Folio</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control form-control-lg" type="password" name="clave" placeholder="Clave">
                    <label for="Clave">Clave</label>
                </div>

                <div class="text-center">
                    <input class="form-control btn btn-primary p-3" type="submit" name="ConsultarCita" value="Buscar cita">
                </div>
            </form>

        </div>

    </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>