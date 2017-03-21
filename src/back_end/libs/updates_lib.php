<?php
/*
*
*   updates_lib.php: Librería de consultas UPDATE
*
*/

require "inserts_lib.php";

function updateConcertStatus($idconcierto, $userbanda, $accepted)
{
    $update = "UPDATE participa SET aceptado = ";
    if($accepted)
        $update .= "1 "; // Aceptado
    else
        $update .= "2 "; // Rechazado
    $update .= "WHERE id_concierto = $idconcierto AND id_banda = '$userbanda';";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $update))
    {
        desconectar($con);
        return 1;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}