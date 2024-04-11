<?php

require_once('db-config.php');

if ( isset($_GET['sample-id'])  && ctype_digit($_GET['sample-id']) ) {
    $sampleID = intval($_GET['sample-id']);

    switch ($_GET['type']) {
        case "grape":
            $statement = $connection->prepare("SELECT *, variedad_uva.nombre as nombre_uva, vinedo.nombre as nombre_viñedo, usuario.nombre as usuario FROM muestra_uva
                                            INNER JOIN variedad_uva ON muestra_uva.id_variedad_uva = variedad_uva.id_variedad_uva
                                            INNER JOIN vinedo ON muestra_uva.id_viñedo = vinedo.id_viñedo
                                            INNER JOIN usuario ON muestra_uva.encargado_tomar = usuario.id_usuario
                                            WHERE id_muestra_uva = ? ORDER BY id_muestra_uva");
            
            $statement->execute(array($sampleID));
            break;
        case "must":
            $statement = $connection->prepare("SELECT *, variedad_uva.nombre as nombre_uva, vinedo.nombre as nombre_viñedo, usuario.nombre as usuario FROM muestra_mosto
                                            INNER JOIN variedad_uva ON muestra_mosto.id_variedad_uva = variedad_uva.id_variedad_uva
                                            INNER JOIN vinedo ON muestra_mosto.id_viñedo = vinedo.id_viñedo
                                            INNER JOIN usuario ON muestra_mosto.encargado_tomar = usuario.id_usuario
                                            WHERE id_muestra_mosto = ? ORDER BY id_muestra_mosto");
            
            $statement->execute(array($sampleID));
            break;
        case "wine":
            $statement = $connection->prepare("SELECT *, variedad_uva.nombre as nombre_uva, vinedo.nombre as nombre_viñedo, usuario.nombre as usuario FROM muestra_vino
                                            INNER JOIN variedad_uva ON muestra_vino.id_variedad_uva = variedad_uva.id_variedad_uva
                                            INNER JOIN vinedo ON muestra_vino.id_viñedo = vinedo.id_viñedo
                                            INNER JOIN usuario ON muestra_vino.encargado_tomar = usuario.id_usuario
                                            WHERE id_muestra_vino = ? ORDER BY id_muestra_vino");
            
            $statement->execute(array($sampleID));
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la muestra</title>
    <link rel="stylesheet" href="elementos.css">
    <link rel="stylesheet" href="detailed-info-styles.css">
    <script src="imagen.js"></script>
</head>
<body>
    <header>
        <div class="logos">
            <img class="logo-dem" src="./img/dem.png" alt="Escudo del Departamento de Estudios Multidisciplinarios">
            <img class="logo-ideagto" src="./img/ideagto.png" alt="Escudo de IdeaGTO">
        </div>
        <?php if ( $statement->rowCount() == 1 ) { $row = $statement->fetch(); ?>
        <h1>Detalles de la muestra: <?php echo $row['codificacion_id'];  ?></h1>
    </header>
    <main class="info-detailed">
            <div class="info-value">
                <p class="info-attribute">Viñedo:</p>
                <img src="./img/vineyard.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['nombre_viñedo']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Variedad:</p>
                <img src="./img/grape.png" alt="Icono de unas uvas">
                <p class="info-attribute-value"><?php echo $row['nombre_uva']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Cantidad entregada:</p>
                <img src="./img/delivery2.png" alt="Icono de una persona entregando un paquete">
                <p class="info-attribute-value"><?php echo $row['cantidad_entregada']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Temperatura de entrega:</p>
                <img src="./img/thermometer.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['temperatura_entrega']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Encargado de tomar la muestra:</p>
                <img src="./img/resign.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['encargado_recibir']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Encargado de entregar la muestra:</p>
                <img src="./img/courier.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['encargado_entregar']; ?></p>
            </div>
            <div class="info-value">
                <p class="info-attribute">Encargado de recibir la muestra:</p>
                <img src="./img/delivery.png" alt="Icono de un viñedo">
                <p class="info-attribute-value"><?php echo $row['usuario']; ?></p>
            </div>
        <?php 
        } else {
            echo '<p>There are not sample details available!</p>';
        }
        
        ?>
    </main>
    <h2 class="section-headline">Datos del clima</h2>
    <div class="climate-data">
        <div class="info-value">
            <p class="info-attribute">Temperatura:</p>
            <img src="./img/high-temperature.png" alt="Icono de un termómetro con un sol">
            <p class="info-attribute-value"><?php echo $row['temperatura']; ?></p>
        </div>
        <div class="info-value">
            <p class="info-attribute">Precipitación:</p>
            <img src="./img/precipitation.png" alt="Icono de una nube de lluvia">
            <p class="info-attribute-value"><?php echo $row['precipitacion']; ?></p>
        </div>
        <div class="info-value">
            <p class="info-attribute">Velocidad del viento:</p>
            <img src="./img/wind.png" alt="Icono del viento">
            <p class="info-attribute-value"><?php echo $row['velocidad_viento']; ?></p>
        </div>
        <div class="info-value">
            <p class="info-attribute">Dirección del viento:</p>
            <img src="./img/wind-direction.png" alt="Icono de la dirección del viento">
            <p class="info-attribute-value"><?php echo $row['direccion_viento']; ?></p>
        </div>
        <div class="info-value">
            <p class="info-attribute">Punto de rocío:</p>
            <img src="./img/dew-point.png" alt="Icono del punto de rocío">
            <p class="info-attribute-value"><?php echo $row['punto_rocio']; ?></p>
        </div>
        <div class="info-value">
            <p class="info-attribute">Nieve:</p>
            <img src="./img/snowflake.png" alt="Icono de un copo de nieve">
            <p class="info-attribute-value"><?php echo $row['nieve']; ?></p>
        </div>
    </div>

    <div class="card">
        <div class="container">
            <h1 class="title">Imagen de la boleta</h1>        
        </div>
        <img id="myImage" src="<?php echo $row['ruta_img_boleta']; ?>" alt="BOLETA">
        <div><button onclick="ampliarImagen()">Ampliar imagen</button></div>
        <div id="modal" class="modal">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <img class="modal-content" id="img01">
        </div>
    </div>

</body>
</html>