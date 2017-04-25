<?php
/*
*
*   updates_lib.php: Librería de consultas UPDATE
*
*/

require "inserts_lib.php";

function updateConcertStatus($idconcierto, $userbanda, $accepted)
{
    $update = "UPDATE participa SET aceptado = ";
    if($accepted)
        $update .= "1 "; // Aceptado
    else
        $update .= "2 "; // Rechazado
    $update .= "WHERE id_concierto = $idconcierto AND id_banda = '$userbanda';";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        return 1;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}
//modificar perfil 
function updateLocalStatus($username, $publicname, $email, $tel, $web, $aforo, $direccion, $id_poblacion, $genero)
{
    $update = "UPDATE usuario SET publicname = '$publicname',  email = '$email', tel = '$tel', web = '$web', aforo = '$aforo', direccion = '$direccion', id_poblacion = '$id_poblacion'
        WHERE username = '$username';";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update))
    {
        $update = "UPDATE genero_user SET id_genero='$genero'
        WHERE id_user = '$username';";
        $con = conectar($GLOBALS['db']);
        if(mysqli_query($con, $update))
        {
        desconectar($con);
        return 1;
        }
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}
function updateFanStatus($username, $publicname, $email, $id_poblacion)
{
    $update = "UPDATE usuario SET publicname = '$publicname', email = '$email', id_poblacion = '$id_poblacion' 
        WHERE username = '$username';";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        return 1;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}
function updateBandaStatus($username, $publicname, $email, $tel, $web, $id_poblacion, $genero)
{
    $update = "UPDATE usuario SET publicname = '$publicname', email = '$email', tel = '$tel', web = '$web', id_poblacion = '$id_poblacion'
        WHERE username = '$username';";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update))
    {
        $update = "UPDATE genero_user SET id_genero='$genero'
        WHERE id_user = '$username';";
        $con = conectar($GLOBALS['db']);
        if(mysqli_query($con, $update))
        {
        desconectar($con);
        return 1;
        }
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}
function updatePass($username, $pass)//funcio per canviar totes les pass de qualsevol usuari
{
    $update = "UPDATE usuario SET pass = '$pass'
        WHERE username = '$username';";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        return 1;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}
function comprovaPass($username, $pass)
{
    $con = conectar($GLOBALS['db']);
    $query = "select username from usuario where username='$username' AND pass='$pass';";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $num_rows = mysqli_num_rows($resultado);
    if ($num_rows == 0){
        return false;
    }else {
        return true;
    }
}