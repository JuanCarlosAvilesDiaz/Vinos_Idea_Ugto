<?php

require_once('db-config.php');

if ( isset($_GET['product-id'])  && ctype_digit($_GET['product-id']) ) {
    $sampleID = intval($_GET['product-id']);

        $statement = $connection->prepare("SELECT * FROM producto WHERE id_producto = ?");
            
        $statement->execute(array($sampleID));
}

try {
    $statement2 = $connection->prepare("SELECT * FROM tipo_analisis_sensorial ORDER BY id_tipo_analisis_sensorial");
    $statement2->execute();
    
    $tipos = $statement2->fetchAll();  

} catch (PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}
if(isset($_GET['existe']) && $_GET['existe']=="si")
echo "<script>alert('Ya existe un análisis con el mismo nombre y se encuentra activo');</script>"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del producto</title>
    <link rel="shortcut icon" href="../main/images/LogoUgto.png" type="image/x-icon">
    <link rel="icon" href="../main/images/LogoUgto.png" type="image/x-icon">
    <link rel="stylesheet" href="detailed-info-styles.css">
    <link rel="stylesheet" href="product-det.css">

    <style>
        .btnSalir {
   position: revert;  
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
    <header>
        <div class="logos">
            <img class="logo-dem" src="./img/dem.png" alt="Escudo del Departamento de Estudios Multidisciplinarios">
            <img class="logo-ideagto" src="./img/ideagto.png" alt="Escudo de IdeaGTO">
        </div>
        <?php if ( $statement->rowCount() == 1 ) { $row = $statement->fetch(); ?>
        <h1>Detalles del producto: <?php echo $row['nombre']." (".$row['codigo'].")";  ?></h1>
    </header>
    <a href="/vinosyproductos/detallesmuestras/" class="btnSalir">SALIR</a>
    <main class="info-detailed">
            <div class="info-value">
                <p class="info-attribute">Tipo de producto:</p>
                <img src="./img/tipo_product.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['tipo_producto']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Nombre:</p>
                <img src="./img/carrito.png" alt="Icono de unas uvas">
                <p class="info-attribute-value"><?php echo $row['nombre']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Marca:</p>
                <img src="./img/marca.png" alt="Icono de una persona entregando un paquete">
                <p class="info-attribute-value"><?php echo $row['marca']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Fecha:</p>
                <img src="./img/calendario.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['fecha_elavoracion']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Procedencia:</p>
                <img src="./img/lugar.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['procedencia']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Código:</p>
                <img src="./img/codigo.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['codigo']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Resultados:</p>
                <img src="./img/graficos.png" alt="Icono de un viñedo">
                <a class="btn-more-info btn-product" href="../partials/graficos.php?product-id=<?php echo $row['id_producto']; ?>">Gráficos</a>
            </div>
            <div class="info-value">
                <p class="info-attribute">Respuestas:</p>
                <img src="./img/Encuestas.png" alt="Icono de un viñedo">
                <a class="btn-more-info btn-product" href="../partials/respuestas.php?product-id=<?php echo $row['id_producto']; ?>">Respuestas</a>
            </div>
        <?php 
        } else {
            echo '<p>There are not sample details available!</p>';
        }
        
        ?>
    </main>
    <h2 class="section-headline">Dar de alta para su análisis</h2>
    <div class="climate-data">
    <form class="form" action="../partials/registroanalisis.php" method="POST">
  <header>
    Agregar un nuevo análisis
  <span class="message">Selecciona el tipo de análisis</span>
  </header>
  <label>
    <span>Identificador del análisis</span>
    <input placeholder="Este nombre aparecerá en la app" class="input" type="text" required="" name="nombreanalisis">
    <input type="hidden" name="idproducto" value="<?php echo $sampleID; ?>">
  </label>
  <fieldset>
    <label class="sm">
    <span>Selecciona el tipo de análisis</span>
    <div class="custom-select">
        <select class="input" name="tipo" required>
            <option value="" disabled selected hidden>Seleccione un tipo de análisis</option>
            <?php foreach ($tipos as $tipo): ?>
            <option value=<?php echo $tipo['id_tipo_analisis_sensorial']; ?>><?php echo $tipo['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
  </label>
  </fieldset>
  <button class="button2">Registrar</button>
</form>
    </div>
</body>
</html>