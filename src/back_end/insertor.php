<?php

require "libs/inserts_lib.php";
//CASOS DE REGISTRO
if(isset($_POST["registro_fan"])) // Caso fan
{
    extract($_POST);
    if(!strcmp($password, $password_confirm)) // por los viejos tiempos de C
    {
        if(insertFan($username, $password, $email, $publicname, $poblacion, $pic))
        {
            getSession($username, 1); 
            $_SESSION["token"] = 1;
            header('Location: ../front_end/fan.php');
        }
        else
            errorRegistro();
    }
    else
        errorPassword();
}
else if(isset($_POST["registro_banda"])) // Caso banda
{
    extract($_POST);
    if(!strcmp($password, $password_confirm)) // por los viejos tiempos de C
    {
        if(insertBanda($username, $password, $email, $publicname, $poblacion, $idgenero, $pic, $website="", $telnum)) // creamos primero la banda
        {
            for($i=0; $i<$memnum; $i++)
            {
                insertMusico($membername[$i], $memberape1[$i], $memberape2[$i], $memberinstrument[$i], $memberage[$i], $username); // a continuación los músicos, que quedan registrados en "pertenece"
            }    
            getSession($username, 2); 
            $_SESSION["token"] = 1;
            header('Location: ../front_end/banda.php');
        }
        else
            errorRegistro();
    }
    else
        errorPassword();
}
else if(isset($_POST["registro_garito"])) // Caso garito
{
    extract($_POST);
    if(!strcmp($password, $password_confirm)) // por los viejos tiempos de C
    {
        if(insertGarito($username, $password, $email, $publicname, $poblacion, $idgenero, $pic, $direccion, $aforomax, $website="", $telnum))
        {    
            getSession($username, 3); 
            $_SESSION["token"] = 1;
            header('Location: ../front_end/local.php');
        }
        else
            errorRegistro();
    }
    else
        errorPassword();
}
else
    errorInsertor();