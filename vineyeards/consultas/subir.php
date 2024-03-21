<?php

include_once('db.php');

$file_name = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
$route = "files_csv/".$file_name;
$id_medir=$_POST['id_medir'];

echo $file_name,' ',$file_tmp,' ',$route, $id_medir;

$conectar=$conexion;
    $query="INSERT INTO path (path_espec, id_medir) values ('$route','$id_medir')"; 
    
	$result = mysqli_query($conectar, $query)or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);

	if ($result) {
        move_uploaded_file($file_tmp,$route);        
        header("location: ../principal/principal.php");
    } else {
        ?> 
        <h3 class="bad">¡Ups ha ocurrido un error!</h3>
       <?php
    }




?>