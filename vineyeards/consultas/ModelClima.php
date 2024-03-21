<?php
include_once('db.php');

$query = "SELECT id_viñedo, nombre, municipio, latitud, longitud, url_sitio_web, seccion FROM viñedo;";

$result = mysqli_query($conexion, $query) or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);

if ($result) {
} else {
?>
    <h3 class="bad">¡Ups ha ocurrido un error!</h3>
<?php
}

if(isset($_POST['consulta'])){
    $_POST['muestra'];
    $fecha = explode("-", $_POST['sample-date']); 

    $queryviñ = "SELECT id_viñedo, nombre, municipio, latitud, longitud, url_sitio_web, seccion FROM viñedo where id_viñedo =".$_POST['viñedo'].";";

    $resultviñ = mysqli_query($conexion, $queryviñ) or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);
    
    $query2 = "SELECT id_seccion,seccion, edofologia, geologia FROM seccion WHERE id_seccion =".$_POST['viñedo'].";";
    $resultSeccion = mysqli_query($conexion, $query2) or trigger_error("Query Failed! SQL- ERROR: ", mysqli_error($conectar), E_USER_ERROR);


    $datosSec = $resultSeccion->fetch_array(MYSQLI_ASSOC);
    $datosViñ = $resultviñ ->fetch_array(MYSQLI_ASSOC);
    
    $curl = curl_init(); //inicia la sesión cURL

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.weatherbit.io/v2.0/normals?lat=".$datosViñ["latitud"]."&lon=".$datosViñ["longitud"]."&start_day=".$fecha[1]."-".$fecha[2]."&end_day=".$fecha[1]."-".$fecha[2]."&series_year=".$fecha[0]."&tp=daily&key=c90655123f154f98ba1d85d53c088503", //url a la que se conecta
        CURLOPT_RETURNTRANSFER => true, //devuelve el resultado como una cadena del tipo curl_exec
        CURLOPT_FOLLOWLOCATION => true, //sigue el encabezado que le envíe el servidor
        CURLOPT_ENCODING => "", // permite decodificar la respuesta y puede ser"identity", "deflate", y "gzip", si está vacío recibe todos los disponibles.
        CURLOPT_MAXREDIRS => 10, // Si usamos CURLOPT_FOLLOWLOCATION le dice el máximo de encabezados a seguir
        CURLOPT_TIMEOUT => 30, // Tiempo máximo para ejecutar
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // usa la versión declarada
        CURLOPT_CUSTOMREQUEST => "GET", // el tipo de petición, puede ser PUT, POST, GET o Delete dependiendo del servicio
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: clima",
            "x-rapidapi-key: XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
        ), //configura las cabeceras enviadas al servicio
    )); //curl_setopt_array configura las opciones para una transferencia cURL

    $response = curl_exec($curl); // respuesta generada
    $err = curl_error($curl); // muestra errores en caso de existir

    curl_close($curl); // termina la sesión 

    if ($err) {
        echo "cURL Error #:" . $err; // mostramos el error
    } else {
        $preproces=str_replace("{", "", $response);
        $preproces=str_replace('"', "", $preproces);
        $preproces=str_replace('}', "", $preproces);
        $preproces=str_replace('[', "", $preproces);
        $preproces=str_replace(']', "", $preproces);
        $preproces=str_replace('data:', "", $preproces);
        $preproces=str_replace(',', ":", $preproces);

        $datosclima = explode(":", $preproces); 
        //var_dump($datosclima);
        //echo $response; // en caso de funcionar correctamente
    }
}
?>