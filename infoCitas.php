<?php
require('tcpdf\fpdf.php');

session_start();

if (!isset($_SESSION['folio'])) {
    header("Location: consultaCyR.php");
}

$folio = $_SESSION['folio'];
// Conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "laboratorio";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Fallo en la conexión: " . mysqli_connect_error());
}

$query_join = "SELECT citas.id as id, citas.nombre as nombre, 
        citas.fecha as fecha, citas.hora as hora, 
        citas.telefono as telefono, citas.clave as clave, 
        resultados.resultados as resultados, estudio.estudio as estudio, 
        area.area as area, laboratorista.nombre as laboratorista
FROM citas
INNER JOIN resultados ON citas.resultados_id = resultados.id
INNER JOIN estudio ON citas.estudio_id = estudio.id
INNER JOIN area ON estudio.area_id = area.id
INNER JOIN laboratorista ON citas.laboratorista_id = laboratorista.id
WHERE citas.id = '$folio'";

$query = "SELECT citas.id as id, citas.nombre as nombre, 
        citas.fecha as fecha, citas.hora as hora, 
        citas.telefono as telefono, citas.clave as clave, 
        estudio.estudio as estudio, area.area as area, 
        laboratorista.nombre as laboratorista
FROM citas
INNER JOIN estudio ON citas.estudio_id = estudio.id
INNER JOIN area ON estudio.area_id = area.id
INNER JOIN laboratorista ON citas.laboratorista_id = laboratorista.id
WHERE citas.id = '$folio'";
$result = mysqli_query($conn, $query_join);

if ($result->num_rows > 0) {
    // Si hay resultados, muestra la tabla de citas

?>

    <html>

    <head>
        <title>Citas</title>
        <link rel="stylesheet" type="text/css" href="styles/stylesCitas.css">
        <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
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

    <body>
        <header>
            <h1>Laboratorio GMS</h1>
            <a href="logout.php" class="logout">Volver al inicio</a>
        </header>
        <h1>Citas</h1>
        <table>
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Nombre del paciente</th>
                    <th>Telefono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Área</th>
                    <th>Estudio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['hora'] . "</td>";
                    echo "<td>" . $row['area'] . "</td>";
                    echo "<td>" . $row['estudio'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='7'> <b>Laboratorista: </b>" . $row['laboratorista'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='7'>" . $row['resultados'] . "</td>";
                    echo "</tr>";

                    $folio = $row['id'];
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
        <form method='post'>
            <button type='submit' name="download" value="Descargar PDF">Descargar Resultados</button>
        </form>
    </body>

    </html>

<?php
} else if ($result = mysqli_query($conn, $query)) {
?>

    <html>

    <head>
        <title>Citas</title>
        <link rel="stylesheet" type="text/css" href="styles/stylesCitas.css">
        <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
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

    <body>
        <header>
            <h1>Laboratorio GMS</h1>
            <a href="logout.php" class="logout">Volver al inicio</a>
        </header>
        <h1>Citas</h1>
        <table>
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Nombre del paciente</th>
                    <th>Telefono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Área</th>
                    <th>Estudio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['hora'] . "</td>";
                    echo "<td>" . $row['area'] . "</td>";
                    echo "<td>" . $row['estudio'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='7'> <b>Laboratorista: </b>" . $row['laboratorista'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='7'> Sin Resultados</td>";
                    echo "</tr>";

                    $folio = $row['id'];
                    $nombre = $row['nombre'];
                    $fecha = $row['fecha'];
                    $hora = $row['hora'];
                    $telefo = $row['telefono'];
                    $area = $row['area'];
                    $estudio = $row['estudio'];
                    //$resultados = $row['resultados'];
                }
                ?>
            </tbody>
        </table>
        <form method='post'>
            <button type='submit' name="download" value="Descargar PDF">Descargar Resultados</button>
        </form>
    </body>

    </html>

<?php
} else { // Si no hay resultados, muestra un mensaje de error
    echo "No se encontró una cita con el folio ingresado.";
}
if (isset($_POST['download'])) {
    // Generar el PDF
    ob_clean();
    require('TCPDF-main\tcpdf.php');

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
    $pdf->Output($fecha . '_FOLIO_' . $folio . '.pdf', 'D');
}

mysqli_close($conn);

?>