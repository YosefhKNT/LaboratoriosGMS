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

if (isset($_POST['AgendarCita'])) {
    // Verificación de los datos de la cita
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $estudio = $_POST['estudio'];
    $laboratorista = $_POST['laboratorista'];

    // Generar la clave aleatoria
    $clave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);

    // Insertar la cita en la base de datos
    $query = "INSERT INTO Citas (nombre, fecha, hora, telefono, clave, estudio_id, laboratorista_id)
                VALUES ('$nombre', '$fecha', '$hora', '$telefono', '$clave', 
                    (SELECT id FROM Estudio WHERE estudio = '$estudio'), 
                    (SELECT id FROM Laboratorista WHERE nombre = '$laboratorista'));";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Cita agendada exitosamente
        echo "Cita agendada exitosamente";

        $queryC = "SELECT * FROM citas 
                  WHERE nombre='$nombre' AND clave='$clave' AND telefono='$telefono'";
        $resultC = mysqli_query($conn, $queryC);
        if ($resultC) {
            $row = mysqli_fetch_assoc($resultC);
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['folio'] = $row['id'];
            header("Location: infoCitas.php");
        } else {
            echo "Error al acceder a la cita";
        }
    } else {
        // Error al agendar la cita
        echo "Error al agendar la cita";
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
            <li><a href="consultaCyR.php">Estudios</a></li>
            <li><a href="consultaCyR.php">Sucursales</a></li>
            <li><a href="consultaCyR.php">Covid 19</a></li>
            <li><a href="hacerCita.php">Agenda una cita</a></li>
            <li><a href="consultaCita.php">Consulta tu cita</a></li>
        </ul>
    </nav>

    <!-- ====================================================================== -->
    <div class="contenedor" id="contene" onload="document.body.classList.add('animate__animated', 'animate__fadeInDown');">

        <!----------------------------------AGENDA DE CITAS------------------------------------>
        <div class="form-container" id="agendar_cita">

            <h1>Solicitud de estudio clínico</h1>

            <form action="#" method="post" id="insertar_cita">
                <label for="Nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>

                <label for="Telefono">Telefono:</label>
                <input type="tel" id="telefono" name="telefono" placeholder="123-456-7890" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fechaCita" name="fechaCita" oninput="checkdate()" required>
                <script>
                    function checkdate() {
                        var selectedDate = new Date(document.getElementById("fechaCita").value);
                        var tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        selectedDate.setUTCHours(0, 0, 0, 0);
                        tomorrow.setUTCHours(0, 0, 0, 0);

                        if (selectedDate < tomorrow) {
                            alert("Por favor seleccione una fecha a partir de mañana");
                            document.getElementById("fechaCita").value = "";
                        }
                    }
                </script>

                <label for="hora">Hora: (7:00 am - 4:00 pm)</label>
                <select id="horaCita" name="horaCita"></select>

                <script>
                    var select = document.getElementById("horaCita");
                    var hora = new Date();
                    hora.setHours(7, 0, 0, 0); // Establecer la hora inicial a las 7:00 AM

                    while (hora.getHours() < 16) { // Agregar opciones hasta las 4:00 PM
                        var option = document.createElement("option");
                        var horaTexto = hora.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        option.text = horaTexto;
                        option.value = horaTexto;
                        select.add(option);
                        hora.setMinutes(hora.getMinutes() + 20); // Agregar 20 minutos al tiempo actual
                    }
                </script>

                <!-- 
                <input type="time" id="hora" name="hora" value="07:00" min="07:00" max="19:00" step="1200" required>

                <script>
                    // selecciona el elemento input
                    const input = document.querySelector('input[type="time"]');

                    // establece el valor inicial del input
                    let value = "07:00";

                    // establece el intervalo de tiempo en minutos
                    const interval = 20;

                    // función para restringir las horas seleccionables a partir de las 7:00 AM y hasta las 7:00 PM
                    function restrictTimeInput() {
                        const time = input.value.split(":");
                        const hours = parseInt(time[0], 10);
                        if (hours < 7) {
                            input.value = `07:00`;
                        } else if (hours >= 16) {
                            input.value = `16:00`;
                        }
                    }

                    // agrega un listener para detectar cambios en el input
                    input.addEventListener("input", () => {
                        // actualiza el valor del input con el valor más cercano en incrementos de interval
                        const time = input.value.split(":");
                        const minutes = parseInt(time[0], 10) * 60 + parseInt(time[1], 10);
                        const roundedMinutes = Math.round(minutes / interval) * interval;
                        const hours = Math.floor(roundedMinutes / 60);
                        const formattedMinutes = (roundedMinutes % 60).toString().padStart(2, "0");
                        input.value = `${hours.toString().padStart(2, "0")}:${formattedMinutes}`;

                        // restringe las horas seleccionables
                        restrictTimeInput();
                    });

                    // establece el valor inicial del input con incrementos de interval
                    const time = value.split(":");
                    const minutes = parseInt(time[0], 10) * 60 + parseInt(time[1], 10);
                    const roundedMinutes = Math.round(minutes / interval) * interval;
                    const hours = Math.floor(roundedMinutes / 60);
                    const formattedMinutes = (roundedMinutes % 60).toString().padStart(2, "0");
                    input.value = `${hours.toString().padStart(2, "0")}:${formattedMinutes}`;

                    // restringe las horas seleccionables
                    restrictTimeInput();
                </script>
                -->
                <label for="estudio">Estudio:</label>
                <select id="estudio" name="estudio" onchange="buscarLaboratorista()" required>
                    <option value="" selected>Seleccione un Estudio</option>
                    <?php
                    // Realizar la consulta a la base de datos
                    $consulta = "SELECT id, estudio FROM estudio";
                    $resultado = mysqli_query($conn, $consulta);
                    echo "$consulta";

                    // Recorrer los resultados de la consulta y generar las opciones del select
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<option id="estudio" value="' . $fila['estudio'] . '">' . $fila['estudio'] . '</option>';
                    }
                    ?>

                </select>
                <script>
                    function buscarLaboratorista() {
                        var estudio = document.getElementById("estudio").value;

                        // alert(estudio);

                        // Si el estudio seleccionado es válido, se envía una solicitud AJAX al servidor
                        if (estudio) {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("laboratorista").value = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "buscar_laboratorista.php?estudio=" + estudio, true);
                            xmlhttp.send();
                        } else {
                            document.getElementById("laboratorista").value = "";
                        }
                    }
                </script>

                <input type="hidden" name="laboratorista" id="laboratorista" placeholder="Laboratorista" readonly>

                <input type="submit" name="AgendarCita" value="Enviar solicitud">
            </form>

        </div>
    </div>
</body>

</html>