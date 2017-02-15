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
    $query = "SELECT * FROM Usuario WHERE username = '$user' AND pass = '$pass';";
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
    $query = "SELECT * FROM Usuario WHERE username = '$user' AND aforo IS NULL AND valoracion IS NULL;"; // Comprobación fan
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
    
    $query = "SELECT * FROM Usuario WHERE username = '$user' AND aforo IS NULL AND valoracion IS NOT NULL;"; // Comprobación banda
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
    
    $query = "SELECT * FROM Usuario WHERE username = '$user' AND aforo IS NOT NULL AND valoracion IS NOT NULL;"; // Comprobación local
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
                FROM Concierto
                INNER JOIN Participa on Concierto.id = Participa.id_concierto
                INNER JOIN Usuario on Participa.id_banda = Usuario.username
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

function selectMejoresLocales()
{
    $con = conectar("proyecto");
    $query = "SELECT publicname, nombre_genero, valoracion
                FROM Usuario
                INNER JOIN Genero_user on Usuario.username = Genero_user.id_user
                INNER JOIN Genero on Genero_user.id_genero = Genero.id
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
                FROM Usuario
                INNER JOIN Genero_user on Usuario.username = Genero_user.id_user
                INNER JOIN Genero on Genero_user.id_genero = Genero.id
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
    $con = conectar("proyecto");
    $query = "SELECT publicname, nom_local, fecha, 
               (SELECT COUNT(*) 
                    FROM votos_conciertos 
                    INNER JOIN Concierto on Votos_conciertos.id_concierto = Concierto.id 
                    GROUP BY Concierto.id) as valoracion_concierto
                FROM Concierto
                INNER JOIN Participa on Concierto.id = Participa.id_banda
                INNER JOIN Usuario on Participa.id_banda = Usuario.username
                ORDER BY valoracion_concierto DESC
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
function selectImgPerfil()
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT img FROM Usuario WHERE username = '$username'";
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

function selectPublicname()
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT publicname FROM Usuario WHERE username = '$username'";
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

function selectVideo($src)
{
    
}

//SELECTS FAN
function selectConciertosValorados() // conciertos que el fan ha valorado
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT fecha, publicname, nom_local
                FROM Concierto
                INNER JOIN Participa on Concierto.id = Participa.id_banda
                INNER JOIN Usuario on Participa.id_banda = Usuario.username
                WHERE COUNT(SELECT * FROM votos_conciertos WHERE id_fan = '$username') = 1
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

function selectProximosConciertosLike() // proximos conciertos de las bandas a las que le has dado like
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT fecha, publicname, nom_local
                FROM Concierto
                INNER JOIN Participa on Concierto.id = Participa.id_banda
                INNER JOIN Usuario on Participa.id_banda = Usuario.username
                WHERE COUNT(SELECT * FROM votos_bandas WHERE id_fan = '$username') = 1
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

//SELECTS BANDA
function selectConciertosApuntado() // conciertos a los que se ha apuntado la banda
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT id_concierto, nom_local, fecha, aceptado
            FROM Participa
            INNER JOIN Concierto on id_conicerto = Concierto.id
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
    $query = "SELECT id_concierto, nom_local, fecha, aceptado
            FROM Participa
            INNER JOIN Concierto on id_conicerto = Concierto.id
            WHERE id_banda = '$username' AND aceptado = 1
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
function selectGruposAprobar() // grupos que se han apuntado a un concierto propuesto
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT publicname, id, fecha
            FROM Concierto
            INNER JOIN Participa on Concierto.id = Participa.id_concierto
            INNER JOIN Usuario on Participa.id_banda = Usuario.username
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

function selectProximosConciertosLocal() // seleccionar proximos conciertos propuestos por el local
{
    session_start();
    $username = $_SESSION["username"];
    $con = conectar("proyecto");
    $query = "SELECT id, fecha, precio
            FROM Concierto
            INNER JOIN Usuario on Usuario.publicname = Concierto.nom_local
            WHERE nom_local = pubblicname AND username = '$username'
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

?>