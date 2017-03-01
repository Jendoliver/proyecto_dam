<?php
/*
*
*   bbdd_lib.php: FUNCIONES BÁSICAS DE COMUNICACIÓN CON LA BBDD
*
*/
require "error_lib.php";


function conectar($database) // Todo un clásico
{
    //$conexion = mysqli_connect("mysql128int.srv-hostalia.com", "lechero", "9fk27/Cj?[h]vCLN", $database) or PARA EL HOSTING
    $conexion = mysqli_connect("localhost", "jandol", "", $database) or // Para C9
        die("No se ha podido conectar a la BBDD");
    mysqli_set_charset($conexion, "utf8");
    return $conexion;
}

function desconectar($con) // Otra que tal
{
    mysqli_close($con);
}

function auth() // Función que comprueba que se accede a la web logueado (1 - OK, 0 - No logueado)
{
    session_start();
    if($_SESSION["token"] == 1)
        return 1;
    else
        return 0;
}

function generateID($table)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT * FROM $table";
    if($res = mysqli_query($con, $query))
    {
        desconectar($con);
        return mysqli_num_rows($res)+1;
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function alreadyExists($data, $table, $attrib) // FUNCIÓN PARA COMPROBAR SI EXISTE UN DATO EN UNA TABLA (devuelve bool)
{ // data = dato a encontrar, table = tabla en la que buscar, attrib = columna
    $con = conectar($GLOBALS['db']);

    $query = "SELECT $attrib FROM $table WHERE $attrib = '".mysqli_real_escape_string($con, $data)."'";
    if($res = mysqli_query($con, $query))
    {
        desconectar($con);
        if (mysqli_num_rows($res))
            return 1;
        return 0;
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function getSession($user, $usertype) // obtiene las variables de sesión de un usuario
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT * FROM usuario WHERE username = '$user'";
    if($res = mysqli_query($con, $query))
    {
        session_start();
        $row = mysqli_fetch_assoc($res);
        extract($row);
        $_SESSION["username"] = $username;
        $_SESSION["publicname"] = $publicname;
        $_SESSION["poblacion"] = idToValue($id_poblacion, "nombre_poblacion", "poblacion");
        $_SESSION["email"] = $email;
        $_SESSION["img"] = $img;
        
        switch($usertype)
        {
            case 1: break; // fan
            case 2: $_SESSION["web"] = $web; $_SESSION["tel"] = $tel; $_SESSION["valoracion"] = $valoracion; break;
            case 3: $_SESSION["web"] = $web; $_SESSION["tel"] = $tel; $_SESSION["direccion"] = $direccion; $_SESSION["valoracion"] = $valoracion; break;
        }
    }
    else
    {
        errorConsulta();
        desconectar($con);
    }
}

//UTILIDADES
function localToPublic($username) // devuelve el publicname asociado a $username - 0 = ERROR
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT publicname FROM usuario WHERE username = '$username';";
    if($res = mysqli_query($con, $query))
    {
        $row = mysqli_fetch_assoc($res);
        desconectar($con);
        return $row["publicname"];
    }
    else
        errorConsulta($con);
    desconectar($con);
    return 0;
}

function idToValue($id, $col, $table) // devuelve el valor en la columna $col asociado a la id en una tabla hash
{
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, "SELECT $col FROM $table WHERE id = $id"))
    {
        $row = mysqli_fetch_assoc($res);
        desconectar($con);
        return $row[$col];
    }
    else
        errorConsulta($con);
    desconectar($con);
    return 0;
}

function createTable($res) // Crea una tabla genérica automáticamente con el resultado de una query
{
    if($row = mysqli_fetch_assoc($res)) //comprobamos que hay algo para evitar warning
    {
        $table = "<table class='table table-hover'>"; // ese bootstrap joder
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            switch($key)
            {
                case "nom_local": $table .= "<th>Garito</th>"; break;
                case "id_banda": $table .= "<th>Banda</th>"; break;
                case "publicname": $table .= "<th>Nombre</th>"; break;
                case "nombre_genero": $table .= "<th>Género</th>"; break;
                case "valoracion": $table .= "<th>Valoración</th>"; break;
                case "valoracion_conciertos": $table .= "<th>Valoración</th>"; break;
                case "fecha": $table .= "<th>Fecha</th>"; break;
                case "precio": $table .= "<th>Pago por grupo</th>"; break;
                case "aceptado": $table .= "<th>Estado de la solicitud</th>"; break;
                case "id_concierto": break;
                default: $table .= "<th>$key</th>";
            }
        }
        $table .= "</thead><tbody>"; // cierre del header y apertura del body
    
        do // llenar tabla con el contenido de la query
        {
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                switch($key)
                {
                    case "nom_local": $table .= "<td>".localToPublic($value)."</td>"; break;
                    case "id_banda": $table .= "<td>".localToPublic($value)."</td>"; break;
                    case "aceptado":
                        {
                            switch($value)
                            {
                                case 0: $table .= "<td>Pendiente</td>"; break;
                                case 1: $table .= "<td>Aceptado</td>"; break;
                                case 2: $table .= "<td>Rechazado</td>"; break;
                            }
                        }
                    case "id_concierto": break;
                    default: $table .= "<td>$value</td>";
                }
            }
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}