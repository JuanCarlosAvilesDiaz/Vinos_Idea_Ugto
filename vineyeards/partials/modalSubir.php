<div class="modal fade" id="edit<?php echo $opciones['id_medir']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">AGREGAR ARCHIVO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                      <form action="../consultas/subir.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                    
                        <label name="" value="<?php echo $opciones['id_medir']?>">Id de la medición: </label><input type="text" name="id_medir" value="<?php echo $opciones['id_medir']?>" readonly><br>
                        <label for="formFile" class="form-label">Carga tu archivo de medición</label>
                        <input class="form-control" type="file" id="file" name="file" accept=".csv" required>
                        
                      
                    </div>
                    </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Subir</button>
                </form>
                </div>
            </div>
        </div>
    </div>