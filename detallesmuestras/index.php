<?php
    
    require_once('db-config.php');
    
    try {
        $statement = $connection->prepare("SELECT *, variedad_uva.nombre as nombre_uva, vinedo.nombre as nombre_viñedo, usuario.nombre as nombre_recolector FROM muestra_uva
                                            INNER JOIN variedad_uva ON muestra_uva.id_variedad_uva = variedad_uva.id_variedad_uva
                                            INNER JOIN vinedo ON muestra_uva.id_viñedo = vinedo.id_viñedo
                                            INNER JOIN usuario ON muestra_uva.encargado_tomar = usuario.id_usuario ORDER BY id_muestra_uva");
        $statement->execute();
        $grape_samples = $statement->fetchAll();

        $statement1 = $connection->prepare("SELECT *, variedad_uva.nombre as nombre_uva, vinedo.nombre as nombre_viñedo, usuario.nombre as nombre_recolector FROM muestra_mosto
                                            INNER JOIN variedad_uva ON muestra_mosto.id_variedad_uva = variedad_uva.id_variedad_uva
                                            INNER JOIN vinedo ON muestra_mosto.id_viñedo = vinedo.id_viñedo
                                            INNER JOIN usuario ON muestra_mosto.encargado_tomar = usuario.id_usuario ORDER BY id_muestra_mosto");
        $statement1->execute();
        $must_samples = $statement1->fetchAll();

        $statement2 = $connection->prepare("SELECT *, variedad_uva.nombre as nombre_uva, vinedo.nombre as nombre_viñedo, usuario.nombre as nombre_recolector FROM muestra_vino
                                            INNER JOIN variedad_uva ON muestra_vino.id_variedad_uva = variedad_uva.id_variedad_uva
                                            INNER JOIN vinedo ON muestra_vino.id_viñedo = vinedo.id_viñedo
                                            INNER JOIN usuario ON muestra_vino.encargado_tomar = usuario.id_usuario ORDER BY id_muestra_vino");
        $statement2->execute();
        $wine_samples = $statement2->fetchAll();
    
    } catch (PDOException $exception) {
        echo "Connection failed: " . $exception->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muestras de los viñedos de Guanajuato | 2022</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2b03317cd9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="search.css">
 </head>
<body>
    <header>
        <div class="logos">
            <img class="logo-ideagto" src="./main/images/CNR.png" alt="Escudo de ISR">
            <img class="logo-dem" src="./img/ugGeneral.png" alt="Escudo del Departamento de Estudios Multidisciplinarios">
            <img class="logo-ideagto" src="./img/ideagto.png" alt="Escudo de IdeaGTO">
        </div>
        <h1>Detalle de las muestras registradas</h1>
    </header>
    <nav>
    <div class="search-filters">
        <input class="search__input" id="search" type="text" placeholder="Buscar por palabra clave">
        <select id="filter">
            <option value="all">Todas las fechas</option>
            <option value="today">Hoy</option>
            <option value="yesterday">Ayer</option>
            <option value="last-week">Última semana</option>
            <option value="last-month">Último mes</option>
        </select>
        <input type="text" class="search_date" id="datepicker" placeholder="Seleccionar fecha">
        <button class="submit-btn" id="apply-filters">Aplicar filtros</button>
    </div>
    </nav>
    
    <div class="grape-samples">
        <h2 class="light-text">Muestras de Uva</h2>
        <div class="cards-samples">
        <?php foreach ($grape_samples as $grape_sample): ?>
            <?php   $fecha_db = $grape_sample['fecha_entrega'];
                    $dia = substr($fecha_db, 0, 2);
                    $mes = substr($fecha_db, 2, 2);
                    $anio = substr($fecha_db, 4, 4);
                    $fecha_formateada= $anio."-". $mes . "-" .$dia;
            ?>
            <div class="card-grape-sample" data-date="<?php echo $fecha_formateada; ?>">
                <p>Muestra de uva #<?php echo $grape_sample['id_muestra_uva']; ?></p>
                <img src="./img/grape.png" alt="A grape icon">
                <p><i class="fa-solid fa-location-dot fa-lg"></i> Viñedo de procedencia:</p>
                <p class="highlighted-text"><?php echo $grape_sample['nombre_viñedo']; ?></p>
                <p><i class="fa-brands fa-pagelines fa-xl"></i> Variedad de uva:</p>
                <p class="highlighted-text"><?php echo $grape_sample['nombre_uva']; ?></p>
                <p><i class="fa-solid fa-user fa-lg"></i> Nombre del recolector:</p>
                <p class="highlighted-text"><?php echo $grape_sample['nombre_recolector']; ?></p>
                <a class="btn-more-info btn-grape" href="sample-detail.php?sample-id=<?php echo $grape_sample['id_muestra_uva']; ?>&type=grape" target="_blank">Mas información</a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="must-samples">
        <h2 class="light-text">Muestras de Mosto</h2>
        <div class="cards-samples">
        <?php foreach ($must_samples as $must_sample): ?>
            <?php   $fecha_db = $must_sample['fecha_entrega'];
                    $dia = substr($fecha_db, 0, 2);
                    $mes = substr($fecha_db, 2, 2);
                    $anio = substr($fecha_db, 4, 4);
                    $fecha_formateada= $anio."-". $mes . "-" .$dia;
            ?>
            <div class="card-must-sample" data-date="<?php echo $fecha_formateada; ?>">
                <p>Muestra de mosto #<?php echo $must_sample['id_muestra_mosto']; ?></p>
                <img src="./img/must.png" alt="A must (fermented wine) icon">
                <p><i class="fa-solid fa-location-dot fa-lg"></i> Viñedo de procedencia:</p>
                <p class="highlighted-text"><?php echo $must_sample['nombre_viñedo']; ?></p>
                <p><i class="fa-brands fa-pagelines fa-xl"></i> Variedad de uva:</p>
                <p class="highlighted-text"><?php echo $must_sample['nombre_uva']; ?></p>
                <p><i class="fa-solid fa-user fa-lg"></i> Nombre del recolector:</p>
                <p class="highlighted-text"><?php echo $must_sample['nombre_recolector']; ?></p>
                <a class="btn-more-info btn-must" href="sample-detail.php?sample-id=<?php echo $must_sample['id_muestra_mosto']; ?>&type=must" target="_blank">Mas información</a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="wine-samples">
        <h2>Muestras de Vino</h2>
        <div class="cards-samples">
        <?php foreach ($wine_samples as $wine_sample): ?>
            <?php   $fecha_db = $wine_sample['fecha_entrega'];
                    $dia = substr($fecha_db, 0, 2);
                    $mes = substr($fecha_db, 2, 2);
                    $anio = substr($fecha_db, 4, 4);
                    $fecha_formateada= $anio."-". $mes . "-" .$dia;
            ?>
            <div class="card-wine-sample" data-date="<?php echo $fecha_formateada; ?>">
                <p>Muestra de vino #<?php echo $wine_sample['id_muestra_vino']; ?></p>
                <img src="./img/wine.png" alt="A bottle of wine icon">
                <p><i class="fa-solid fa-location-dot fa-lg"></i> Viñedo de procedencia:</p>
                <p class="highlighted-text"><?php echo $wine_sample['nombre_viñedo']; ?></p>
                <p><i class="fa-brands fa-pagelines fa-xl"></i> Variedad de uva:</p>
                <p class="highlighted-text"><?php echo $wine_sample['nombre_uva']; ?></p>
                <p><i class="fa-solid fa-user fa-lg"></i> Nombre del recolector:</p>
                <p class="highlighted-text"><?php echo $wine_sample['nombre_recolector']; ?></p>
                <a class="btn-more-info btn-wine" href="sample-detail.php?sample-id=<?php echo $wine_sample['id_muestra_vino']; ?>&type=wine" target="_blank">Mas información</a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <p class="sub">UNIVERSIDAD DE GUANAJUATO. </br>Campus Irapuato-Salamanca </br>Sede Yuriria</p>
    <p class="sub">
	    By </br><span class="sub">JUAN CARLOS GUZMAN</span></br>
        <span class="sub">JUAN CARLOS AVILES</span></br>
        <span class="sub">CLAUDIO BURGOS</span></br>
    </p>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script> flatpickr('#datepicker'); </script>
<script src="search.js"></script>
</body>
</html>