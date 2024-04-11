<?php
require_once('../detallesmuestras/db-config.php');
try {
    if ( isset($_GET['id_analisis'])  && ctype_digit($_GET['id_analisis']) ) {
        $sampleID = intval($_GET['id_analisis']);
        $activar= $_GET['activar'];

            $statement = $connection->prepare("UPDATE analisis_sensorial SET activo= '".$activar."' WHERE `id_analisis_sensorial` = ?");

            $statement->execute(array($sampleID));
            header("Location: tablaanalisis.php");
    }
    else{
        header("Location: tablaanalisis.php");
    }
} catch (PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}

?>
