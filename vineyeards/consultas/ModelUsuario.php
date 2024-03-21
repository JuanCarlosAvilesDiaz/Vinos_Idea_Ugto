<?php
   if(isset($_POST['submitInsert'])){
      insertUsuario();
   }

    function insertUsuario()
    {
      include_once('db.php');
      $contra = password_hash($_POST['pass'], PASSWORD_BCRYPT);
      $query="INSERT INTO usuario (id_tipo_usuario, nombre, apellido_paterno, apellido_materno, correo_electronico, clave) values ('".$_POST['rol']."','".$_POST['nombre']."','".$_POST['apellidoPaterno']."','".$_POST['apellidoMaterno']."', '".$_POST['email']."','".$contra."')"; 
	   $result = mysqli_query($conexion, $query)or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);

      if ($result) {
         
         header("location: ../login/login.php");
      } else {
         ?> 
         <h3 class="bad">¡Ups ha ocurrido un error!</h3>
         <?php
      }
    }
   
    function actualizar(){
      include_once('db.php');
      $contra = password_hash('$VinosGto2022', PASSWORD_BCRYPT);
      $query="UPDATE usuario SET clave='".$contra."'"; 

	   $result = mysqli_query($conexion, $query)or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);

      if ($result) {
         
         header("location: ./login.php");
      } else {
         ?> 
         <h3 class="bad">¡Ups ha ocurrido un error!</h3>
         <?php
      }
    }
?>