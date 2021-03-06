<?php
/*
*
*   selects_lib.php: LIBRERÍA DE CONSULTAS SELECT DE LA APLICACIÓN
*
*/
require "bbdd_lib.php";

/***************** AUTENTICACIÓN *******************/
function checkUser($user, $pass) // Función que comprueba que el login es correcto y devuelve: 0 - Incorrecto, 1 - Fan, 2 - Banda, 3 - Local
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT pass FROM usuario WHERE username = '$user';";
    $res = mysqli_query($con, $query);
    desconectar($con);
    if(mysqli_num_rows($res)) // si existe un usuario con ese username, comprobamos la contraseña
    {
        $row = mysqli_fetch_row($res);
        if(password_verify($pass, $row[0]))
            return checkUserType($user); // si las credenciales son correctas checkeamos y devolvemos el tipo de usuario
    }
    return 0;
}

function checkUserType($user) // checkea el tipo de usuario y devuelve: 1 = Fan, 2 = Banda, 3 = Local
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT * FROM usuario WHERE username = '$user' AND aforo IS NULL AND valoracion IS NULL;"; // Comprobación fan
    $res = mysqli_query($con, $query);
    if(mysqli_num_rows($res)) 
    {
        desconectar($con);
        return 1; // El usuario es un fan
    }

    $query = "SELECT * FROM usuario WHERE username = '$user' AND aforo IS NULL AND valoracion IS NOT NULL;"; // Comprobación banda
    $res = mysqli_query($con, $query);
    if(mysqli_num_rows($res)) 
    {
        desconectar($con);
        return 2; // El usuario es una banda
    }
    $query = "SELECT * FROM usuario WHERE username = '$user' AND aforo IS NOT NULL AND valoracion IS NOT NULL;"; // Comprobación garito
    $res = mysqli_query($con, $query);
    if(mysqli_num_rows($res))
    {
        desconectar($con);
        return 3; // El usuario es un garito
    }
    desconectar($con);
    return 0; // El usuario no existe
}

/***************** SELECTS HOMEPAGE *******************/
function selectProximosConciertos($loggedfan=0) // NO ESTÁ EN LA HOMEPAGE (usar para lo último...?)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT fecha, nom_local, publicname
                FROM concierto
                INNER JOIN participa on concierto.id = participa.id_concierto
                INNER JOIN usuario on participa.id_banda = usuario.username
                WHERE fecha>=CURDATE()
                ORDER BY fecha ASC
                LIMIT 10;";
    if($res = mysqli_query($con, $query))
    {
        createTable($res);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectMejoresBandas($loggedfan=0)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT username, publicname, nombre_genero, valoracion
            FROM usuario 
            INNER JOIN genero_user on usuario.username = genero_user.id_user
            INNER JOIN genero on genero_user.id_genero = genero.id
            WHERE aforo IS NULL AND valoracion IS NOT NULL
            ORDER BY valoracion DESC 
            LIMIT 5;";
    if($res = mysqli_query($con, $query))
    {
        if($loggedfan)
            createTable($res, 12);
        else
            createTable($res);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }  
}

function selectMejoresGaritos($loggedfan=0)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT username, publicname, nombre_genero, valoracion
            FROM usuario 
            INNER JOIN genero_user on usuario.username = genero_user.id_user
            INNER JOIN genero on genero_user.id_genero = genero.id
            WHERE aforo IS NOT NULL
            ORDER BY valoracion DESC
            LIMIT 5;";
    if($res = mysqli_query($con, $query))
    {
        if($loggedfan)
            createTable($res, 13);
        else
            createTable($res);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }          
}

