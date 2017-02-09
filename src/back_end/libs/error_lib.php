<?php

/*
*
*   error_lib.php: LIBRERÍA DE ERRORES
*
*/
require_once "constants.php";

/****** ERRORES GRAVES ******/
function errorConsulta($con)
{
    echo "<h1>ERROR EN LA CONSULTA: ".mysqli_error($con)."</h1>";
}

function errorSelector()
{
    echo "<h1>ERROR EN EL FICHERO SELECTOR.PHP</h1>";
}

/****** ERRORES COMUNES ******/
function errorLogin()
{
    $message = "Login incorrecto";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '../front_end/index.php';
    </script>";
}

function errorNotLogged()
{
    $message = "No has iniciat sessió --- ACCÉS DENEGAT";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$homepage';
    </script>";
}