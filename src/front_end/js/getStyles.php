<?php
require "../../back_end/libs/selects_lib.php";

$con = conectar($GLOBALS['db']);
 
$query="SELECT nombre_genero FROM genero";
if($res = mysqli_query($con, $query))
{
    while ($row = mysqli_fetch_assoc($res)) 
    {
        extract($row);
        echo "<option value='$nombre_genero'>$nombre_genero</option>";
    }
}

desconectar($con);