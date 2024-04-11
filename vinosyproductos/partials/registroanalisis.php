<?php
require_once('../detallesmuestras/db-config.php');

$nombreAnalisis = $_POST['nombreanalisis'];
$tipo = $_POST['tipo'];
$idProducto = $_POST['idproducto'];

if(isset($nombreAnalisis)  && ctype_digit($tipo))
{
    try {
        $tipoID = intval($tipo);
        $validar = $connection->prepare("SELECT * FROM analisis_sensorial WHERE nombre = '".$nombreAnalisis."' AND activo = 'Si' AND id_tipo_analisis_sensorial = '".$tipoID."'");

        $validar->execute();

        if ($validar->rowCount() >= 1) {       
            header("Location: /vinosyproductos/detallesmuestras/product-detail.php?product-id=".$idProducto."&existe=si");    
        }
        else
        {
            $statement = $connection->prepare("SELECT * FROM tipo_analisis_sensorial WHERE id_tipo_analisis_sensorial = ?");

            $statement->execute(array($tipoID));

            $row = $statement->fetch();
            $fechaEvaluacion = $row['fecha_evaluacion'];
            $idCategoria = $row['id_categoria_evaluacion'];

            $registroAnalisis = $connection->prepare("INSERT INTO analisis_sensorial (id_tipo_analisis_sensorial, nombre, asesor, fecha, privado, activo)
                                                    VALUES ('".$tipo ."','".$nombreAnalisis."','13','".$fechaEvaluacion."','No','Si')");

            $registroAnalisis->execute(); 

            $rowIdAnalisis = $connection->prepare("SELECT id_analisis_sensorial FROM analisis_sensorial WHERE 1 ORDER BY id_analisis_sensorial DESC LIMIT 1");
            $rowIdAnalisis->execute(); 
            $idAnalisis = $rowIdAnalisis->fetch();

            $rowIdCaracteristica = $connection->prepare("SELECT * FROM caracteristica_evaluacion WHERE id_categoria_evaluacion = '".$idCategoria."' ORDER BY id_caracteristica_evaluacion");
            $rowIdCaracteristica->execute(); 
            $idCaracteristicas = $rowIdCaracteristica->fetchAll();

            foreach ($idCaracteristicas as $caracteristica)
            {
                $CaracteristicaID = intval($caracteristica['id_caracteristica_evaluacion']);
                $registroAnalisis = $connection->prepare("INSERT INTO detalle_analisis_sensorial(id_analisis_sensorial, id_producto, id_caracteristica_evaluacion)
                                                    VALUES ('".$idAnalisis['id_analisis_sensorial']."','".$idProducto."','".$CaracteristicaID."')");
                $registroAnalisis->execute(); 
            }

            header("Location: /vinosyproductos/detallesmuestras");
        }
        
    } catch (PDOException $exception) {
        echo "Connection failed: " . $exception->getMessage();
    }
}

?>