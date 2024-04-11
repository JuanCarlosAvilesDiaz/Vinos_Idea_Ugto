<?php
require_once('detallesmuestras/db-config.php');


$_SESSION['user'] = $_POST['Email'];
$nombreUsuario = $_POST['Email'];
$passUsuario= $_POST['pass'];

// Verificamos si el usuario ya inició sesión
if (isset($_SESSION['user'])) {

    $validar = $connection->prepare("SELECT * FROM usuario WHERE (nombre = '".$nombreUsuario."' OR correo_electronico = '".$nombreUsuario."') AND clave = '".$passUsuario."' AND id_tipo_usuario = 1");
    $validar->execute();

    if ($validar->rowCount() >= 1) {       
        session_start(); 
        header("Location: /vinosyproductos/main/");    
    } 
    else {
        header("Location: /vinosyproductos/");
    }
    
     $_SESSION['timeout'] = time(); // Actualizamos el tiempo de inactividad
} 
else if(isset($_GET['salir']))
{
    // Para cerrar la sesión manualmente, puedes crear un botón de "Cerrar sesión" en tu página y vincularlo a un script de PHP
    if ($_GET['salir'] == "si") {
        session_unset(); // Cerramos la sesión
        session_destroy();
        header("Location: /vinosyproductos/"); // Redirigimos al login
        exit();
    }
}
else {
    // Si el usuario no ha iniciado sesión y no está en la página de inicio de sesión, redirigimos al login
    if (basename($_SERVER['PHP_SELF']) != "index.html") {
        header("Location: /vinosyproductos/");
        exit();
    }
}




?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Control</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['Email']; ?></h1>
    <form method="post">
        <input type="submit" name="logout" value="Cerrar sesión">
    </form>
    <!-- Aquí puedes colocar el contenido de tu página protegida por sesión -->
</body>
</html>