function selectMejoresConciertos($loggedfan=0)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT id, votos_conciertos.id_concierto, nom_local, participa.id_banda, fecha, (SELECT COUNT(id_fan) FROM votos_conciertos WHERE id_concierto=concierto.id) AS valoracion_conciertos
            FROM concierto
            INNER JOIN votos_conciertos on concierto.id = votos_conciertos.id_concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            GROUP BY id_concierto
            ORDER BY valoracion_conciertos DESC
            LIMIT 5;";
    if($res = mysqli_query($con, $query))
    {
        if($loggedfan)
            createTable($res, 1);
        else
            createTable($res);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

/***************** SELECTS REGISTRO *******************/
function selectGeneros()
{
    $con = conectar($GLOBALS['db']);
    $res = mysqli_query($con, "SELECT id, nombre_genero FROM genero");
    while($row = mysqli_fetch_assoc($res))
    {
        extract($row);
        echo "<option value='$id'>$nombre_genero</option>";
    }
    desconectar($con);
}

function selectPoblaciones()
{
    $con = conectar($GLOBALS['db']);
    $res = mysqli_query($con, "SELECT id, nombre_poblacion FROM poblacion");
    while($row = mysqli_fetch_assoc($res))
    {
        extract($row);
        echo "<option value='$id'>$nombre_poblacion</option>";
    }
    desconectar($con);
}

function selectInstrumentos()
{
    $con = conectar($GLOBALS['db']);
    $res = mysqli_query($con, "SELECT nombre_instrumento FROM instrumento");
    while($row = mysqli_fetch_assoc($res))
    {
        extract($row);
        echo "<option value='$nombre_instrumento'>$nombre_instrumento</option>";
    }
    desconectar($con);
}

/***************** SELECTS PERFILES (generales) *******************/
function selectImgPerfil($username) // HA DE DEVOLVER LA RUTA DE LA IMAGEN PARA INSERTARLO EN EL SRC
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT img FROM usuario WHERE username = '$username'";
    if($res = mysqli_query($con, $query))
    {
        $row = mysqli_fetch_assoc($res);
        desconectar($con);
        return $row["img"];
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectPublicname($username)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT publicname FROM usuario WHERE username = '$username'";
    if($res = mysqli_query($con, $query))
    {
        $row = mysqli_fetch_assoc($res);
        desconectar($con);
        return $row["publicname"];
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
        return "undefined";
    }
}

function selectVideo($src)
{
    
}

/***************** SELECTS FAN *******************/
function selectConciertosValorados($username) // conciertos que el fan ha valorado
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT concierto.id, fecha, publicname, nom_local, (SELECT  COUNT(id_concierto) FROM votos_conciertos where id_concierto=concierto.id) AS valoracion_conciertos
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            INNER JOIN votos_conciertos on concierto.id = votos_conciertos.id_concierto
            WHERE id_fan='$username'
            ORDER BY fecha DESC
            LIMIT 10;";
    if($res = mysqli_query($con, $query))
    {
        createTable($res, 1);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectProximosConciertosLike($username) // proximos conciertos de las bandas a las que le has dado like
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT concierto.id, fecha, publicname, nom_local
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            INNER JOIN votos_bandas on votos_bandas.id_banda = usuario.username
            WHERE (SELECT  COUNT(*) FROM votos_bandas WHERE id_fan = '$username') AND  fecha>=CURDATE()
            ORDER BY fecha DESC
            LIMIT 10;";
    if($res = mysqli_query($con, $query))
    {
        createTable($res, 1);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

/***************** SELECTS BANDA *******************/
function selectConciertosApuntado($username) // conciertos a los que se ha apuntado la banda
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT concierto.id, id_concierto, nom_local, fecha, aceptado
            FROM participa
            INNER JOIN concierto on id_concierto = concierto.id
            WHERE id_banda = '$username' AND  fecha>=CURDATE()
            ORDER BY fecha ASC
            LIMIT 10;";
    if($res = mysqli_query($con, $query))
    {
        createTable($res, 1);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectConciertosAceptado($username) // conciertos para los que han aceptado a la banda
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT concierto.id, id_concierto, nom_local, fecha
            FROM participa
            INNER JOIN concierto on participa.id_concierto = concierto.id
            WHERE aceptado = 1 AND id_banda = '$username' AND  fecha>=CURDATE()
            ORDER BY fecha ASC
            LIMIT 10;";
    if($res = mysqli_query($con, $query))
    {
        createTable($res, 1);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

/***************** SELECTS LOCAL *******************/
function selectGruposAprobar($username) // grupos que se han apuntado a un concierto propuesto  -  FUNCIONA
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT concierto.id, username AS 'grupoaprobar', publicname, fecha
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            WHERE valoracion IS NOT NULL AND direccion IS NULL AND nom_local = '$username' AND aceptado = 0 AND fecha>=CURDATE()
            ORDER BY fecha ASC
            LIMIT 10;";
    if($res = mysqli_query($con, $query))
    {
        session_start();
        if($_SESSION["username"] == $username) // si es mi página
            createTable($res, 3);
        else
            createTable($res);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectProximosConciertosLocal($username) // seleccionar proximos conciertos propuestos por el local  -  FUNCIONA
{
    session_start();
    $con = conectar($GLOBALS['db']);
    $query = "SELECT concierto.id, fecha, precio
            FROM concierto
            INNER JOIN usuario on usuario.username = concierto.nom_local
            WHERE username = '$username' AND fecha>=CURDATE()
            ORDER BY fecha ASC
            LIMIT 10; ";
    if($res = mysqli_query($con, $query))
    {
        if($_SESSION["usertype"] == 2)
            createTable($res, 2);
        else if($_SESSION["usertype"] == 3)
            createTable($res, 32);
        else if($_SESSION["usertype"] == 1)
            createTable($res, 1);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

// CREATE TABLE UTILITIES
function votoExiste($userfan, $votado, $tabla)
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT * FROM ";
    switch($tabla)
    {
        case "concierto": $query .= "votos_conciertos WHERE id_fan = '$userfan' AND id_concierto = $votado;"; break;
        case "banda": $query .= "votos_bandas WHERE id_fan = '$userfan' AND id_banda = '$votado';"; break;
        case "local": $query .= "votos_locales WHERE id_fan = '$userfan' AND id_local = '$votado';"; break;
    }
    
    if($res = mysqli_query($con, $query))
    {
        desconectar($con);
        return mysqli_num_rows($res) > 0;
    }
    errorConsulta($con);
    desconectar($con);
}

function isInscrito($userbanda, $idconcierto)
{
    $con = conectar($GLOBALS['db']);
    $res = mysqli_query($con, "SELECT * FROM participa WHERE id_concierto = $idconcierto AND id_banda = '$userbanda';");
    return mysqli_num_rows($res) > 0;
}
//select de ciudades i estils per modificar
function selectModGenero($idgenero)
{
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, "SELECT id, nombre_genero FROM genero"))
    {
        while ($cons = mysqli_fetch_array($ciu)) {
            extract($cons);
            echo "<option value='$id' ";
            if($name==$idgenero){ echo " selected "; }
                echo " >$nombre_genero</option>";
        }
        echo "</select><br>";
    }
    else
    errorConsulta($con);
    desconectar($con);
}

function selectGeneroMod($username)
{
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, "SELECT id_genero FROM genero_user WHERE id_user='$username'"))
    $row2 = mysqli_fetch_assoc($res);
    if($res = mysqli_query($con, "SELECT id, nombre_genero FROM genero"))
    {
        while($row = mysqli_fetch_assoc($res))
        {
            extract($row);
            echo "<option class='form-control' value='$id' ";
            extract($row2);
            if($id_genero==$nombre_genero){ echo " selected='selected' "; }
                echo " >$nombre_genero</option>";
        }
    }
    else
    errorConsulta($con);
    desconectar($con);
}
/***************** SELECTS per buscar perfils *******************/
function selectBusqueda($buscar)
{
    global $selector, $imgfiles;
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, "SELECT username, publicname, img FROM usuario
        WHERE publicname LIKE '%$buscar%' OR username LIKE '%$buscar%'"))
    {
        while($row = mysqli_fetch_assoc($res))
        {
            extract($row);
            if(checkUserType($username)==1)
            {
                $usertype='fan';
            }
            else if(checkUserType($username)==2)
            {
                $usertype='banda';
            }
            else if(checkUserType($username)==3)
            {
                $usertype='local';
            }
            echo "<div class='col-md-3'>
                    <div class='row well'>
                        <div class='col-md-5'>
                            <img class='img-responsive' src='$imgfiles"."$img'/>
                        </div>
                        <div class='col-md-7'>
                            <h3>Perfil de $publicname</h3>
                            <h4><em>@$username</em></h4>
                            <h5>($usertype)</h5>
                            <form action='$selector' method='POST'>
                                <input type='hidden' name='username' value='$username'>
                                <input type='hidden' name='usertype' value='$usertype'>
                                <input class='btn btn-success' type='submit' name='visitProfile' value='Visitar'>
                            </form>
                        </div>
                    </div>
                </div>";
        }
    }
    else
        echo "<div>
            <h3>No se ha encontrado resultados</h3>
        </div>";
        desconectar($con);
}
?>