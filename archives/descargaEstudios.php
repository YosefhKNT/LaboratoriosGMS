<?php

ob_start();
require 'conexion.php';
require('../tcpdf/fpdf.php');

session_start();

if (!isset($_SESSION['folio'])) {
    header("Location: hacerCita.php");
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
    }

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

    header("Location: logout.php");
} else { // Si no hay resultados, muestra un mensaje de error
    echo "No se encontró una cita con el folio ingresado.";
    header("Location: hacerCita.php");
}
// require 'logout.php';
mysqli_close($conn);
