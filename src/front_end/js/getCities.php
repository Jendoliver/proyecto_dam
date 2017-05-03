<?php
/*** EXTRACTED FROM SELECTS_LIB (selectPoblacionMod) ***/
require "../../back_end/libs/bbdd_lib.php";
$poblacion = $_POST["poblacion"];

$con = conectar($GLOBALS['db']);
if($res = mysqli_query($con, "SELECT id, nombre_poblacion FROM poblacion"))
{
    while($row = mysqli_fetch_assoc($res))
    {
        extract($row);
        echo "<option class='form-control' value='$id' ";
        if($poblacion==$nombre_poblacion){ echo " selected='selected' "; }
            echo " >$nombre_poblacion</option>";
    }
}
else
    errorConsulta($con);
desconectar($con);