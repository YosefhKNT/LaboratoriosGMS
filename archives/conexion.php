<?php

// Conexión a la base de datos
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "laboratorio";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Fallo en la conexión: " . mysqli_connect_error());
}
