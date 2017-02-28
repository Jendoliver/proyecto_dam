<?php
/*
*
*   selects_lib.php: LIBRERÍA DE CONSULTAS SELECT DE LA APLICACIÓN
*
*/
require_once "bbdd_lib.php";

//AUTENTICACIÓN
function checkUser($user, $pass) // Función que comprueba que el login es correcto y devuelve: 0 - Incorrecto, 1 - Fan, 2 - Banda, 3 - Local
{
    $con = conectar("proyecto");
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
    $con = conectar("proyecto");
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

//SELECTS HOMEPAGE
function selectProximosConciertos()
{
    $con = conectar("proyecto");
    $query = "SELECT fecha, nom_local, publicname
                FROM concierto
                INNER JOIN participa on concierto.id = participa.id_concierto
                INNER JOIN usuario on participa.id_banda = usuario.username
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
    $con = conectar("proyecto");
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
    $con = conectar("proyecto");
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

function selectMejoresConciertos() // no funciona
{
    $con = conectar("proyecto");
    $query = "SELECT votos_conciertos.id_concierto, nom_local, participa.id_banda, fecha, (SELECT COUNT(id_fan) FROM votos_conciertos WHERE id_concierto=concierto.id)AS valoracion_conciertos
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

//SELECTS PERFILES (generales)
function selectImgPerfil() // HA DE DEVOLVER LA RUTA DE LA IMAGEN PARA INSERTARLO EN EL SRC
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT img FROM usuario WHERE username = '$username'";
    if($res = mysqli_query($con, $query))
    {
        createTable($res); // cambiar esto
        desconectar($con);
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectPublicname()
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT publicname FROM usuario WHERE username = '$username'";
    if($res = mysqli_query($con, $query))
    {
        desconectar($con);
        return $res;
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
    }
}

function selectVideo($src)
{
    
}

//SELECTS FAN
function selectConciertosValorados() // conciertos que el fan ha valorado
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT fecha, publicname, nom_local, (SELECT  COUNT(id_concierto) FROM votos_conciertos where id_concierto=concierto.id)
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            INNER JOIN votos_conciertos on concierto.id = votos_conciertos.id_concierto
            WHERE id_fan='$username'
            ORDER BY fecha DESC
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

function selectProximosConciertosLike() // proximos conciertos de las bandas a las que le has dado like
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT fecha, publicname, nom_local
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            INNER JOIN votos_bandas on votos_bandas.id_banda = usuario.username
            WHERE (SELECT  COUNT(*) FROM votos_bandas WHERE id_fan = '$username')
            ORDER BY fecha DESC
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

//SELECTS BANDA
function selectConciertosApuntado() // conciertos a los que se ha apuntado la banda
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT id_concierto, nom_local, fecha, aceptado
            FROM participa
            INNER JOIN concierto on id_concierto = concierto.id
            WHERE id_banda = '$username'
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

function selectConciertosAceptado() // conciertos para los que han aceptado a la banda
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT id_concierto, nom_local, fecha
            FROM participa
            INNER JOIN concierto on participa.id_concierto = concierto.id
            WHERE aceptado = 1 AND id_banda = '$username'
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

//SELECTS LOCAL
function selectGruposAprobar() // grupos que se han apuntado a un concierto propuesto  -  FUNCIONA
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT publicname, id, fecha
            FROM concierto
            INNER JOIN participa on concierto.id = participa.id_concierto
            INNER JOIN usuario on participa.id_banda = usuario.username
            WHERE valoracion IS NOT NUlL AND direccion IS NULL AND nom_local = '$username'
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

function selectProximosConciertosLocal() // seleccionar proximos conciertos propuestos por el local  -  FUNCIONA
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT id, fecha, precio
            FROM concierto
            INNER JOIN usuario on usuario.username = concierto.nom_local
            WHERE username = '$username'
            ORDER BY fecha ASC
            LIMIT 10; ";
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

?>