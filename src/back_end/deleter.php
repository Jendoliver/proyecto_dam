<?php

require_once "libs/delete_lib.php";

if(isset($_POST["deleteconcert"])) // Caso borrar concierto
{
    if(deleteConcert(intval($_POST["idconcert"])))
        concertDewa();
}
else
{
    echo "<h1>Ull</h1>";
}