<?php
/*
*
*   deletes_lib.php: Librería de consultas DELETE de la aplicación
*
*/

require_once "bbdd_lib.php";

function deleteConcert($idconcert)
{
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, "DELETE FROM concierto WHERE id = $idconcert;"))
    {
        desconectar($con);
        return true;
    }
    errorConsulta($con);
    desconectar($con);
    return false;
}