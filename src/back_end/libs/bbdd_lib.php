<?php
/*
*
*   bbdd_lib.php: FUNCIONES BÁSICAS DE COMUNICACIÓN CON LA BBDD
*
*/
require "error_lib.php";

function conectar($db) // Todo un clásico
{
    $conexion = mysqli_connect("mysql128int.srv-hostalia.com", "lechero", "9fk27/Cj?[h]vCLN", $db) or
        die("No se ha podido conectar a la BBDD");
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

function getSession($user, $usertype) // obtiene las variables de sesión de un usuario
{
    $con = conectar("proyecto");
    $query = "SELECT * FROM Usuario WHERE username = '$user'";
    if($res = mysqli_query($con, $query))
    {
        session_start();
        extract($res);
        $_SESSION["username"] = $username;
        $_SESSION["publicname"] = $publicname;
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
function createTable($res) // Crea una tabla genérica automáticamente con el resultado de una query
{
    if($row = mysqli_fetch_assoc($res)) //comprobamos que hay algo para evitar warning
    {
        $table = "<table class='table table-hover'>"; // ese bootstrap joder
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            $table .= "<th>$key</th>";
        }
        $table .= "</thead><tbody>"; // cierre del header y apertura del body
    
        do // llenar tabla con el contenido de la query
        {
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                $table .= "<td>$value</td>";
            }
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}