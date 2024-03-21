<?php
include_once('../consultas/ModelClima.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteorología</title>
    <link rel="stylesheet" href="../css/styleinfo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php require '../partials/validacion_nav.php'; ?>
    <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-auto p-5 text-center ">
            <div class="datos container-md">
                <div class="row mt-3">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <select name="viñedo" id="viñedo" class="form-select" required>
                            <option value="0">Seleccionar Viñedo</option>
                            <?php foreach ($result as $resultado) { ?>
                                <option value=<?php echo $resultado["id_viñedo"] ?>><?php echo $resultado["nombre"] ?></option>
                            <?php } ?>
                        </select>
                </div>

                <div class="row mt-3">
                    <input type="date" name="sample-date" id="sample-date" max="<?php echo date("Y-m-d"); ?>" required>
                </div>

                <div class="row mt-3">
                    <select name="muestra" id="muestra" class="form-select" required>
                        <option value="0">Seleccionar tipo de muestra</option>
                        <option value="uva">uva</option>
                        <option value="mosto">mosto</option>
                        <option value="vino">vino</option>
                    </select>
                </div>

                <div class="row ">
                    <div class="col-sm mt-3">
                        <input type="submit" name="consulta" id="consulta" class="form-control" value="Consultar">
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="row-auto align-items-center  mx-auto">
            <div class="container bg-light text-center tamano m-5" id="info">
                <?php if (!isset($_POST['consulta'])) { ?>
                    <p id="id">Muestra datos</p>
                <?php  } else { ?>
                    <h1><?php echo $datosViñ["nombre"] ?></h1>
                    <p>Municipio: <?php echo $datosViñ["municipio"] ?></p>
                    <h3>Ubicacion</h3>
                    <p>Latitud: <?php echo $datosViñ["latitud"] . ' longitud: ' . $datosViñ["longitud"] ?></p>
                    <h3>Clima</h3>
                    <p>Dia: <?php echo $datosclima["1"] ?> Mes: <?php echo $datosclima["15"] ?> Año: <?php echo $fecha[0] ?></p>
                    <p>Temperatura maxima: <?php echo $datosclima["7"] ?> <br>Temperatura minima: <?php echo $datosclima["11"] ?> <br>Temperatura: <?php echo $datosclima["21"] ?></p>
                    <p>Velocidad del viento maxima: <?php echo $datosclima["9"] ?> <br>Velocidad del viento minima: <?php echo $datosclima["13"] ?> <br>Velocidad del viento: <?php echo $datosclima["25"] ?> <br>Direccion del viento: <?php echo $datosclima["23"] ?></p>
                    <p>Precipitacion: <?php echo $datosclima["17"] ?> <br> Punto de rocio: <?php echo $datosclima["3"] ?></p>
                    <h3>Seccion: <?php echo $datosSec["seccion"] ?></h3>
                    <p>Edofologia: <?php echo $datosSec["edofologia"] ?></p>
                    <p>Geologia: <?php echo $datosSec["geologia"] ?></p>
                    <a href="<?php echo $datosViñ["url_sitio_web"] ?>"><?php echo $datosViñ["url_sitio_web"] ?></a>
                <?php  } ?>
            </div>
        </div>
    </div>
    <script src="../js/index.js" type="module"></script>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>