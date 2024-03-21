<?php

require '../consultas/db.php';

$message = '';
session_start();
if (isset($_SESSION['Tipo'])) {
  header('Location: ../principal/principal.php');
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Registro | </title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <?php if (!empty($message)) : ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <h1>Registro</h1>
  <span>o <a href="login.php">Inicia sesión</a></span>

  <form action="../consultas/ModelUsuario.php" method="POST">
    <input name="nombre" type="text" placeholder="Ingresa tu nombre" required>
    <input name="apellidoPaterno" type="text" placeholder="Ingresa tu apellido paterno" required>
    <input name="apellidoMaterno" type="text" placeholder="Ingresa tu apellido materno">
    <input name="email" type="text" placeholder="Ingresa tu correo">
    <select name="rol" id="rol" required>
      <option value="" selected>Seleccionar rol</option>

      <option value="2">Investigador</option>
      <option value="3">Tecnico</option>
      <option value="4">Recolector</option>
    </select>
    <input name="pass" type="password" placeholder="Ingresa tu contraseña" required>
    <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">

    <input type="submit" name="submitInsert" value="Crear perfil">
  </form>

  <?php require '../partials/footer.php' ?>

</body>

</html>