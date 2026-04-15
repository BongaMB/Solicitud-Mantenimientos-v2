<?php
 $conexion = mysqli_connect("localhost:3306" , "root" , "" , "mantenimientos");
if(!$conexion){ 
    // Si falla la conexión, muestra error y termina
    echo "Error";
}
// Inicia la sesión para guardar datos del usuario logueado
session_start();


// Obtiene datos del formulario (usuario y contraseña)
$correo = $_POST['correo'];  
$contraseña = $_POST['contra'];


// Consulta SQL: busca usuario con nombre Y contraseña exactos
$query = "Select * from usuarios where correo='$correo' and contraseña='$contraseña'";
$resultado = mysqli_query($conexion , $query);


// Si la consulta es exitosa Y encuentra al menos 1 usuario
if($resultado && mysqli_num_rows($resultado) > 0) {  
    // Obtiene los datos del usuario encontrado como array
    $filas = mysqli_fetch_array($resultado);
    
    // Guarda nombre de usuario en sesión (para usarlo en otras páginas)
    $_SESSION['correo']=$correo;   // ← aquí antes usabas $usuario (no existe)


    // Redirige según rol del usuario (columna 'idrol' de la tabla)
    if($filas['idrol'] == 1) {
        // Admin: rol 1 → página de administrador
            header("Location: ../Administrador/index.php");
            exit();
        }
        elseif($filas['idrol'] == 2) {
        // Cliente: rol 2 → página de cliente
            header("Location: ../Correctivos/inicioUsr.php");
            exit();
        }
        elseif($filas['idrol']==3){
            header("location: ../Solicitud/SolicitudClt.php");
            exit();
        }
        else {                      // ← este else se queda
        // Otros roles → regresa al login
            header("Location: index.php"); 
            exit();
        }
} 
else { 
    // Usuario o contraseña incorrectos → regresa al login
    header("Location: index.php");
    exit();
}


// Limpia memoria del resultado de la consulta
mysqli_free_result($resultado);
// Cierra conexión a base de datos
mysqli_close($conexion);  
?>
