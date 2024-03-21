<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

if (isset($_SESSION['Tipo'])) {
  header('Location: ../principal/principal.php');
}

require '../consultas/db.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $query = "SELECT * FROM usuario WHERE correo_electronico ='".$_POST['email']."'";
  $result = mysqli_query($conexion, $query) or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);
  $valores = mysqli_fetch_array($result, MYSQLI_ASSOC);


  if ( isset( $valores) && password_verify($_POST['password'], $valores['clave'])) {
    $_SESSION['Tipo'] = $valores['id_tipo_usuario'];
    $_SESSION['nombre'] = $valores['nombre'];
    header("Location: ../principal/principal.php");
  } else {
    $message = 'Lo sentimos, estas credenciales no arrojan ningún resultado';
    
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Inicia sesión</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <h1>Inicio de sesión</h1>
  <span> o <a href="signup.php">Registro</a></span>

  <?php if (!empty($message)) : ?>
    <p> <?=   $message; ?></p>
  <?php endif; ?>

  <form action="login.php" method="post">
    <input type="text" name="email" placeholder="Ingresa tu correo">
    <input type="password" name="password" placeholder="Ingresa tu contraseña">
    <input type="submit" value="Aceptar">
  </form>

  <?php
  require('../partials/footer.php');
  ?>
</body>

</html>