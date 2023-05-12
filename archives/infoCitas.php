<?php
ob_start();
require('../tcpdf/fpdf.php');

session_start();

if (!isset($_SESSION['folio'])) {
    header("Location: FORMS\consultaCita.php");
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
resultados.resultados as resultados, 
estudio.estudio as estudio, 
area.area as area, 
laboratorista.nombre as laboratorista 
FROM citas 
INNER JOIN estudio ON citas.estudio_id = estudio.id 
INNER JOIN area ON estudio.area_id = area.id 
INNER JOIN laboratorista ON citas.laboratorista_id = laboratorista.id 
LEFT JOIN resultados ON citas.resultados_id = resultados.id 
WHERE citas.id = '$folio';";

$result = mysqli_query($conn, $query_join);

if ($result->num_rows > 0) {
    // Si hay resultados, muestra la tabla de citas

?>

    <html>

    <head>
        <title>GMS | Citas</title>
        <!-- <link rel="stylesheet" type="text/css" href="../styles/stylesCitas.css"> -->
        <?php
        include("../Plantillas/head.html");
        ?>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg nav-custom" style="background-color: #3f51b5">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="../index.php">
                    <img src="../Images/GMS-Logo.png" alt="Logo" width="60" height="24" class="d-inline-block align-text-top" />
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


        <div class="container">
            <h1 class="text-center">Cita</h1>

            <table class="table table-striped table-bordered caption-top">
                <caption>Datos de la cita</caption>
                <thead class="">
                    <tr class="tr-head text-center text-bg-primary">
                        <th>Folio</th>
                        <th>Clave</th>
                        <th>Nombre del paciente</th>
                        <th>Telefono</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Área</th>
                        <th>Estudio</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
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
                        echo "<td><center>" . $row['clave'] . "</center></td>";
                        echo "<td><center>" . $row['nombre'] . "</center></td>";
                        echo "<td><center>" . $row['telefono'] . "</center></td>";
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
            <form method='post' class="text-center">
                <div class="d-grid gap-2 col-6 mx-auto">

                    <button class="btn btn-success btn-lg" id="liveAlertBtn" type='submit' name="pdf" value="Descargar PDF">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                        </svg>
                        Descargar mi información</button>
                    <div id="liveAlertPlaceholder"></div>
                </div>

            </form>

            <div class="container-fluid text-center fixed-bottom bg-danger">

                <div class="row m-5">
                    <div class="col col-lg-1 float-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="white" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </svg>
                    </div>
                    <div class="col">
                        <p class="fw-bold text-light fs-3 ">
                            NO OLVIDES DESCARGAR TUS DATOS, SERA LA UNICA VEZ QUE SE TE DARA TU <strong>"FOLIO" Y "CLAVE"</strong>
                        </p>
                    </div>
                </div>
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
            </div>



            <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>

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