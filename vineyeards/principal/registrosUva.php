<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="KEYWORDS" content="sistema de informacion">
    <meta name="viewport" content="width=device-width, initial.scale=1, shrink-to-fit=no">
    <meta name="autor" content="Daniel Avelar Jaime">
    <meta name="name" description="Sistema de informacion para fibra optica">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/doradito.png">   
    <link rel="stylesheet" type="text/css" href="../css/medir.css">
    <title>Tabla de mediciones Uva</title>
</head>
<body>

<?php require '../partials/validacion_nav.php'; ?>
    <h1><center>Mediciones Uva</center></h1>
    <table class="table table-dark table-sm">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Arreglo</th>
          <th scope="col">Tipo muestra</th>
          <th scope="col">Id muestra</th>          
          <th scope="col">Palabra clave</th>
          <th scope="col">Equipo</th>
          <th scope="col">Volumen Gota</th>
          <th scope="col">Duracion Gota</th>
          <th scope="col">Duracion medida</th>
          <th scope="col">Temperatura</th>
          <th scope="col">Fecha</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        
        <?php 
                            include '../consultas/db.php';
                            
                            $consultar="SELECT id_medir, arreglo_exp.descripcion as descripcion_exp, tipo_de_muestra, muestra_uva.codificacion_id as codificacion_id, palabra_clave.descripcion as descripcion_palabra, equipo.descripcion as descripcion_equi, vol_gota, 
                            uni1.simbolo as sim_vol_gota, dur_gota, uni2.simbolo as sim_dur_gota, dur_medida, uni3.simbolo as sim_dur_medida, temp_ambiente, uni4.simbolo as sim_temp_ambiente, medir.fecha as fecha, medir.descripcion as descripcion_medir 
                            FROM `medir` INNER JOIN arreglo_exp on medir.id_arregloexp=arreglo_exp.id_aregloexp 
                            INNER JOIN equipo ON medir.id_equipo=equipo.id_equipo 
                            INNER JOIN palabra_clave ON medir.id_palabra=palabra_clave.id_palabra 
                            INNER JOIN muestra_uva ON medir.id_muestra_uva=muestra_uva.id_muestra_uva 
                            INNER JOIN unidades as uni1 ON medir.uni_vol_gota=uni1.id_unidad 
                            INNER JOIN unidades as uni2 ON medir.uni_dur_gota=uni2.id_unidad 
                            INNER JOIN unidades as uni3 ON medir.uni_dur_medida=uni3.id_unidad 
                            INNER JOIN unidades as uni4 ON medir.uni_temp_ambiente=uni4.id_unidad";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>
                            <tr>
                            <td ><?php echo $opciones['id_medir']?></td>
                            <td ><?php echo $opciones['descripcion_exp']?></td>
                            <td ><?php echo $opciones['tipo_de_muestra']?></td>
                            <td ><?php echo $opciones['codificacion_id']?></td>
                            <td ><?php echo $opciones['descripcion_palabra']?></td>
                            <td ><?php echo $opciones['descripcion_equi']?></td>
                            <td ><?php echo $opciones['vol_gota']?><?php echo $opciones['sim_vol_gota']?></td>
                            <td ><?php echo $opciones['dur_gota']?><?php echo $opciones['sim_dur_gota']?></td>                
                            <td ><?php echo $opciones['dur_medida']?><?php echo $opciones['sim_dur_medida']?></td>                           
                            <td ><?php echo $opciones['temp_ambiente']?><?php echo $opciones['sim_temp_ambiente']?></td> 
                            <td ><?php echo $opciones['fecha']?></td>                           
                            <td ><?php echo $opciones['descripcion_medir']?></td>
                            <td>
                            <button type="button" class="btn btn-secondary edit"  data-bs-toggle="modal" data-bs-target="#edit<?php echo $opciones['id_medir']?>" id="edit" name="edit">Agregar archivo</button>
                            <button type="button" class="btn btn-primary edit"  data-bs-toggle="modal" data-bs-target="#mostrar<?php echo $opciones['id_medir']?>" id="mostrar" name="mostrar">Mostrar archivos</button>
                            
                            </td>
                            </tr>
                            <?php require '../partials/modalSubir.php'; ?>

                            <?php require '../partials/modalMostrarCSV.php'; ?>


                        <?php endforeach?>
                      </tbody>
    </table>


        <script src="../js/jquery-3.4.1.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        
        
        
       
</body>
</html>