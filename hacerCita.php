<?php
ob_start();
// Conexión a la base de datos
require 'conexion.php';

if (isset($_POST['AgendarCita'])) {
    // Verificación de los datos de la cita
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fechaCita'];
    $hora = $_POST['horaCita'];
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
            echo "Se ha genrado un error al acceder a la cita";
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
                <input type="date" id="fechaCita" name="fechaCita" oninput="usarTodo()" required>
                <script>
                    function usarTodo() {
                        checkdate();
                        buscarHoras();
                    }

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

                    function buscarHoras() {
                        var fechaSeleccionada = document.getElementById("fechaCita").value;
                        // Si el fechaSeleccionada seleccionado es válido, se envía una solicitud AJAX al servidor
                        if (fechaSeleccionada) {
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    // Convertir la respuesta JSON en un arreglo de horas
                                    var horas = JSON.parse(this.responseText);

                                    // Obtener las horas de 7am a 4pm
                                    var horasMostrar = [];
                                    for (var hora = 7; hora <= 16; hora++) {
                                        for (var minuto = 0; minuto < 60; minuto += 20) {
                                            // Construir la hora en formato HH:mm:ss
                                            var horaMostrar = hora < 10 ? '0' + hora : hora;
                                            var minutoMostrar = minuto < 10 ? '0' + minuto : minuto;
                                            var horaCompleta = horaMostrar + ':' + minutoMostrar + ':00';

                                            // Agregar la hora a la lista si no está en la lista de horas obtenidas
                                            var horaExiste = false;
                                            for (var i = 0; i < horas.length; i++) {
                                                if (horas[i].substring(0, 5) === horaCompleta.substring(0, 5)) {
                                                    horaExiste = true;
                                                    break;
                                                }
                                            }
                                            if (!horaExiste) {
                                                horasMostrar.push(horaCompleta);
                                            }
                                        }
                                    }

                                    // Actualizar las horas obtenidas de la consulta con las horas de 7am a 4pm menos las horas obtenidas
                                    horas = horasMostrar;

                                    // Obtener el elemento select
                                    var selectHoras = document.getElementById("horaCita");

                                    // Eliminar todas las opciones del select
                                    selectHoras.innerHTML = "";

                                    if (horas.length > 0) {
                                        // Agregar una opción por cada hora
                                        for (var i = 0; i < horas.length; i++) {
                                            var option = document.createElement("option");
                                            option.value = horas[i];
                                            option.text = horas[i];
                                            selectHoras.appendChild(option);
                                        }
                                    } else {
                                        // Si no hay horas disponibles, mostrar un mensaje
                                        var option = document.createElement("option");
                                        option.value = "";
                                        option.text = "No hay horas disponibles para esta fecha";
                                        selectHoras.appendChild(option);
                                    }
                                } else {
                                    var horasMostrar = [];
                                    for (var hora = 7; hora <= 16; hora++) {
                                        for (var minuto = 0; minuto < 60; minuto += 20) {
                                            // Construir la hora en formato HH:mm:ss
                                            var horaMostrar = hora < 10 ? '0' + hora : hora;
                                            var minutoMostrar = minuto < 10 ? '0' + minuto : minuto;
                                            var horaCompleta = horaMostrar + ':' + minutoMostrar + ':00';
                                            horasMostrar.push(horaCompleta);
                                        }
                                    }

                                    // Actualizar las horas obtenidas de la consulta con las horas de 7am a 4pm
                                    var horas = horasMostrar;

                                    // Obtener el elemento select
                                    var selectHoras = document.getElementById("horaCita");

                                    // Eliminar todas las opciones del select
                                    selectHoras.innerHTML = "";

                                    // Agregar una opción por cada hora
                                    for (var i = 0; i < horas.length; i++) {
                                        var option = document.createElement("option");
                                        option.value = horas[i];
                                        option.text = horas[i];
                                        selectHoras.appendChild(option);
                                    }
                                }
                            };
                            xmlhttp.open("GET", "buscar_horas.php?estudio=" + fechaSeleccionada, true);
                            xmlhttp.send();
                        } else {
                            // limpia el select de fechaCita
                            document.getElementById("fechaCita").value = "";
                        }
                    }
                </script>
                <label for="hora">Hora: (7:00 am - 4:00 pm)</label>
                <select id="horaCita" name="horaCita"></select>

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