<?php

/*
*
*   inserts_lib.php: Librería de consultas INSERT de la aplicación
*
*/

require "selects_lib.php";

function insertFan($username, $password, $email, $publicname, $pic="img/user_image.png")
{
    $con = conectar("proyecto");
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`img`) VALUES ('$username', '$password', '$email', '$publicname', '$pic');";
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

function insertBanda($username, $password, $email, $publicname, $pic="img/user_image.png", $website="", $telnum)
{
    $con = conectar("proyecto");
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`img`,`web`,`tel`) VALUES ('$username', '$password', '$email', '$publicname', '$pic', '$website', '$telnum');";
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

function insertGarito($username, $password, $email, $publicname, $pic="img/user_image.png", $direccion, $aforomax, $website="", $telnum)
{
    $con = conectar("proyecto");
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`img`,`direccion`,`aforo`,`web`,`tel`) VALUES ('$username', '$password', '$email', '$publicname', '$pic', '$direccion', '$aforomax', $website', '$telnum');";
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