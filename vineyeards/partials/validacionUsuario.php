<?php

switch($_SESSION["Tipo"]){
    case 1:
        //require ('partials/header.php');
        break;
    case 2:
        return header('../login/login.php');
        break;
    case 3:
        return header('../login/login.php');
        break;
    case 4:
        return header('../login/login.php');
        break;

        }
?>