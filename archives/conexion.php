<?php

//Conexión a la base de datos
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "laboratorio";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Fallo en la conexión: " . mysqli_connect_error());
}

// // Conexión a la base de datos
// $host     = "31.170.167.204";
// $username = "u988276755_root";
// $password = "!Knt_1478523690!";
// $dbname   = "u988276755_laboratoriogms";

// $conn = mysqli_connect($host, $username, $password, $dbname);

// if (!$conn) {
//     die("Fallo en la conexión: " . mysqli_connect_error());
// }
