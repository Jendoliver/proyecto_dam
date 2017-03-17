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