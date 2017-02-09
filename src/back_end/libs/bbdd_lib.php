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

function getSession($user, $usertype) // obtiene las variables de sesión de un usuario
{
    $con = conectar("proyecto");
    $query = "SELECT * FROM Usuario WHERE username = '$user'";
    if($res = mysqli_query($con, $query))
    {
        session_start();
        extract($res);
        $_SESSION["username"] = $username;
        $_SESSION["publicname"] = $publicname;
        $_SESSION["email"] = $email;
        $_SESSION["img"] = $img;
        
        switch($usertype)
        {
            case 1: break; // fan
            case 2: $_SESSION["web"] = $web; $_SESSION["tel"] = $tel; $_SESSION["valoracion"] = $valoracion; break;
            case 3: $_SESSION["web"] = $web; $_SESSION["tel"] = $tel; $_SESSION["direccion"] = $direccion; $_SESSION["valoracion"] = $valoracion; break;
        }
    }
    else
    {
        errorConsulta();
        desconectar($con);
    }
}