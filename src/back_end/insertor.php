<?php

require "selects_lib.php";
//CASOS DE REGISTRO
if(isset($_POST["registro_fan"])) // Caso fan
{
    extract($_POST);
    if(insertFan($username, $password, $email, $publicname, $pic="img/user_image.png"))
        header("Location: '../front_end/fan.php'");
    else
        errorRegistro();
}
else if(isset($_POST["registro_banda"])) // Caso banda
{
    extract($_POST);
    if(insertBanda($username, $password, $email, $publicname, $pic="img/user_image.png", $bandstyle, $website="", $telnum)) // creamos primero la banda
    {
        for($i=0; $i<$memnum; $i++)
        {
            insertMusico($nombre[$i], $apellido[$i], $instrumento[$i], $edad[$i], $username); // a continuación los músicos, que quedan registrados en "pertenece"
        }    
        header("Location: '../front_end/banda.php'");
    else
        errorRegistro();
}
else if(isset($_POST["registro_garito"])) // Caso garito
{
    extract($_POST);
    if(insertGarito($username, $password, $email, $publicname, $pic="img/user_image.png", $direccion, $aforomax, $website="", $telnum))
        header("Location: '../front_end/local.php'");
    else
        errorRegistro();
}
else
    errorInsertor();