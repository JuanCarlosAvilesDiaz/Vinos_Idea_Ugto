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

    $registroResultados = $connection->prepare("SELECT id_valor, COUNT(*) as cantidad_registros FROM resultado_analisis_sensorial 
                                            WHERE id_producto = $sampleID AND id_caracteristica = ".$idCaracteristica[$ca]."
                                            GROUP BY id_valor 
                                            ORDER BY id_valor");                               
    $registroResultados->execute(); 
    $resultados = $registroResultados->fetchAll();

    foreach ($resultados as $res)
    {
        $data[$ca][$re]=$res["cantidad_registros"];

        $re = $re + 1;
    }
    $ca = $ca +1;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Barras</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="../main/images/LogoUgto.png" type="image/x-icon">
<link rel="icon" href="../main/images/LogoUgto.png" type="image/x-icon">
<style>
    body {
  margin: 0;
  height: 100%;
  background: linear-gradient(to bottom left, #ffffff 15%, #cce3ff 90%);

  color: black;
}
h1{margin-left: 42%;}

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
        for ($i = 1; $i <= 5; $i++) {
            $labels = ['Me gusta muchisimo', 'Me gusta mucho', 'Me gusta moderadamente', 'Me gusta poco', 'No me gusta ni me disgusta', 'Me disgusta poco', 'Me disgusta moderadamente', 'Me disgusta mucho', 'Me disgusta muchisimo'];
            
        ?>
        <h1><?php echo $caracteristica[$i-1]; ?></h1>
        <canvas id="myChart<?php echo $i; ?>"></canvas>
        <script>
            var data<?php echo $i; ?> = {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Participantes',
                    data: <?php echo json_encode($data[$i-1]); ?>,
                    backgroundColor: [
                        'rgba(16, 193, 2, 0.7)',
                    'rgba(2, 193, 91, 0.7)',
                    'rgba(2, 193, 155, 0.7)',
                    'rgba(0, 165, 132, 0.7)',
                    'rgba(0, 216, 206, 0.7)',
                    'rgba(243, 255, 0, 0.7)',
                    'rgba(189, 198, 0, 0.7)',
                    'rgba(197, 93, 0, 0.7)',
                    'rgba(195, 0, 0, 0.7)'
                    ]
                }]
            };

            var ctx<?php echo $i; ?> = document.getElementById('myChart<?php echo $i; ?>').getContext('2d');
            var myChart<?php echo $i; ?> = new Chart(ctx<?php echo $i; ?>, {
                type: 'bar',
                data: data<?php echo $i; ?>,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <?php
        }
        ?>
    </div>
</body>
</html>