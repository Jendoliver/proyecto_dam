<?php // selector.php: Archivo encargado de gestionar los formularios que utilizan la librería selects_lib.php
require "libs/selects_lib.php";

if(isset($_POST["login"])) // Venimos de index.php, el usuario quiere iniciar sesión
{
    session_start();
    $usertype = checkUser($_POST["username"], $_POST["password"]);
    switch($usertype) // Guardamos las variables que modifican el espacio personal y redirigimos al que toca según el tipo de usuario
    {
        case 0: errorLogin(); break;
        case 1: getSession($_POST["username"], $usertype); $_SESSION["token"] = 1; header("Location: $fanpage"); break;
        case 2: getSession($_POST["username"], $usertype); $_SESSION["token"] = 1; header("Location: $bandpage"); break;
        case 3: getSession($_POST["username"], $usertype); $_SESSION["token"] = 1; header("Location: $garitopage"); break;
    }
}
else if(isset($_POST["visitProfile"])) // Venimos de queryresult.php, visitamos un perfil
{
    switch($_POST["usertype"])
    {
        case "fan": getSession($_POST["username"], 0, 0); header("Location: $fanpagevisit"); break;
        case "banda": getSession($_POST["username"], 1, 0); header("Location: $bandpagevisit"); break;
        case "local": getSession($_POST["username"], 2, 0); header("Location: $garitopagevisit"); break;
    }
}
else
{
    errorSelector();
}