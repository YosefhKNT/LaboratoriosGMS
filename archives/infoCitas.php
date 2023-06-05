<?php
ob_start();
require('../tcpdf/fpdf.php');

session_start();


if (!isset($_SESSION['folio'])) {
    header("Location: consultaCita.php");
}

if (isset($_POST['editarCita'])) {
    header("Location: editarCita.php");
}

$folio = $_SESSION['folio'];

// Conexión a la base de datos
require 'conexion.php';

$query_join = "SELECT citas.id as id, 
citas.nombre as nombre, 
citas.fecha as fecha, 
citas.hora as hora, 
citas.telefono as telefono, 
citas.clave as clave, 
citas.resultados as resultados,
citas.estatus as estatus,
estudio.estudio as estudio,  
area.area as area, 
laboratorista.nombre as laboratorista 
FROM citas 
INNER JOIN estudio ON citas.estudio_id = estudio.id 
INNER JOIN area ON estudio.area_id = area.id 
INNER JOIN laboratorista ON citas.laboratorista_id = laboratorista.id 
WHERE citas.id = '$folio';";

$result = mysqli_query($conn, $query_join);

if ($result->num_rows > 0) {
    // Si hay resultados, muestra la tabla de citas

?>

    <html>

    <head>
        <title>GMS | Citas</title>
        <link rel="stylesheet" type="text/css" href="../styles/stylesCitas.css">
        <?php
        include("../Plantillas/head.html");
        ?>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg nav-custom" style="background-color: #3f51b5">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="../index.php">
                    <img src="../Images/GMS-Logo1.png" alt="Logo" width="60" height="24" class="d-inline-block align-text-top" />
                    Laboratorios GMS
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Volver al Inicio</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        if (isset($_SESSION['modal'])) {
            echo "
                <div id='myModal' class='modal px-5'>
                    <div class='modal-content text-center p-5'>
                        <button id='closeBtn' class='btn-close' aria-label='Close'></button>
                        <h2>¡Importante!</h2>
                        <p>Por favor, no olvides descargar tu informacion de cita y resultados.</p>
                        <form method='post' class='text-center'>
                            <div class='d-grid gap-2 col-6 mx-auto'>

                                <button class='btn btn-success btn-lg' id='myBtn' type='submit' name='pdf' value='Descargar PDF'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='currentColor' class='bi bi-arrow-down-circle-fill' viewBox='0 0 16 16'>
                                        <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z' />
                                    </svg>
                                    Descargar mi información</button>
                                <div id='liveAlertPlaceholder'></div>
                            </div>

                        </form>
                    </div>
                </div>";
        }
        ?>



        <div class="container-fluid px-5">
            <h1 class="text-center fw-bold py-3">Informacion de su Cita</h1>
            <!-- 
            Agendada: #ADD8E6 o #90EE90
            Pendiente de resultados: #FFFF00 o #FFA500
            Completada: #008000 o #000080
            Cancelada: #FF0000 o #808080
            No se presentó: #8B0000 o #000000 
            -->
            <div class="container-fluid text-end pt-3">
                <div style="width: auto;">
                    <strong>Status: </strong>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = $row['estatus'];
                        if ($status == "Agendada") {
                            echo "<strong class='bg-primary text-center rounded px-2 py-1' style='color: #fefefe;'> " . $status . "</strong>";
                        } else if ($status == "Pendiente de resultados") {
                            echo "<strong class='text-center rounded px-2 py-1' style='color: #000; background-color: #FFFF00;'> " . $status . " </strong>";
                        } else if ($status == "Completada") {
                            echo "<strong class='text-center rounded px-2 py-1' style='color: #fff; background-color: #008000;'> " . $status . " </strong>";
                        } else if ($status == "Cancelada") {
                            echo "<strong class='text-center rounded px-2 py-1' style='color: #fefefe; background-color: #FF0000;'> " . $status . " </strong>";
                        } else if ($status == "No se presentó") {
                            echo "<strong class='text-center rounded px-2 py-1' style='color: #fefefe; background-color: #8B0000;'> " . $status . " </strong>";
                        }else{
                            echo "<strong class='text-center rounded px-2 py-1' style='color: #fefefe; background-color: #000;'>Sin Estatus</strong";
                        }
                    ?>
                </div>
            </div>
            <table class="table table-striped table-bordered caption-top mt-2">
                <thead class="">
                    <tr class="tr-head text-center text-bg-primary">
                        <th>Folio</th>
                        <th>Clave</th>
                        <th>Nombre del paciente</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php
                        $folio = $row['id'];
                        $clave = $row['clave'];
                        $nombre = $row['nombre'];
                        $fecha = $row['fecha'];
                        $hora = $row['hora'];
                        $telefo = $row['telefono'];
                        $area = $row['area'];
                        $estudio = $row['estudio'];
                        $resultados = $row['resultados'];

                        echo "<tr>";
                        echo "<td><center>" . $row['id'] . "</center></td>";
                        echo "<td><center><p class='user-select-all'>" . $row['clave'] . "</p></center></td>";
                        echo "<td><center>" . $row['nombre'] . "</center></td>";
                        echo "<td><center>" . $row['telefono'] . "</center></td>";
                        echo "</tr> ";
                        echo "<tr class='tr-head text-center tc-light text-bg-primary'>";
                        echo "<th>Fecha</th>";
                        echo "<th>Hora</th>";
                        echo "<th>Área</th>";
                        echo "<th>Estudio</th>";
                        echo "</tr> <tr>";
                        echo "<td><center>" . $row['fecha'] . "</center></td>";
                        echo "<td><center>" . $row['hora'] . "</center></td>";
                        echo "<td><center>" . $row['area'] . "</center></td>";
                        echo "<td><center>" . $row['estudio'] . "</center></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='8'> <b>Resultados: </b></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td colspan='8'>" . $row['resultados'] . "</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <div clas="container text-center">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3">
                    <!-- BOTON DESCARGAR INFORMACION-->
                    <div class="col-md">
                        <form method='post' class="">
                            <div class="row row-auto px-1">
                                <button class="btn btn-success btn-lg " id="liveAlertBtn" type='submit' name="pdf" value="Descargar PDF">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                    </svg>
                                    Descargar</button>
                                <div id="liveAlertPlaceholder"></div>
                            </div>
                        </form>
                    </div>

                    <!-- Boton EDITAR CITA -->
                    <div class="col-md">
                        <form method='post' action="editarCita.php">
                            <div class="row row-auto px-1">
                                <button class="btn btn-warning btn-lg" type='submit' name="editarCita" value="Editar Cita">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                    Editar mi Cita</button>
                            </div>
                        </form>
                    </div>

                    <!-- Boton CANCELAR CITA -->
                    <div class="col-md">
                        <form method='' class="">
                            <div class="row row-auto px-1">
                                <button class="btn btn-danger btn-lg" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" name="cancelarCita" value="Cancelar Cita">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                    </svg>
                                    Cancelar Cita
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <?php
                // Verificar si existe la variable de sesión "mensaje"
                if (isset($_SESSION['mensaje'])) {
                    $mensaje = $_SESSION['mensaje'];

                    // Mostrar el mensaje
                    echo '<div class="container-fliud text-center ">
                    <div class="alert alert-success" role="alert">
                        ' . $mensaje . '
                    </div>
                </div>';

                    // Eliminar la variable de sesión
                    unset($_SESSION['mensaje']);
                }
                ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">¡Importante</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Seguro que quiere cancelar su cita, una vez cancelada, no podra acceder a la informacion de la misma.
                            <br><br>
                            ¿Desea cancelar su cita?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                            <form action="../archives/cancelarCita.php" method="post">
                                <input type="hidden" name="folio" value="<?php echo $folio; ?>">
                                <button type="submit" class="btn btn-outline-primary" name="cancelarCita">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>
    <!-- Script para realizar un alert -->
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

    <!-- Modal Script -->
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var btnClose = document.getElementById("closeBtn");

        window.onload = function() {
            modal.style.display = "block";
        }


        btnClose.onclick = function() {
            modal.style.display = "none";
        }

        btn.onclick = function() {
            modal.style.display = "none";
        }
    </script>

    </html>

<?php
} else { // Si no hay resultados, muestra un mensaje de error
    echo "No se encontró una cita con el folio ingresado.";
}

