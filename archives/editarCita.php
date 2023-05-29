<?php
ob_start();
// Conexión a la base de datos
require 'conexion.php';

session_start();

if (!isset($_SESSION['folio'])) {
    header("Location: consultaCita.php");
    exit();
}

// Obtener el folio de la sesión
$folio = $_SESSION['folio'];

$query_join = "SELECT `nombre`,`fecha`,`hora`,`telefono`, `estudio_id`
    FROM `citas` WHERE `id`='$folio';";
$resultado = mysqli_query($conn, $query_join);
$fila = mysqli_fetch_assoc($resultado);

if (isset($_POST['modificarCita'])) {
    // Verificación de los datos de la cita
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fechaCita'];
    $hora = $_POST['horaCita'];
    $estudio = $_POST['estudio'];
    $laboratorista = $_POST['laboratorista'];

    // Insertar la cita en la base de datos
    $query_sql = "UPDATE citas SET 
    nombre = '$nombre', 
    fecha = '$fecha', 
    hora = '$hora', 
    telefono = '$telefono', 
    estudio_id = '$estudio'
    WHERE id = $folio";
    $result = mysqli_query($conn, $query_sql);

    if ($result) {
        session_start();
        $_SESSION['folio'] = "$folio";
        $_SESSION['mensaje'] = "Datos modificados con exito.";
        header("Location: ../archives/infoCitas.php");
    } else {
        echo "Error al ejecutar la sentencia de actualización: " . mysqli_error($conn);
    }
}


?>


<html>

<head>
    <title>GMS | Editar Cita</title>
    <?php
    include("../Plantillas/head.html");
    ?>
    <link rel="stylesheet" type="text/css" href="../styles/stylesConsultaCyR.css">
</head>

<body onload="pageLoad()">

    <nav class="navbar navbar-expand-lg nav-custom sticky-top" style="background-color: #3f51b5">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="../index.php">
                <img src="../Images/GMS-Logo1.png" alt="Logo" width="60" height="24" class="d-inline-block align-text-top" />
                Laboratorios GMS
            </a>
        </div>
    </nav>

    <!-- ====================================================================== -->
    <div class="contenedor" id="contenedor">
        <!----------------------------------AGENDA DE CITAS------------------------------------>
        <div class="form-container" id="agendar_cita">

            <h1>Modifique su cita Aqui</h1>

            <form class="needs-validation" novalidate action="#" method="post" id="insertar_cita">
                <!-- Input de nombre -->
                <div class="form-floating mb-5">
                    <input class="form-control form-control-lg" type="text" id="nombre" name="nombre" title="Por favor, ingrese un nombre válido (solo letras, espacios y acentos)" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{6,150}" placeholder="Nombre" value="<?php echo $fila['nombre']; ?>" required>
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
                    <input class="form-control form-control-lg" type="tel" id="telefono" name="telefono" title="Por favor, ingrese un numero válido (Solo a 10 digitos)" pattern="[0-9]{10}" placeholder="123-456-7890" value="<?php echo $fila['telefono']; ?>" required>
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
                            <input class="form-control" type="date" id="fechaCita" name="fechaCita" oninput="usarTodo()" title="Por favor, ingrese una fecha válida (solo a partir de mañana)" value="<?php echo $fila['fecha']; ?>" required>
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
                            <select class="form-control" onfocus="buscarHoras()" style="height: 50%;" id="horaCita" name="horaCita" title="Primero selecione la fecha para poder elegir la hora">
                            </select>
                            <div class="invalid-tooltip">
                                Elija la hora
                            </div>

                            <script>
                                // Función para ejecutar buscarHoras()
                                function ejecutarBuscarHoras() {
                                    // Aquí va tu código para llamar al método buscarHoras()
                                    buscarHoras();

                                    // Eliminar el event listener después de ejecutar buscarHoras()
                                    document.getElementById("horaCita").removeEventListener("click", ejecutarBuscarHoras);
                                }

                                // Obtener referencia al select
                                //var select = document.getElementById("horaCita");

                                // Escuchar el evento click del select
                                //select.addEventListener("change", ejecutarBuscarHoras);
                            </script>

                        </div>
                    </div>
                </div>

                <!-- Selec de estudios -->
                <div class="form-floating mb-5">
                    <select class="form-select " id="estudio" name="estudio" onchange="buscarLaboratorista()" title="Por favor, seleccione un estudio" required>
                        <option value="" selected>Seleccione un Estudio</option>
                        <?php
                        // Realizar la consulta a la base de datos
                        $consulta = "SELECT id, estudio FROM estudio ";
                        $resultado = mysqli_query($conn, $consulta);

                        // Obtener el ID del estudio de la primera consulta
                        $estudioSeleccionado = $fila['estudio_id'];

                        // Recorrer los resultados de la consulta y generar las opciones del select
                        while ($filaEstudio = mysqli_fetch_assoc($resultado)) {
                            $idEstudio = $filaEstudio['id'];
                            $nombreEstudio = $filaEstudio['estudio'];

                            // Comprobar si el estudio actual es el seleccionado
                            $selected = ($idEstudio == $estudioSeleccionado) ? 'selected' : '';

                            echo '<option id="estudio" value="' . $idEstudio . '" ' . $selected . '>' . $nombreEstudio . '</option>';
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
                <div class="text-center mb-1">
                    <input type="submit" class="btn btn-primary" style="width: 100%;" name="modificarCita" value="Modificar">
                </div>

            </form>
            <div class="text-center">
                <a href="../archives/infoCitas.php">
                    <button class="btn btn-secondary" style="width: 100%;">Volver</button>
                </a>

            </div>

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
            buscarHoras();
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

    <!-- Script para validar la hora al modificar -->
    <script>
        // Función para generar las opciones de hora en el select
        function generarOpcionesHora() {
            var selectHora = document.getElementById('horaCita');
            selectHora.innerHTML = '';

            var horaInicio = 7; // Hora de inicio (7:00 AM)
            var horaFin = 16; // Hora de fin (4:00 PM)
            var incrementoMinutos = 20; // Incremento en minutos

            for (var hora = horaInicio; hora <= horaFin; hora++) {
                for (var minuto = 0; minuto < 60; minuto += incrementoMinutos) {
                    var horaTexto = hora.toString().padStart(2, '0');
                    var minutoTexto = minuto.toString().padStart(2, '0');
                    var opcion = document.createElement('option');
                    opcion.value = horaTexto + ':' + minutoTexto;
                    opcion.text = horaTexto + ':' + minutoTexto;
                    selectHora.appendChild(opcion);
                }
            }
        }

        // Llamar a la función para generar las opciones de hora al cargar la página
        generarOpcionesHora();

        // Función para validar la selección de hora antes de enviar el formulario
        function validarSeleccionHora() {
            var hora = document.getElementById('horaCita').value;
            if (hora === '') {
                alert('Debe seleccionar una hora');
                return false;
            }
            return true;
        }
    </script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>