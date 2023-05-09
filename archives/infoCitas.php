<?php
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

            <table class="table table-striped table-bordered caption-top ">
                <caption>Datos de la cita</caption>
                <thead class="">
                    <tr class="tr-head text-center text-bg-primary">
                        <th>Folio</th>
                        <th>Clave</th>
                        <th>Nombre del paciente</th>
                        <th>Telefono</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estudio</th>
                        <th>Área</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
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

                        $folio = $row['id'];
                        $clave = $row['clave'];
                        $nombre = $row['nombre'];
                        $fecha = $row['fecha'];
                        $hora = $row['hora'];
                        $telefo = $row['telefono'];
                        $area = $row['area'];
                        $estudio = $row['estudio'];
                        $resultados = $row['resultados'];
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <form method='post' class="text-center">
            <button class="btn btn-outline-success" type='submit' name="download" value="Descargar PDF">Descargar Resultados</button>
        </form>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <input type="hidden">
    </body>
    </html>

<?php
} else { // Si no hay resultados, muestra un mensaje de error
    echo "No se encontró una cita con el folio ingresado.";
}


if (isset($_POST['download'])) {
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