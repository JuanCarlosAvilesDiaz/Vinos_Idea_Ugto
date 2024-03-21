

<?php
    $ruta=$_GET["ruta"];

    
    error_reporting(0);
    $csv='U77-20um.csv';
    $fh = fopen($ruta,'r');
    while(list($name_variable,$value) = fgetcsv($fh,1024,',')){
        printf("<p>%s, %s</p>", $name_variable,$value);
    }

?>  