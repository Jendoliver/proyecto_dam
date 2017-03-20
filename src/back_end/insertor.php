<?php

require "libs/inserts_lib.php";
/********** CASOS DE REGISTRO ***************/
if(isset($_POST["registro_fan"])) // Caso fan
{
    extract($_POST);
    if(!strcmp($password, $password_confirm)) // por los viejos tiempos de C
    {
        if(insertFan($username, $password, $email, $publicname, $poblacion, $pic))
        {
            getSession($username, 1); 
            $_SESSION["token"] = 1;
            header("Location: $fanpage");
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
            header("Location: $bandpage");
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
            header("Location: $garitopage");
        }
        else
            errorRegistro();
    }
    else
        errorPassword();
}
/**************** CASOS DE GESTIÓN DE CONCIERTOS *****************/
else if(isset($_POST["crear_concierto"])) // Caso crear concierto
{
    extract($_POST);
    session_start();
    if(crearConcierto($concertdate, $cash, $_SESSION["username"]))
        conciertoCreado();
}
else if(isset($_POST["inscribirse_concierto"])) // Caso inscribirse concierto
{
    extract($_POST);
    if(altaConcierto($idconcierto, $userbanda))
        altaCorrecta();
}
/*************** CASOS DE VALORACIONES ****************/
else if(isset($_POST["valorar_concierto"])) // Caso valorar concierto
{
    global $lastpage;
    extract($_POST);
    if(votarConcierto($userfan, intval($idconcierto)))
        header("Location: $lastpage");
}
else if(isset($_POST["valorar_perfil"])) // Caso valorar perfil
{
    global $lastpage;
    session_start();
    extract($_POST);
    if($_SESSION["usertypevisit"] == 2) // Banda
    {
        if(votarBanda($userfan, $userperfil))
            header("Location: $lastpage");
    }
    else if($_SESSION["usertypevisit"] == 3) // Local
    {
        if(votarLocal($userfan, $userperfil))
            header("Location: $lastpage");
    }
}
else
    errorInsertor();