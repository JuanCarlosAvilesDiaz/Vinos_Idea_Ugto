<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Viñedos del Estado de Guanajuato </title>
    <link rel="icon" type="image/png" href="./img/vinedo.png">
    <link rel="stylesheet" href="./css/styleinfo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="m-0 vh-100 row justify-content-center align-items-center">
        
    
    <div class="container text-center ">
        <?php
            require ('partials/header.php');
        ?>
        
        <div class="row mb-5">
        <h1> Bienvenidos al Sistema de Viñedos del Estado de Guanajuato</h1>
            <div class="justify-content-md-center">
                <a href="./login/login.php" class="boton1"> Inicio de sesión</a> o
                <a href="./login/signup.php" class = "boton1" >Registro</a>
            </div>
        </div>
    </div>

</body>

</html>