if (isset($_POST['pdf'])) {
    // Generar el PDF
    ob_clean();
    require('../TCPDF-main/tcpdf.php');

    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('FreeSans', 'B', 16);
    $pdf->Cell(0, 10, 'Cita Médica', 0, 1, 'C');
    $pdf->Line(10, 30, 200, 30);
    $pdf->Rect(10, 40, 190, 240);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Folio:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(40, 20);
    $pdf->Cell(0, 10, $folio, 0, 0);

    $pdf->SetXY(158, 20);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Clave:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(178, 20);
    $pdf->Cell(0, 10, $clave, 0, 0);

    $pdf->SetXY(10, 40);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Nombre del paciente:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(60, 40);
    $pdf->Cell(0, 10, $nombre, 0, 1);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Fecha:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(60, 50);
    $pdf->Cell(0, 10, $fecha, 0, 1);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Hora:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(60, 60);
    $pdf->Cell(0, 10, $hora, 0, 1);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Área:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(60, 70);
    $pdf->Cell(0, 10, $area, 0, 1);
    $pdf->SetFont('FreeSans', 'B', 12);
    $pdf->Cell(0, 10, 'Estudio:', 0, 0);
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(60, 80);
    $pdf->Cell(0, 10, $estudio, 0, 1);

    $pdf->SetFont('FreeSans', 'B', 16);
    $pdf->Cell(0, 10, 'Resultados:', 0, 1, 'C');
    $pdf->SetFont('FreeSans', '', 12);
    $pdf->SetXY(10, 100);
    $pdf->MultiCell(0, 10, $resultados, 0, 'L');
    $pdf->Output($fecha . '_FOLIO_' . $folio . '_' . $nombre . '.pdf', 'D');
}

mysqli_close($conn);

?>