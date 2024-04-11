<?php
require_once('../detallesmuestras/db-config.php');

$sampleID = intval($_GET['product-id']);
$registrosCabeceras = $connection->prepare("SELECT DISTINCT id_caracteristica, ce.nombre as nombre_caracteristica FROM resultado_analisis_sensorial AS re
                                            INNER JOIN caracteristica_evaluacion AS ce ON ce.id_caracteristica_evaluacion = re.id_caracteristica
                                            WHERE re.id_producto = $sampleID");                                
$registrosCabeceras->execute(); 
$cabeceras = $registrosCabeceras->fetchAll();

$ca = 0;
foreach ($cabeceras as $cabeza)
{
    $re = 0;
    $caracteristica[$ca] = $cabeza["nombre_caracteristica"];
    $idCaracteristica[$ca] = $cabeza["id_caracteristica"];

    $registroResultados = $connection->prepare("SELECT *, pro.nombre AS Codigo, pro.tipo_producto AS Nombre, pro.marca AS Marca, us.apellido_paterno AS Usuario, val.nombre AS Resultado FROM resultado_analisis_sensorial AS re
                                                INNER JOIN producto AS pro ON pro.id_producto = re.id_producto
                                                INNER JOIN usuario AS us ON us.id_usuario = re.id_evaluador
                                                INNER JOIN valor_evaluacion AS val ON val.id_valor_evaluacion = re.id_valor
                                            WHERE re.id_producto = $sampleID AND re.id_caracteristica = ".$idCaracteristica[$ca]."
                                            ORDER BY id_valor");                               
    $registroResultados->execute(); 
    $resultados = $registroResultados->fetchAll();
    $data[$ca]=$resultados;

    $ca = $ca +1;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Respuestas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="../main/images/LogoUgto.png" type="image/x-icon">
<link rel="icon" href="../main/images/LogoUgto.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    body {
  margin: 0;
  height: 100%;
  background: linear-gradient(to bottom left, #ffffff 15%, #cce3ff 90%);
  font: 600 16px/18px "Open Sans", sans-serif;
}
h1{margin-left: 42%;
    margin-top: 5%;}
.mitabla {
            position: static;
            max-width: 80%;
            width: 100%;
            max-height: 600px; /* Altura máxima para la tabla con scroll */
            overflow-y: auto;  /*Añade un scroll vertical si la tabla excede la altura máxima */
            background: #07203e;
            padding: 2px 2px 0px 2px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .mitabla thead th {
            position: sticky;
            top: 0;
            background: #07203e;
            z-index: 1;
        }

.btnSalir {
   position: absolute;
  
  font-size: 1.2rem;
  text-decoration: none;
  padding: 1rem 2.5rem;
  border: none;
  outline: none;
  border-radius: 0.4rem;
  cursor: pointer;
  text-transform: uppercase;
  background-color: rgb(14, 14, 26);
  color: rgb(234, 234, 234);
  font-weight: 700;
  transition: 0.6s;
  box-shadow: 0px 0px 60px #1f4c65;
  -webkit-box-reflect: below 10px linear-gradient(to bottom, rgba(0,0,0,0.0), rgba(0,0,0,0.4));
}

.btnSalir:active {
  scale: 0.92;
}

.btnSalir:hover {
  background: rgb(2,29,78);
  background: linear-gradient(270deg, rgba(2, 29, 78, 0.681) 0%, rgba(31, 215, 232, 0.873) 60%);
  color: rgb(4, 4, 38);
}
</style>
</head>
<body>
<a href="/vinosyproductos/detallesmuestras/" class="btnSalir">
    REGRESAR
</a>
<div style="width: 70%; margin: auto;">
        <?php       
        for ($i = 0; $i < 5; $i++) { 
        ?>
        <h1><?php echo $caracteristica[$i]; ?></h1>
        <div class="mitabla">
<table class="table table-hover table-dark">
  <thead>
    <tr >
      <th scope="col">Producto</th>
      <th scope="col">Marca</th>
      <th scope="col">Código</th>
      <th scope="col">Fecha de la evaluación</th>
      <th scope="col">Evaluador</th>
      <th scope="col">Respuesta</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($data[$i] as $registro): ?>
    <tr class="bg-success">
      <th scope="row"><?php echo $registro['Nombre']; ?></th>
      <td><?php echo $registro['Marca']; ?></td>
      <td><?php echo $registro['Codigo']; ?></td>      
      <td><?php echo $registro['fecha']; ?></td>
      <td><?php echo $registro['Usuario']; ?></td>
      <td><?php echo $registro['Resultado']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
<h2>Total de participantes: <?php echo count($data[$i]); ?></h2>
        <?php
        
        }
        ?>
    </div>
</body>
</html>