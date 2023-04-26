<?php
// Conectar a la base de datos
require 'conexion.php';

// Obtener las horas
$fechaSeleccionada = $_GET['estudio'];

// Buscar el laboratorista correspondiente al estudio
$consulta = "SELECT hora FROM `citas` WHERE `fecha`= '$fechaSeleccionada';";
$resultado = mysqli_query($conn, $consulta);

// Crear un arreglo para guardar los resultados
$resultados = array();

// Recorrer todas las filas del resultado y guardarlas en el arreglo
while ($fila = mysqli_fetch_assoc($resultado)) {
    $resultados[] = $fila['hora'];
}

// Devolver el resultado como una respuesta a la solicitud AJAX
if (!empty($resultados)) {
    echo json_encode($resultados);
} else {
    echo "";
}
mysqli_close($conn);
