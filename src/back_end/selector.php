<?php // selector.php: Archivo encargado de gestionar los formularios que utilizan la librería selects_lib.php
require "libs/selects_lib.php";

if(isset($_POST["login"])) // Venimos de index.php, el usuario quiere iniciar sesión
{
    session_start();
    $usertype = checkUser($_POST["username"], $_POST["password"]);
    switch($usertype) // Guardamos las variables que modifican el espacio personal y redirigimos al que toca según el tipo de usuario
    {
        case 0: errorLogin(); break;
        case 1: getSession($_POST["username"], $usertype); header("Location: ../front_end/fan.php"); break;
        case 2: getSession($_POST["username"], $usertype); header("Location: ../front_end/banda.php"); break;
        case 3: getSession($_POST["username"], $usertype); header("Location: ../front_end/local.php"); break;
    }
}
/*else if
{
    
}*/
else
{
    errorSelector();
}