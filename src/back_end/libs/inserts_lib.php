<?php

/*
*
*   inserts_lib.php: Librería de consultas INSERT de la aplicación
*
*/

require "selects_lib.php";

/************ REGISTRO ****************/
function insertFan($username, $password, $email, $publicname, $poblacion, $pic="img/user_image.png")
{
    $con = conectar($GLOBALS['db']);
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`id_poblacion`,`img`) VALUES ('$username', '$password', '$email', '$publicname', $poblacion, '$pic');";
        if(mysqli_query($con, $insert))
        {
            desconectar($con);
            return 1;
        }
        else
        {
            errorConsulta($con);
            desconectar($con);
            return 0;
        }
    }
    else
    {
        errorUserExists();
        desconectar($con);
        return 0;
    }
}

function insertBanda($username, $password, $email, $publicname, $poblacion, $idgenero, $pic="img/user_image.png", $website="", $telnum)
{
    $con = conectar($GLOBALS['db']);
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`id_poblacion`,`img`,`web`,`tel`) VALUES ('$username', '$password', '$email', '$publicname', $poblacion, '$pic', '$website', '$telnum');";
        if(mysqli_query($con, $insert))
        {
            if(mysqli_query($con, "INSERT INTO genero_user VALUES ('$username', $idgenero);"))
            {
                desconectar($con);
                return 1;
            }
        }
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
    else
    {
        errorUserExists();
        desconectar($con);
        return 0;
    }
}

function insertMusico($nom, $ape1, $ape2, $inst, $edad, $banda) // actualiza la tabla musico y la tabla usa
{
    $con = conectar($GLOBALS['db']);
    $id = generateID("musico");
    $insert = "INSERT INTO musico VALUES ($id, '$nom', '$ape1', '$ape2', $edad);";
    if(mysqli_query($con, $insert))
    {
        $insert = "INSERT INTO usa VALUES ($id, '$inst');";
        if(mysqli_query($con, $insert))
        {
            desconectar($con);
            return 1;
        }
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}

function insertGarito($username, $password, $email, $publicname, $poblacion, $idgenero, $pic="img/user_image.png", $direccion, $aforomax, $website="", $telnum)
{
    $con = conectar($GLOBALS['db']);
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`id_poblacion`,`img`,`direccion`,`aforo`,`web`,`tel`) VALUES ('$username', '$password', '$email', '$publicname', $poblacion, '$pic', '$direccion', '$aforomax', '$website', '$telnum');";
        if(mysqli_query($con, $insert))
        {
            if(mysqli_query($con, "INSERT INTO genero_user VALUES ('$username', $idgenero);"))
            {
                desconectar($con);
                return 1;
            }
        }
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
    else
    {
        errorUserExists();
        desconectar($con);
        return 0;
    }
}

/************ GESTIÓN DE CONCIERTOS ****************/
function crearConcierto($fecha, $precio, $userlocal) // $fecha = DATE, $precio = INT, $userlocal = STRING
{
    
}

function altaConcierto($idconcierto, $userbanda) // $idconcierto = INT, $userbanda = STRING
{
    
}

/************ VOTACIONES ****************/
function votarBanda($userfan, $userbanda) // $userfan, $userbanda = STRING, success = return 1, fail = return 0
{
    
}

function votarLocal($userfan, $userlocal) // $userfan, $userlocal = STRING, success = return 1, fail = return 0
{
    
}

function votarConcierto($userfan, $idconcierto) // $userfan = STRING, $idconcierto = INT, success = return 1, fail = return 0
{
    
}