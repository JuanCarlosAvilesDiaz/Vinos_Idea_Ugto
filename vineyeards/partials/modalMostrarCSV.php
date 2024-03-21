<div class="modal fade" id="mostrar<?php echo $opciones['id_medir']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">ARCHIVOS CSV</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                    <label>Id de la medición: </label><input type="text" name="id_me" id="id_me" value="<?php echo $opciones['id_medir']?>" disabled><br>
                    <label>Archivos de la medición</label><br>
                    <?php
                    
                    $id = $opciones['id_medir'];
                    
                            $consultarCSV="SELECT * FROM path where id_medir='$id'"; 
                            $ejecutar1=mysqli_query($conexion,$consultarCSV) or die(mysqli_error($conexion));
                        ?>
                       
                        <?php foreach ($ejecutar1 as $csv): ?>
                                   
                            <?php echo $csv['id_path']?>
                            <?php echo $csv['path_espec']?>                          
                           
                           <a href="../consultas/csv_reader.php?ruta=<?php echo $csv['path_espec']?>"  target="_blank">ver</a><br>          
                            
                        <?php endforeach?>                     
                     
                </div>
            </div>
        </div>
    </div>