<?php

require "libs/updates_lib.php";

if(isset($_POST["aceptar_banda"])) // Caso aceptar banda
{
    extract($_POST);
    if(updateConcertStatus($idconcierto, $userbanda, 1))
        bandAccepted();
}

else if(isset($_POST["rechazar_banda"])) // Caso rechazar banda
{
    extract($_POST);
    if(updateConcertStatus($idconcierto, $userbanda, 0))
        bandNotAccepted();
}

else if(isset($_POST["modificar_perfil_local"])) //modificar perfil
{
    extract($_POST);
    if(comprovaPass($username, $pass))
    {
        updateLocalStatus($username, $publicname, $email, $telefon, $web, $aforo, $direccion, $poblacion); // TODO: AÑADIR MOD GENERO
        if($newpass != "")
            updatePass($username, $newpass);
        getSession($username, 3); 
        perfilModificat();
    }
    else
        passIncorrecte();    
}
else if(isset($_POST["modificar_perfil_fan"])) //modificar perfil
{
    extract($_POST);
    if(comprovaPass($username, $pass)) // si la pass es correcta
    {
        updateFanStatus($username, $publicname, $email, $poblacion);
        if($newpass!="") // si hay cambio de pass
            updatePass($username, $newpass);
        getSession($username, 1); 
        perfilModificat();
    }
    else
        passIncorrecte();
}
else if(isset($_POST["modificar_perfil_banda"])) //modificar perfil
{
    extract($_POST);
    if(comprovaPass($username, $pass))
    {
        updateBandaStatus($username, $publicname, $email, $telefon, $web, $poblacion); // TODO: AÑADIR MOD GENERO
        if($newpass != "")
            updatePass($username, $newpass);
        getSession($username, 2); 
        perfilModificat();
    }
    else
        passIncorrecte();
}