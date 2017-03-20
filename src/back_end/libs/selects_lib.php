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
    $query = "SELECT * FROM usuario WHERE username = '$user' AND pass = '$pass';";
    if($res = mysqli_query($con, $query)) // si no hay error en la consulta
    {
        if(mysqli_num_rows($res)) // si existe un usuario con ese username y pass, comprobamos su tipo
        {
            return checkUserType($user);
        }
        else
        {
            desconectar($con);
            return 0; // no existe un usuario con esas credenciales
        }
    }
    else
    {
        errorConsulta();
        desconectar($con);
    }
}

function checkUserType($user) // checkea el tipo de usuario y devuelve: 1 = Fan, 2 = Banda, 3 = Local
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT * FROM usuario WHERE username = '$user' AND aforo IS NULL AND valoracion IS NULL;"; // Comprobación fan
    if($res = mysqli_query($con, $query)) 
    {
        if(mysqli_num_rows($res)) 
        {
            desconectar($con);
            return 1; // El usuario es un fan
        }
    }
    else 
    {
        errorConsulta();
        desconectar($con);
    }
    
    $query = "SELECT * FROM usuario WHERE username = '$user' AND aforo IS NULL AND valoracion IS NOT NULL;"; // Comprobación banda
    if($res = mysqli_query($con, $query)) 
    {
        if(mysqli_num_rows($res)) 
        {
            desconectar($con);
            return 2; // El usuario es una banda
        }
    }
    else 
    {
        errorConsulta();
        desconectar($con);
    }
    
    $query = "SELECT * FROM usuario WHERE username = '$user' AND aforo IS NOT NULL AND valoracion IS NOT NULL;"; // Comprobación local
    if($res = mysqli_query($con, $query)) 
    {
        if(mysqli_num_rows($res)) 
        {
            desconectar($con);
            return 3; // El usuario es un local
        }
    }
    else 
    {
        errorConsulta();
        desconectar($con);
    }
}

/***************** SELECTS HOMEPAGE *******************/
function selectProximosConciertos()
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

function selectMejoresGaritos()
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT publicname, nombre_genero, valoracion
            FROM usuario 
            INNER JOIN genero_user on usuario.username = genero_user.id_user
            INNER JOIN genero on genero_user.id_genero = genero.id
            WHERE aforo IS NOT NULL
            ORDER BY valoracion DESC
            LIMIT 5;";
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

function selectMejoresBandas()
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT publicname, nombre_genero, valoracion
            FROM usuario 
            INNER JOIN genero_user on usuario.username = genero_user.id_user
            INNER JOIN genero on genero_user.id_genero = genero.id
            WHERE aforo IS NULL AND valoracion IS NOT NULL
            ORDER BY valoracion DESC 
            LIMIT 5;";
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

function selectMejoresConciertos()
{
    $con = conectar($GLOBALS['db']);
    $query = "SELECT votos_conciertos.id_concierto, nom_local, participa.id_banda, fecha, (SELECT COUNT(id_fan) FROM votos_conciertos WHERE id_concierto=concierto.id) AS valoracion_conciertos
            FROM concierto
            INNER JOIN votos_conciertos on concierto.id = votos_conciertos.id_concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            GROUP BY id_concierto
            ORDER BY valoracion_conciertos DESC
            LIMIT 5;";
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

/***************** SELECTS REGISTRO *******************/
function selectGeneros()
{
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, "SELECT id, nombre_genero FROM genero"))
    {
        while($row = mysqli_fetch_assoc($res))
        {
            extract($row);
            echo "<option value='$id'>$nombre_genero</option>";
        }
    }
    else
        errorConsulta($con);
    desconectar($con);
}

function selectPoblaciones()
{
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, "SELECT id, nombre_poblacion FROM poblacion"))
    {
        while($row = mysqli_fetch_assoc($res))
        {
            extract($row);
            echo "<option value='$id'>$nombre_poblacion</option>";
        }
    }
    else
        errorConsulta($con);
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
    $query = "SELECT concierto.id, publicname, fecha
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            WHERE valoracion IS NOT NUlL AND direccion IS NULL AND nom_local = '$username' AND  fecha>=CURDATE()
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
        if($_SESSION["usertype"] != 1)
            createTable($res, 2);
        else
            createTable($res, 1);
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

?>