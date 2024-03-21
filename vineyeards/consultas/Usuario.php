<?php
include_once('db.php');
      $contra = password_hash('$VinosGto2022', PASSWORD_BCRYPT);
      $query="UPDATE usuario SET clave='".$contra."' WHERE id_usuario = 15;"; 

	   $result = mysqli_query($conexion, $query)or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);

      if ($result) {
         echo 'ACTUALIZADO';
      } else {
        ?> 
        <h3 class="bad">¡Ups ha ocurrido un error!</h3>
        <?php
     }
     ?>