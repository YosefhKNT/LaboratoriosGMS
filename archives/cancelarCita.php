<?php
ob_start();
// Conexión a la base de datos
require 'conexion.php';

if (isset($_POST['cancelarCita'])) {
    // Obtener el valor de $folio desde $_POST
    $folio = $_POST['folio'];

    // Realizar la eliminación de la cita
    $sql_delete = "DELETE FROM `citas` WHERE `citas`.`id` = '$folio'";
    $result = mysqli_query($conn, $sql_delete);

    if ($result) {
        session_start();
        header("Location: ../archives/logout.php");
        exit(); // Terminar la ejecución del script después de redireccionar
    } else {
        echo "Error al borrar la cita";
    }
}
