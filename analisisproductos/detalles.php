<?php

require_once('db-config.php');

if ( isset($_GET['product-id'])  && ctype_digit($_GET['product-id']) ) {
    $sampleID = intval($_GET['product-id']);
    try {
            $statement = $connection->prepare("SELECT *, producto.nombre as nombre_producto, producto.marca as marca, producto.tipo_producto as tipo_producto,
                                            usuario.nombre as usuario FROM ap_prueba_gusto
                                            INNER JOIN producto ON ap_prueba_gusto.id_producto = producto.id_producto
                                            INNER JOIN usuario ON ap_prueba_gusto.id_evaluador = usuario.id_usuario
                                            WHERE ap_prueba_gusto.id_producto = ".$sampleID." ORDER BY ap_prueba_gusto");
            $statement->execute();
            $gustos = $statement->fetchAll();
            
            $statement2 = $connection->prepare("SELECT *, producto.nombre as nombre_producto, producto.marca as marca, producto.tipo_producto as tipo_producto,
                                            usuario.nombre as usuario FROM ap_prueba_segmentada
                                            INNER JOIN producto ON ap_prueba_segmentada.id_producto = producto.id_producto
                                            INNER JOIN usuario ON ap_prueba_segmentada.id_evaluador = usuario.id_usuario
                                            WHERE ap_prueba_segmentada.id_producto = ".$sampleID." ORDER BY id_ap_prueba_segmentada");
            $statement2->execute();
            $segmentos = $statement2->fetchAll();  
          } catch (PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }  
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles del Vino</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="background">
    <div class="content">
      <h1>Análisis sensorial</h1>
      <p>Lista del producto: </p>
    </div>
  </div>
  <h1>Tipo de Análisis: Gustativo</h1>
  <div class="container">
  <?php foreach ($gustos as $gusto): ?>
    <div class="card rotatable">
      <div class="front">
        <h2>Sommelier: Mariana Elina</h2>
        <h2>Panelista: <?php echo $gusto['usuario']; ?></h2>
        <p><?php echo $gusto['codigo']; ?></p>
        <p><?php echo $gusto['marca']; ?></p>
        <p><?php echo $gusto['nombre_producto']; ?></p>
        <p><?php echo $gusto['tipo_producto']; ?></p>
        <p><?php echo $gusto['fecha']; ?></p>
      </div>
      <div class="back">
        <h3>Evaluación del producto</h3>
        <ul>
          <li>Color: <?php echo $gusto['color']; ?></li>
          <li>Aroma: <?php echo $gusto['aroma']; ?></li>
          <li>Sabor: <?php echo $gusto['sabor']; ?></li>
          <li>Cuerpo: <?php echo $gusto['cuerpo']; ?></li>
          <li>Aceptbilidad: <?php echo $gusto['aceptabilidad']; ?></li>
          <li>Comentarios: <?php echo $gusto['opinion']; ?></li>
        </ul>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <h1>Tipo de Análisis: Segmentado</h1>
  <div class="container">
  <?php foreach ($segmentos as $seg): ?>
    <div class="card large rotatable">
      <div class="front">
      <h2>Sommelier: Mariana Elina</h2>
        <h2>Panelista: <?php echo $seg['usuario']; ?></h2>
        <p><?php echo $seg['codigo']; ?></p>
        <p><?php echo $seg['marca']; ?></p>
        <p><?php echo $seg['nombre_producto']; ?></p>
        <p><?php echo $seg['tipo_producto']; ?></p>
        <p><?php echo $seg['fecha']; ?></p>
      </div>
      <div class="back">
        <h3>Características del Vino</h3>
        <p>VISUAL</p>
        <ul>
          <li>Color: <?php echo $seg['color']; ?></li>
          <li>Limpidez: <?php echo $seg['limpidez']; ?></li>
          <li>Intensidad: <?php echo $seg['intensidad']; ?></li>
          <li>Capilaridad: <?php echo $seg['capilaridad']; ?></li>
          <li>Reflejos: <?php echo $seg['reflejos']; ?></li>
        </ul>
        <p>OLFATIVA</p>
        <ul>
          <li>Calidad: <?php echo $seg['calidad']; ?></li>
          <li>Complejidad: <?php echo $seg['complejidad']; ?></li>
          <li>Intensidad: <?php echo $seg['intensidadolfativa']; ?></li>
          <li>Persistencia: <?php echo $seg['persistencia']; ?></li>
          <li>Carácter: <?php echo $seg['caracter']; ?></li>
        </ul>
        <p>GUSTATIVA</p>
        <ul>
          <li>Ataque: <?php echo $seg['ataque']; ?></li>
          <li>Azúcares: <?php echo $seg['azucares']; ?></li>
          <li>ALcohol: <?php echo $seg['alcohol']; ?></li>
          <li>Acidez: <?php echo $seg['acidez']; ?></li>
          <li>Tánino: <?php echo $seg['tanino']; ?></li>
          <li>Cuerpo: <?php echo $seg['cuerpo']; ?></li>          
        </ul>
        <p>GENERAL</p>
        <ul>
          <li>Impresión: <?php echo $seg['impresion']; ?></li>
          <li>Equilibrio: <?php echo $seg['equilibrio']; ?></li>
          <li>Persistencia: <?php echo $seg['persistenciageneral']; ?></li>
          <li>Evolución: <?php echo $seg['evolucion']; ?></li>
        </ul>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <script src="script.js"></script>
</body>
</html>


