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
        // echo "Folio y/o clave incorrectos";
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
    <div class="contenedor" id="contene"">


        <!----------------------------------CONSULTA DE CITAS Y RESULTADOS------------------------------------>
        <div class="form-container" id="consulta_cita">
            <h1>Consulta de citas y resultados</h1>

            <form class="text-center mx-5 needs-validation" novalidate action="#" method="post">

                <div class=" form-floating mb-5">
                    <input class="form-control form-control-lg" type="text" name="folio" placeholder="Folio" pattern="[0-9]{1,100}" required>
                    <label for="Folio">Folio</label>
                    <div class="valid-tooltip">
                        Folio correcto
                    </div>
                    <div class="invalid-tooltip">
                        Escriba su Folio (Solo numeros)
                    </div>
                </div>

                <div class="form-floating mb-5">
                    <input class="form-control form-control-lg" type="password" name="clave" placeholder="Clave" pattern="[0-9a-zA-Z]{8}" required>
                    <label for="Clave">Clave</label>
                    <div class="valid-tooltip">
                        Clave correcta
                    </div>
                    <div class="invalid-tooltip">
                        Escriba su Clave (8 letras)
                    </div>
                </div>

                <div class="text-center">
                    <input class="btn btn-primary p-3" type="submit" name="ConsultarCita" value="Buscar cita">
                </div>
            </form>

        </div>

    </div>
    <!-- Tooltips -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>