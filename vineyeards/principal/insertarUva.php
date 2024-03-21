<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="KEYWORDS" content="sistema de informacion">
    <meta name="viewport" content="width=device-width, initial.scale=1, shrink-to-fit=no">
    <meta name="autor" content="Daniel Avelar Jaime">
    <meta name="name" description="Sistema de informacion para fibra optica">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/doradito.png">
    <link rel="stylesheet" type="text/css" href="../css/medir.css">
    <title>SI DE FIBRA OPTICA</title>
</head>
    <body>
    <?php require '../partials/validacion_nav.php'; ?>
        <section class="container">
            <div class="row my-5">

            <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="../consultas/uva.php" method="POST" class="medircolor">            
                <h3 class="display-5 text-primary text-center">MEDICIÓN MUESTRA UVA</h3>
                <div class="form-group">
                    <label >Tipo de Muestra:</label>
                    <select name="tipo_de_muestra" class="form-control" disabled>
                        <option value="Artificial" >Artificial</option>
                        <option value="Vino" >Vino</option>
                        <option value="Mosto">Mosto</option>
                        <option value="Uva" selected>Uva</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >Arreglo Experimental:</label>
                    <select name="id_arregloexp" class="form-control">
                        <?php 
                            include '../consultas/db.php';
                            
                            $consultar="SELECT * FROM arreglo_exp";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_aregloexp']?>"><?php echo $opciones['descripcion']?></option>

                        <?php endforeach?>

                        </select>
                </div>
               
                <div class="form-group">
                    <label >Muestra:</label>
                    <select name="id_muestra" class="form-control">
                        <?php 
                            include 'db.php';
                            
                            $consultar="SELECT * FROM muestra_uva";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_muestra_uva']?>"><?php echo $opciones['codificacion_id']?></option>

                        <?php endforeach?>

                        </select>
                </div>
                <div class="form-group">
                    <label >Palabra clave:</label>
                    <select name="id_palabra" class="form-control">
                        <?php 
                            
                            
                            $consultar="SELECT * FROM palabra_clave";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_palabra']?>"><?php echo $opciones['descripcion']?></option>

                        <?php endforeach?>

                        </select>
                    <div class="form-group">
                        <label >Equipo:</label>
                        <select name="id_equipo" class="form-control">
                        <?php 
                           
                            
                            $consultar="SELECT * FROM equipo";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_equipo']?>"><?php echo $opciones['descripcion']?></option>

                        <?php endforeach?>

                        </select>
                </div>
                <div class="row g-3">            
                <div class="col-md-6">
                    <label >Volumen de gota</label>
                    <input type="number" placeholder="Escribe el volumen de gota" name="vol_gota" class="form-control">

                </div>
                <div class="col-md-6">
                        <label >Unidad de volumen gota:</label>
                        <select name="uni_vol_gota" class="form-control">
                        <?php 
                            
                            
                            $consultar="SELECT * FROM unidades where tipo_medida='volumen'";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_unidad']?>"><?php echo $opciones['nombre']?></option>

                        <?php endforeach?>

                        </select>
                </div>
                <div class="col-md-6">
                    <label >Duración de gota</label>
                    <input type="number" placeholder="Escribe la duracion de gota" name="dur_gota" class="form-control" >
                </div>
                <div class="col-md-6">
                        <label >Unidad de duracion gota:</label>
                        <select name="uni_dur_gota" class="form-control">
                        <?php 
                            
                            
                            $consultar="SELECT * FROM unidades where tipo_medida='tiempo'";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_unidad']?>"><?php echo $opciones['nombre']?></option>

                        <?php endforeach?>

                        </select>
                </div>
                
                <div class="col-md-6">
                    <label >Temperatura</label>
                    <input type="number" placeholder="Escribe la temperatura"  name="temp_ambiente" class="form-control" required>
                </div>
                <div class="col-md-6">
                        <label >Unidad de temperatura</label>
                        <select name="uni_temp_ambiente" class="form-control">
                        <?php 
                            
                            
                            $consultar="SELECT * FROM unidades where tipo_medida='temperatura'";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_unidad']?>"><?php echo $opciones['nombre']?></option>

                        <?php endforeach?>

                        </select>
                </div>                
                <div class="col-md-6">
                    <label >Duracion de la medición</label>
                    <input type="number" placeholder="Escribe la duracion de la medicion"  name="dur_medida" class="form-control" required>
                </div>
                <div class="col-md-6">
                        <label >Unidad de duracion de la medicion:</label>
                        <select name="uni_dur_medida" class="form-control">
                        <?php 
                            
                            
                            $consultar="SELECT * FROM unidades where tipo_medida='tiempo'";
                            $ejecutar=mysqli_query($conexion,$consultar) or die(mysqli_error($conexion));
                        ?>

                        <?php foreach ($ejecutar as $opciones): ?>

                            <option value="<?php echo $opciones['id_unidad']?>"><?php echo $opciones['nombre']?></option>

                        <?php endforeach?>

                        </select>
                </div>
                </div>
                <div class="form-group" col>
                    <label >Descripción</label>
                    <textarea rows="5" cols="40" placeholder="Escribe una descripcion" name="descripcion" class="form-control" required="required"> </textarea>
                </div>
                
                </div>
               <br>                
                <div>
                    <center>
                    <button type="submit" class="btn btn-primary">Insertar</button>
                    <button type="reset" class="btn btn-success">Limpiar</button>                   
                    <a href="registrosUva.php" class="btn btn-danger">VerLista</a>
                    </center>
                </div>
                
            </form>
            </div>  
            </div> 
            <hr>
        </section>
            <footer class="blockquote-footer text-center">
                <address>
                    <small class="font-weight-bold text-uppercase">&copy;todos los derechos reservados</small><br>
                    <p class="lead">Daniel Avelar Jaime<br>Yuriria - Guanajuato</p>
                </address>
            </footer>
            
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <body> 
    
</body>
</html>