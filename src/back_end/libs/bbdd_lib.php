<?php
/*
*
*   bbdd_lib.php: FUNCIONES BÁSICAS DE COMUNICACIÓN CON LA BBDD
*
*/
require "error_lib.php";


function conectar($database) // Todo un clásico
{
    //$conexion = mysqli_connect("mysql128int.srv-hostalia.com", "u4993709_lechero", "9fk27/Cj?[h]vCLN", $database) or // PARA EL HOSTING 
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
        $id = 1;
        while($row = mysqli_fetch_row($res))
        {
            if($row[0] == $id)
                $id++;
            else
                break;
        }
        desconectar($con);
        return $id;
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
        return mysqli_num_rows($res) > 0;
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function getSession($user, $usertype, $islogged=1) // obtiene las variables de sesión de un usuario
{
    global $fanpage, $bandpage, $garitopage;
    $con = conectar($GLOBALS['db']);
    $query = "SELECT * FROM usuario WHERE username = '$user'";
    if($res = mysqli_query($con, $query))
    {
        session_start();
        $row = mysqli_fetch_assoc($res);
        extract($row);
        if($islogged)
        {
            $_SESSION["usertype"] = $usertype;
            $_SESSION["username"] = $username;
            $_SESSION["publicname"] = $publicname;
            $_SESSION["poblacion"] = idToValue($id_poblacion, "nombre_poblacion", "poblacion");
            $_SESSION["email"] = $email;
            $_SESSION["img"] = $img;
        }
        else
        {
            $_SESSION["usertypevisit"] = $usertype;
            $_SESSION["usernamevisit"] = $username;
            $_SESSION["publicnamevisit"] = $publicname;
            $_SESSION["poblacionvisit"] = idToValue($id_poblacion, "nombre_poblacion", "poblacion");
            $_SESSION["emailvisit"] = $email;
            $_SESSION["imgvisit"] = $img;
        }
        
        
        switch($usertype)
        {
            case 1: if($islogged) $_SESSION["home"] = $fanpage; break; // fan
            case 2: if($islogged){ $_SESSION["home"] = $bandpage; $_SESSION["web"] = $web; $_SESSION["tel"] = $tel; $_SESSION["valoracion"] = $valoracion; } else { $_SESSION["webvisit"] = $web; $_SESSION["telvisit"] = $tel; $_SESSION["valoracionvisit"] = $valoracion; } break;
            case 3: if($islogged){ $_SESSION["home"] = $garitopage; $_SESSION["web"] = $web; $_SESSION["tel"] = $tel; $_SESSION["direccion"] = $direccion; $_SESSION["valoracion"] = $valoracion; } else { $_SESSION["webvisit"] = $web; $_SESSION["telvisit"] = $tel; $_SESSION["direccionvisit"] = $direccion; $_SESSION["valoracionvisit"] = $valoracion; } break;
        }
    }
    else
    {
        errorConsulta();
        desconectar($con);
    }
}

//UTILIDADES
/*function isPageFrom($username) para usar solo una página...
{
    
}*/
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

function createTable($res, $button = 0) // Crea una tabla genérica automáticamente con el resultado de una query
{ // | BUTTON = 0: Sin botones | = 1: Botón de votación concierto (fans) | = 2: Botón de inscribirse a concierto (bandas) | = 3: Botones de aceptar/rechazar banda (local) 
    global $imglike, $imgdislike, $insertor, $updater;
    if($button) { session_start(); extract($_SESSION); }
    
    if($row = mysqli_fetch_assoc($res)) //comprobamos que hay algo para evitar warning
    {
        $table = "<table class='table table-hover'>"; // ese bootstrap joder
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            switch($key) // preparamos nombres de columnas bonitos
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
                case "id": break;
                case "grupoaprobar": break;
                case "username": break;
                default: $table .= "<th>$key</th>";
            }
        }
        
        switch($button) // según button, añadimos cabeceras para las columnas de los botones
        {
            case 0: break;
            case 1: if($usertype == 1) $table .= "<th>¡Vota!</th>"; break;
            case 12: $table .= "<th>¡Vota!</th>"; break;
            case 13: $table .= "<th>¡Vota!</th>"; break;
            case 2: if($usertype == 2) $table .= "<th>¡Inscríbete!</th>"; break; // solo las bandas se inscriben a conciertos
            case 3: $table .= "<th>Aceptar bandas</th>"; "<th>Rechazar bandas</th>"; break;
        }
        
        $table .= "</thead><tbody>"; // cierre del header y apertura del body
    
        do // llenar tabla con el contenido de la query
        {
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                switch($key) // preparamos outputs especiales para que se vean bonitos
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
                    case "id": $idconcierto = $value; break;
                    case "grupoaprobar": $userbanda = $value; break;
                    case "username": $userperfil = $value; break;
                    case "valoracion": $table .= "<td>$value</td>"; break;
                    default: $table .= "<td>$value</td>";
                }
            }
            
            switch($button) // preparamos los botones según el caso
            {
                case 0: break; // sin botones
                case 1: if($usertype == 1) { $table .= "<td><form action='$insertor' method='POST'><input type='hidden' name='idconcierto' value='$idconcierto'><input type='hidden' name='userfan' value='$username'><button type='submit' name='valorar_concierto'>"; if(votoExiste($username, intval($idconcierto), "concierto")) $table .= "<img width='20' height='20' src='$imgdislike'>"; else $table .= "<img width='20' height='20' src='$imglike'>"; $table .= "</img></button></form></td>"; } break;
                case 12: $table .= "<td><form action='$insertor' method='POST'><input type='hidden' name='usertype' value='2'><input type='hidden' name='userfan' value='$username'><input type='hidden' name='userperfil' value='$userperfil'><button type='submit' name='valorar_perfil_tabla'>"; if(votoExiste($username, $userperfil, "banda")) $table .= "<img width='20' height='20' src='$imgdislike'>"; else $table .= "<img width='20' height='20' src='$imglike'>"; $table .= "</img></button></form></td>"; break;
                case 13: $table .= "<td><form action='$insertor' method='POST'><input type='hidden' name='usertype' value='3'><input type='hidden' name='userfan' value='$username'><input type='hidden' name='userperfil' value='$userperfil'><button type='submit' name='valorar_perfil_tabla'>"; if(votoExiste($username, $userperfil, "local")) $table .= "<img width='20' height='20' src='$imgdislike'>"; else $table .= "<img width='20' height='20' src='$imglike'>"; $table .= "</img></button></form></td>"; break;
                case 2: if($usertype == 2) { if(!isInscrito($username, $idconcierto)) { $table .= "<td><form action='$insertor' method='POST'><input type='hidden' name='idconcierto' value='$idconcierto'><input type='hidden' name='userbanda' value='$username'><input type='submit' class='btn btn-sm btn-primary' name='inscribirse_concierto' value='INSCRIBIRSE'></form></td>"; } else $table .= "<td>¡INSCRITO!</td>"; } break; // botón de inscribirse concierto
                case 3: $table .= "<td><form action='$updater' method='POST'><input type='hidden' name='idconcierto' value='$idconcierto'><input type='hidden' name='userbanda' value='$userbanda'><input type='submit' class='btn btn-sm btn-success' name='aceptar_banda' value='ACEPTAR'> <input type='submit' class='btn btn-sm btn-danger' name='rechazar_banda' value='RECHAZAR'></form></td>"; break; // botones aceptar/rechazar banda
            }
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}