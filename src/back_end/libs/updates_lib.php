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
    mysqli_query($con, $update);
    desconectar($con);
    return 1;
}

function updateConcert($idconcert, $concertdate, $cash)
{
    $update = "UPDATE concierto SET fecha = '$concertdate', precio = $cash WHERE id = $idconcert;";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update));
    {
        desconectar($con);
        return 1;
    }
    errorConsulta();
    return 0;
}
//modificar perfil 
function updateLocalStatus($username, $publicname, $email, $tel, $web, $aforo, $direccion, $id_poblacion)
{
    $update = "UPDATE usuario SET publicname = '$publicname',  email = '$email', tel = '$tel', web = '$web', aforo = '$aforo', direccion = '$direccion', id_poblacion = '$id_poblacion'
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
function updateFanStatus($username, $publicname, $email, $id_poblacion)
{
    $update = "UPDATE usuario SET publicname = '$publicname', email = '$email', id_poblacion = $id_poblacion
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
function updateBandaStatus($username, $publicname, $email, $tel, $web, $id_poblacion)
{
    $update = "UPDATE usuario SET publicname = '$publicname', email = '$email', tel = '$tel', web = '$web', id_poblacion = '$id_poblacion'
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
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $update = "UPDATE usuario SET pass = '$pass' WHERE username = '$username';";
    $con = conectar($GLOBALS['db']);
    mysqli_query($con, $update);
    desconectar($con);
    return 1;
}
function comprovaPass($username, $pass)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT pass FROM usuario WHERE username = '$username';";
    $res = mysqli_query($con, $query);
    desconectar($con);
    if(mysqli_num_rows($res)) // si existe un usuario con ese username, comprobamos la contraseña
    {
        $row = mysqli_fetch_row($res);
        return password_verify($pass, $row[0]);
    }
    return 0;
}