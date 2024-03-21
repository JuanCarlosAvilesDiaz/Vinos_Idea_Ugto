<?php

$servidor="localhost";
$usuario="susana.avila";
$password='M4Sus@v1l4';
$db="viñedos_ideagto";
$conexion=mysqli_connect($servidor,$usuario,$password,$db) or die(mysqli_error($conexion));


//Conexion de manera local de Sierra
// $servidor="localhost";
// $usuario="root";
// $password='';
// $db="viñedos_ideagto";
// $conexion=mysqli_connect($servidor,$usuario,$password,$db) or die(mysqli_error());

?>