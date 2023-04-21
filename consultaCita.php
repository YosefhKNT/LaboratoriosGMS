<?php
ob_start();
// Conexión a la base de datos
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "laboratorio";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Fallo en la conexión: " . mysqli_connect_error());
}

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
    <link rel="stylesheet" type="text/css" href="styles/stylesConsultaCyR.css">
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
    <nav class="animate__animated animate__fadeInDown">
        <input type="checkbox" name="" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <a href="index.php" class="enlace">
            <img class="img_logo_gms" src="Images\GMS-Logo.png" alt="GMS-Logo">
        </a>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php">Estudios</a></li>
            <li><a href="index.php">Sucursales</a></li>
            <li><a href="index.php">Covid 19</a></li>
            <li><a href="hacerCita.php">Agenda una cita</a></li>
            <li><a href="consultaCita.php">Consulta tu cita</a></li>
        </ul>
    </nav>
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
            <!-- <div class="contenedor-imagen">
                <img src="Images\labwall.jpg" alt="imagen">
            </div> -->

        </div>

    </div>
</body>

</html>