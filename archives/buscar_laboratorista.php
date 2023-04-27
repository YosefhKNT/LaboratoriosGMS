<?php
// Conectar a la base de datos
$conn = mysqli_connect("localhost", "root", "", "laboratorio");

// Obtener el estudio seleccionado
$estudio = $_GET['estudio'];

// Buscar el laboratorista correspondiente al estudio
$consulta = "SELECT area.area AS area, laboratorista.nombre AS laboratorista 
FROM estudio 
JOIN area ON estudio.area_id = area.id 
join area_laboratorista on area.id = area_laboratorista.area_id 
JOIN laboratorista ON area_laboratorista.laboratorista_id = laboratorista.id 
WHERE estudio.estudio = '$estudio';
";
$resultado = mysqli_query($conn, $consulta);

// Devolver el resultado como una respuesta a la solicitud AJAX
if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    echo $fila['laboratorista'];
} else {
    echo "";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
