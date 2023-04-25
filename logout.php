<?php

// Cerrar sesión
session_start();
session_unset();
session_destroy();

// Redirigir a la página de inicio de sesión
header("Location: index.php");
exit();

?>