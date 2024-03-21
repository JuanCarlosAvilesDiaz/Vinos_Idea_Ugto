<?php
include_once('db.php');
//recibo toso los datos del formulario
$id_arregloexp=$_POST['id_arregloexp'];
$tipo_de_muestra='Uva';
$id_muestra=$_POST['id_muestra'];
$id_palabra=$_POST['id_palabra'];
$id_equipo=$_POST['id_equipo'];
$vol_gota=$_POST['vol_gota'];
$uni_vol_gota=$_POST['uni_vol_gota'];
$dur_gota=$_POST['dur_gota'];
$uni_dur_gota=$_POST['uni_dur_gota'];
$dur_medida=$_POST['dur_medida'];
$uni_dur_medida=$_POST['uni_dur_medida'];
$temp_ambiente=$_POST['temp_ambiente'];
date_default_timezone_set('America/Mexico_City');
$fecha_actual=date("Y-m-d H:i:s");
$uni_temp_ambiente=$_POST['uni_temp_ambiente'];
$descripcion=$_POST['descripcion'];


//echo "Los datos son los siguiente: <br>";
//echo "$id_arregloexp,$tipo_de_muestra,$id_muestra,$id_palabra,$id_equipo,$vol_gota,$uni_vol_gota,$dur_gota,$uni_dur_gota,$dur_medida,$uni_dur_medida,$temp_ambiente,$uni_temp_ambiente,$descripcion";


	$conectar=$conexion;
    $query="INSERT INTO medir (id_arregloexp, tipo_de_muestra, id_muestra_uva, id_palabra, id_equipo, vol_gota, uni_vol_gota, dur_gota, uni_dur_gota, dur_medida, uni_dur_medida, temp_ambiente, uni_temp_ambiente, descripcion, fecha) values ('$id_arregloexp', '$tipo_de_muestra','$id_muestra','$id_palabra', '$id_equipo', '$vol_gota', '$uni_vol_gota', '$dur_gota', '$uni_dur_gota','$dur_medida', '$uni_dur_medida', '$temp_ambiente', '$uni_temp_ambiente', '$descripcion', '$fecha_actual')"; 
    
	$result = mysqli_query($conectar, $query)or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);

	if ($result) {
        
       header("location: ../principal/registrosUva.php");
    } else {
        ?> 
        <h3 class="bad">¡Ups ha ocurrido un error!</h3>
       <?php
    }
 


?>