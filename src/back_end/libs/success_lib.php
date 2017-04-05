<?php

/*
*
*   success_lib.php: LIBRERÍA DE MENSAJES DE ÉXITO
*
*/
require "constants.php";

/******** MENSAJES GUAYS *********/
function conciertoCreado() // Molaría colección de modals
{
    global $garitopage;
    $message = "¡Concierto creado con éxito!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$garitopage';
    </script>";
}

function altaCorrecta()
{
    global $bandpage;
    $message = "¡Te has dado de alta!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$bandpage';
    </script>";
}

function bandAccepted()
{
    global $garitopage;
    $message = "¡Banda aceptada!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$garitopage';
    </script>";
}

function bandNotAccepted()
{
    global $garitopage;
    $message = "¡Banda rechazada!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$garitopage';
    </script>";
}

function votoCorrecto()
{
    global $lastpage;
    $message = "¡Voto exitoso!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$lastpage';
    </script>";
    
}

function perfilModificat()
{
    global $lastpage;
    $message = "¡Perfil modificado!";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$lastpage';
    </script>";
}