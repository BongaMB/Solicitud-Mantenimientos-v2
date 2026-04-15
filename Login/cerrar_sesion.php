<?php
// Inicia la sesión para poder identificarla
session_start();

// Borra todas las variables de sesión (como 'correo')
session_unset();

// Destruye la sesión por completo
session_destroy();

// Redirige de vuelta a la pantalla de inicio de sesión
header("Location: ../Login/index.php");
exit();
?>

