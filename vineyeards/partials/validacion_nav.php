<?php
session_start();
if (isset($_SESSION['Tipo'])) {

switch($_SESSION["Tipo"]){
    case 1:
        include ('../partials/nav.php');
        break;

    //Investigador
    case 2:
        include ('../partials/nav_Investigador.php');
        break;

    //Tecnico
    case 3:
        include ('../partials/nav_Tecnico.php');
        break;

    //Recolector
    case 4:
        include ('../partials/nav_Recolector.php');
        break;

        }
    }else {
        header('Location: ../login/login.php');
      }
?>