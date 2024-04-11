<?php
require_once('../detallesmuestras/db-config.php');

$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$categoria = $_POST['category'];

try {
    $statement = $connection->prepare("INSERT INTO tipo_analisis_sensorial(nombre, fecha_evaluacion, id_categoria_evaluacion)
                                      VALUES ('".$nombre ."','".$fecha."','".$categoria."')");
    $statement->execute();

    header("Location: /vinosyproductos/detallesmuestras");
    

} catch (PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}
?>
