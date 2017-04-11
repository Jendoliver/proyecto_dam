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
function updateLocalStatus($username, $publicname, $pass, $email, $tel, $web, $aforo, $direccion)
{
    $update = "UPDATE usuario SET publicname = $publicname, pass = $pass, email = $email, tel = $tel, web = $web, aforo = $aforo, direccion = $direccion;
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
function updateFanStatus($username, $publicname, $pass, $email, $direccion)
{
    $update = "UPDATE usuario SET publicname = $publicname, pass = $pass, email = $email, direccion = $direccion;
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
function updateBandaStatus($username, $publicname, $pass, $email, $tel, $web, $aforo, $direccion)
{
    $update = "UPDATE usuario SET publicname = $publicname, pass = $pass, email = $email, tel = $tel, web = $web, aforo = $aforo, direccion = $direccion;
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