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
    <title>Lab GMS</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesConsultaCyR.css">
    <link rel="stylesheet" type="text/css" href="../styles/stylesNav.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("a").click(function(event) {
                event.preventDefault();
                newLocation = this.href;
                $('body').fadeOut('slow', newpage);
            });

            function newpage() {
                window.location = newLocation;
            }
        });
    </script>


</head>

<body onload="pageLoad()">
<?php
  include("../Plantillas/nav.html");
  ?>
    <div class="contenedor" id="contene" onload="document.body.classList.add('animate__animated', 'animate__fadeInDown');">


        <!----------------------------------CONSULTA DE CITAS Y RESULTADOS------------------------------------>
        <div class="form-container" id="consulta_cita">
            <h1>Consulta de citas y resultados</h1>

            <form action="" method="post">
                <label for="Folio">Folio:</label>
                <input type="text" name="folio" placeholder="Folio">
                <label for="Clave">Clave:</label>
                <input type="password" name="clave" placeholder="Clave">
                <input type="submit" name="ConsultarCita" value="Buscar cita">
            </form>

        </div>

    </div>
</body>

</html>