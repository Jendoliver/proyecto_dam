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
    if(comprovaPass($username, $pass1)==true){
        if($pass2==""){
        if(updateLocalStatus($username, $publicname, $email, $telefon, $web, $aforo, $direccion, $poblacion, $genero))//genere i ciudad
            perfilModificat();
        }else if(updateLocalStatus($username, $publicname, $email, $telefon, $web, $aforo, $direccion, $poblacion, $genero) && updatePass($username, $pass2))
        {
            perfilModificat();
        }
    }else{
        passIncorrecte();    
    }
}
else if(isset($_POST["modificar_perfil_fan"])) //modificar perfil
{
    extract($_POST);
    if(comprovaPass($username, $pass1)==true){
        if($pass2==""){
        if(updateFanStatus($username, $publicname, $email, $poblacion))
            perfilModificat();
        }else if(updateFanStatus($username, $publicname, $email, $poblacion) && updatePass($username, $pass2))
        {
            perfilModificat();
        }
    }else{
        passIncorrecte();    
    }
}
else if(isset($_POST["modificar_perfil_banda"])) //modificar perfil
{
    extract($_POST);
    if(comprovaPass($username, $pass1)==true){
        if($pass2==""){
        if(updateBandaStatus($username, $publicname, $email, $telefon, $web, $poblacion, $genero))
            perfilModificat();
        }else if(updateBandaStatus($username, $publicname, $email, $telefon, $web, $poblacion, $genero) && updatePass($username, $pass2))
        {
            perfilModificat();
        }
    }else{
        passIncorrecte();    
    }
}