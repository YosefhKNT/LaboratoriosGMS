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
        $queryC = "SELECT * FROM citas 
                  WHERE nombre='$nombre' AND clave='$clave' AND telefono='$telefono'";
        $resultC = mysqli_query($conn, $queryC);

        if ($resultC) {

            $row = mysqli_fetch_assoc($resultC);
            $folio = $row['id'];
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['folio'] = $row['id'];
            header("Location: ../archives/infoCitas.php");
            //header("Location: descargaEstudios.php");
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
    <title>GMS | Agendar</title>
    <?php
    include("../Plantillas/head.html");
    ?>

    <link rel="stylesheet" type="text/css" href="../styles/stylesConsultaCyR.css">
</head>

<body onload="pageLoad()">
    <?php
    include("../Plantillas/nav.html");
    ?>

    <!-- ====================================================================== -->
    <div class="contenedor" id="contenedor" onload="document.body.classList.add('animate__animated', 'animate__fadeInDown');">

        <!----------------------------------AGENDA DE CITAS------------------------------------>
        <div class="form-container" id="agendar_cita">

            <h1>Solicitud de estudio clínico</h1>

            <form class="needs-validation" novalidate action="#" method="post" id="insertar_cita">
                <!-- Input de nombre -->
                <div class="form-floating mb-5">
                    <input class="form-control form-control-lg" type="text" id="nombre" name="nombre" title="Por favor, ingrese un nombre válido (solo letras, espacios y acentos)" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{6,150}" placeholder="Nombre" required>
                    <label for="nombre">Nombre</label>
                    <div class="valid-tooltip">
                        Correcto
                    </div>
                    <div class="invalid-tooltip">
                        Escriba su nombre (Entre 6 a 150 letras)
                    </div>
                </div>

                <!-- input de telefono -->
                <div class="form-floating mb-5">
                    <input class="form-control form-control-lg" type="tel" id="telefono" name="telefono" title="Por favor, ingrese un numero válido (Solo a 10 digitos)" pattern="[0-9]{10,}" placeholder="123-456-7890" required>
                    <label for="Telefono">Telefono</label>
                    <div class="valid-tooltip">
                        Correcto
                    </div>
                    <div class="invalid-tooltip">
                        Por favor ingrese un numero valido (minimo 10 digitos).
                    </div>
                </div>

                <div class="form-floating mb-5">
                    <div class="row">
                        <!-- Selec de fechas -->
                        <div class="col">
                            <label for="fechaCita">Fecha:</label>
                            <input class="form-control" type="date" id="fechaCita" name="fechaCita" title="Por favor, ingrese una fecha válida (solo a partir de mañana)" oninput="usarTodo()" required>
                            <div class="valid-tooltip">
                                Correcto
                            </div>
                            <div class="invalid-tooltip">
                                Elija la fecha
                            </div>
                        </div>

                        <!-- Selec de horas -->
                        <div class="col">
                            <label for="hora">Hora (7am a 4pm):</label>
                            <select class="form-control" style="height: 50%;" id="horaCita" name="horaCita" title="Primero selecione la fecha para poder elegir la hora"></select>
                            <div class="invalid-tooltip">
                                Elija la hora
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selec de estudios -->
                <div class="form-floating mb-5">
                    <select class="form-select " id="estudio" name="estudio" onchange="buscarLaboratorista()" title="Por favor, seleccione un estudio" required>
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
                    <label for="estudio">Estudio:</label>
                    <div class="valid-tooltip">
                        Correcto
                    </div>
                    <div class="invalid-tooltip">
                        Elija el estudio
                    </div>
                </div>
                <input type="hidden">
                <input type="hidden" name="laboratorista" id="laboratorista" placeholder="Laboratorista" readonly>
                <!-- Boton -->
                <div class="text-center">
                    <input class="btn btn-primary" style="width: 100%;" type="submit" name="AgendarCita" value="Enviar solicitud">
                </div>
                <div id="liveAlertPlaceholder"></div>
            </form>

        </div>
    </div>

    <!-- Script del Alert -->
    <script>
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const appendAlert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
        }

        const alertTrigger = document.getElementById('liveAlertBtn')
        if (alertTrigger) {
            alertTrigger.addEventListener('click', () => {
                appendAlert('Tus informacion de cita se descargó!', 'success')
            })
        }
    </script>

    <!-- Agrega el código JavaScript aquí -->
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

    <!-- Script para buscar Laboratorista -->
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

    <!-- Script para Validar fecha y hora -->
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

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>