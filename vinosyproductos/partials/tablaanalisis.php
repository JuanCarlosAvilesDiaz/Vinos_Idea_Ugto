<?php
require_once('../detallesmuestras/db-config.php');

/*$registros = $connection->prepare("SELECT *, analisis_sensorial.nombre as nombre_analisis, usuario.nombre as nombre_usuario, producto.nombre as nombre_producto FROM analisis_sensorial
                                  INNER JOIN usuario ON analisis_sensorial.asesor = usuario.id_usuario
                                  INNER JOIN detalle_analisis_sensorial ON  detalle_analisis_sensorial.id_analisis_sensorial =  analisis_sensorial.id_analisis_sensorial
                                  INNER JOIN producto ON detalle_analisis_sensorial.id_producto = producto.id_producto ORDER BY analisis_sensorial.id_analisis_sensorial");
*/
$registros = $connection->prepare("SELECT analisis_sensorial.id_analisis_sensorial, MAX(analisis_sensorial.nombre) AS nombre_analisis, analisis_sensorial.activo AS activo,
                              MAX(usuario.nombre) AS nombre_usuario, MAX(producto.nombre) AS nombre_producto, analisis_sensorial.fecha AS fecha
                              FROM analisis_sensorial
                              INNER JOIN usuario ON analisis_sensorial.asesor = usuario.id_usuario
                              INNER JOIN detalle_analisis_sensorial ON detalle_analisis_sensorial.id_analisis_sensorial = analisis_sensorial.id_analisis_sensorial
                              INNER JOIN producto ON detalle_analisis_sensorial.id_producto = producto.id_producto
                              GROUP BY analisis_sensorial.id_analisis_sensorial
                              ORDER BY analisis_sensorial.id_analisis_sensorial;");                                
$registros->execute(); 
$registrosAnalisis = $registros->fetchAll();

?>
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

    .mitabla {
  position:static;
  max-width: 70%;
  width: 100%;
  background: #07203e;
  padding: 2px 2px 0px 2px;
  border-radius: 8px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  margin: auto;
  margin-top: 5%;
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

<a href="/vinosyproductos/main/" class="btnSalir">
    REGRESAR
</a>


<div class="mitabla">
<table class="table table-hover table-dark">
  <thead>
    <tr >
      <th scope="col">Id</th>
      <th scope="col">Análisis</th>
      <th scope="col">Producto</th>
      <th scope="col">Asesor</th>
      <th scope="col">Fecha de la evaluación</th>
      <th scope="col">Análisis activo</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($registrosAnalisis as $registro): ?>
    <?php 
      $constan = ""; $activar="";
      if($registro['activo'] == "Si"){$constan="Desactivar"; $activar="No";}else{$constan="Activar"; $activar="Si";}?>
    <tr class="bg-info">
      <th scope="row"><?php echo $registro['id_analisis_sensorial']; ?></th>
      <td><?php echo $registro['nombre_analisis']; ?></td>
      <td><?php echo $registro['nombre_producto']; ?></td>      
      <td><?php echo $registro['nombre_usuario']; ?></td>
      <td><?php echo $registro['fecha']; ?></td>
      <td><?php echo $registro['activo']; ?></td>
      <?php if($registro['activo'] == "Si"):?>
      <td><a class="del btn btn-warning" title="¿Seguro que quiere <?php echo $constan; ?> el análisis?" href="activaranalisis.php?id_analisis=<?= $registro['id_analisis_sensorial']?>&activar=<?= $activar ?>" onclick="return confirm('¿Está seguro?');"><?php echo $constan; ?></a></td>
      <?php else:?>
        <td><a class="del btn btn-success" title="¿Seguro que quiere <?php echo $constan; ?> el análisis?" href="activaranalisis.php?id_analisis=<?= $registro['id_analisis_sensorial']?>&activar=<?= $activar ?>" onclick="return confirm('¿Está seguro?');"><?php echo $constan; ?></a></td>
      <?php endif; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>