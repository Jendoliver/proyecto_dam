<?php
/*
*
*   bbdd_lib.php: FUNCIONES BÁSICAS DE COMUNICACIÓN CON LA BBDD
*
*/
require_once "error_lib.php";

function conectar($db) // Todo un clásico
{
    $conexion = mysqli_connect("localhost", "root", "", $db) or
        die("No se ha podido conectar a la BBDD");
    return $conexion;
}

function desconectar($con) // Otra que tal
{
    mysqli_close($con);
}