<?php

/*
*
*   error_lib.php: LIBRERÍA DE ERRORES
*
*/

/****** ERRORES GRAVES ******/
function errorConsulta($con)
{
    echo "<h1>ERROR EN LA CONSULTA: ".mysqli_error($con)."</h1>";
}