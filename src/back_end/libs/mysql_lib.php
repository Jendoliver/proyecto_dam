<?php //MYSQL_LIB.PHP: DEFINICIÓN DE TODAS LAS FUNCIONES DE GESTIÓN CON LA BASE DE DATOS
    
function alreadyExists($data, $table, $attrib) // FUNCIÓN PARA COMPROBAR SI EXISTE UN DATO EN UNA TABLA (devuelve bool)
{ // data = dato a encontrar, table = tabla en la que buscar, attrib = columna
    $con = conectar("proyecto");

    $query = "SELECT $attrib FROM $table WHERE $attrib = '".mysqli_real_escape_string($con, $data)."'";
    $res = mysqli_query($con, $query);
    if(!($res))
        errorConsulta();
        
    if (mysqli_num_rows($res))
        return true;
    return false;
}

function insertData($data, $table, $usertype) // FUNCIÓN PARA INSERTAR UN DATO EN UNA TABLA (devuelve bool: 1 - NO ERRORES, 0 - ERRORES) esta mierda no rula no os lo creais
{ // data = dato a insertar, table = tabla en la que insertar, attrib = columna
    if(!($db = mysqli_connect("127.0.0.1", "jandol", "", "usuarios", 3306)))
        die("Error: No se pudo conectar");
    
    switch($usertype) // 
    {
        case "fan":
        case "banda":
        case "garito":
        default:
    }
    $res = mysqli_query($db, $query);
}

?>