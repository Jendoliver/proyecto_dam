<?php //MYSQL_LIB.PHP: DEFINICIÓN DE TODAS LAS FUNCIONES DE GESTIÓN CON LA BASE DE DATOS
    
function alreadyExists($data, $table, $attrib) // FUNCIÓN PARA COMPROBAR SI EXISTE UN DATO EN UNA TABLA (devuelve bool)
{ // data = dato a encontrar, table = tabla en la que buscar, attrib = columna
    if(!($db = mysqli_connect("127.0.0.1", "jandol", "", "usuarios", 3306)))
        die("Error: No se pudo conectar");

    $query = "SELECT $attrib FROM $table WHERE $attrib = '".mysqli_real_escape_string($db, $data)."'";
    $res = mysqli_query($db, $query);
    if(!($res))
        die("Error en la consulta, la inyección te la puedes meter en el anuard");
        
    if (mysqli_num_rows($res)==0)
        return false;
    return true;
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