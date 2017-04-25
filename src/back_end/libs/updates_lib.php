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
function updateLocalStatus($username, $publicname, $email, $tel, $web, $aforo, $direccion)
{
    $update = "UPDATE usuario SET publicname = '$publicname',  email = '$email', tel = '$tel', web = '$web', aforo = '$aforo', direccion = '$direccion';
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
function updateFanStatus($username, $publicname, $email)
{
    $update = "UPDATE usuario SET publicname = '$publicname', email = '$email' 
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
function updateBandaStatus($username, $publicname, $email, $tel, $web)
{
    $update = "UPDATE usuario SET publicname = '$publicname', email = '$email', tel = '$tel', web = '$web';
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
function updatePass($username, $pass)//funcio per canviar totes les pass de qualsevol usuari
{
    $update = "UPDATE usuario SET pass = $pass
        WHERE username = $username;";
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