<?php
require_once('../detallesmuestras/db-config.php');

$nombre = $_POST['nombre'];

$tipo = $_POST['tipo'];

$fecha = $_POST['fecha'];

$marca = $_POST['marca'];

$procedencia = $_POST['procedencia'];

$codigo = $_POST['codigo'];

try {
    $statement = $connection->prepare("INSERT INTO producto(tipo_producto, nombre, marca, fecha_elavoracion, procedencia, orden, codigo) 
                                      VALUES ('".$tipo."','".$nombre."','".$marca."','".$fecha."','".$procedencia."','S/O','".$codigo."')");
    $statement->execute();

    header("Location: /vinosyproductos/detallesmuestras");
    

} catch (PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}

?>


