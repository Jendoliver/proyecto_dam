<?php

/*
*
*   inserts_lib.php: Librería de consultas INSERT de la aplicación
*
*/

require "selects_lib.php";

/************ REGISTRO ****************/
function insertFan($username, $password, $email, $publicname, $poblacion, $pic)
{
    if($pic == "") // Default image
        $pic = "user_image.png";
    $con = conectar($GLOBALS['db']);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($con, $email);
    $publicname = mysqli_real_escape_string($con, $publicname);
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`id_poblacion`,`img`) VALUES ('$username', '$password', '$email', '$publicname', $poblacion, '$pic');";
        mysqli_query($con, $insert);
        desconectar($con);
        return 1;
    }
    else
    {
        errorUserExists();
        desconectar($con);
        return 0;
    }
}

function insertBanda($username, $password, $email, $publicname, $poblacion, $idgenero, $pic, $website="", $telnum)
{
    if($pic == "") // Default image
        $pic = "user_image.png";
    $con = conectar($GLOBALS['db']);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($con, $email);
    $publicname = mysqli_real_escape_string($con, $publicname);
    $website = mysqli_real_escape_string($con, $website);
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`id_poblacion`,`img`,`web`,`tel`,`valoracion`) VALUES ('$username', '$password', '$email', '$publicname', $poblacion, '$pic', '$website', '$telnum', 0);";
        if(mysqli_query($con, $insert))
        {
            if(mysqli_query($con, "INSERT INTO genero_user VALUES ('$username', $idgenero);"))
            {
                desconectar($con);
                return 1;
            }
        }
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
    else
    {
        errorUserExists();
        desconectar($con);
        return 0;
    }
}

function insertMusico($nom, $ape1, $ape2, $inst, $edad, $banda) // actualiza la tabla musico y la tabla usa
{
    $con = conectar($GLOBALS['db']);
    $nom = mysqli_real_escape_string($con, $nom);
    $ape1 = mysqli_real_escape_string($con, $ape1);
    $ape2 = mysqli_real_escape_string($con, $ape2);
    $id = generateID("musico");
    $insert = "INSERT INTO musico VALUES ($id, '$nom', '$ape1', '$ape2', $edad);";
    if(mysqli_query($con, $insert))
    {
        if(mysqli_query($con, "INSERT INTO usa VALUES ($id, '$inst');"))
        {
            desconectar($con);
            return 1;
        }
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}

function insertGarito($username, $password, $email, $publicname, $poblacion, $idgenero, $pic, $direccion, $aforomax, $website="", $telnum)
{
    if($pic == "") // Default image
        $pic = "user_image.png";
    $con = conectar($GLOBALS['db']);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($con, $email);
    $publicname = mysqli_real_escape_string($con, $publicname);
    $direccion = mysqli_real_escape_string($con, $direccion);
    $poblacion = mysqli_real_escape_string($con, $poblacion);
    $website = mysqli_real_escape_string($con, $website);
    if(!alreadyExists($username, "usuario", "username")) // si no existe
    {
        $insert = "INSERT INTO usuario(`username`,`pass`,`email`,`publicname`,`id_poblacion`,`img`,`direccion`,`aforo`,`web`,`tel`,`valoracion`) VALUES ('$username', '$password', '$email', '$publicname', $poblacion, '$pic', '$direccion', '$aforomax', '$website', '$telnum', 0);";
        if(mysqli_query($con, $insert))
        {
            if(mysqli_query($con, "INSERT INTO genero_user VALUES ('$username', $idgenero);"))
            {
                desconectar($con);
                return 1;
            }
        }
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
    else
    {
        errorUserExists();
        desconectar($con);
        return 0;
    }
}

/************ GESTIÓN DE CONCIERTOS ****************/
function crearConcierto($fecha, $precio, $userlocal) // $fecha = DATE, $precio = INT, $userlocal = STRING
{
    $con = conectar($GLOBALS['db']);
    $id = generateID("concierto");
    $insert = "INSERT INTO concierto VALUES($id, '$fecha', $precio, '$userlocal');";
    if(mysqli_query($con, $insert))
    {
        desconectar($con);
        return 1;
    }
    desconectar($con);
    return 0;
}

function altaConcierto($idconcierto, $userbanda) // $idconcierto = INT, $userbanda = STRING
{
    $insert = "INSERT INTO participa VALUES($idconcierto, '$userbanda', 0);";
    $con = conectar($GLOBALS['db']);
    if(mysqli_query($con, $insert))
    {
       desconectar($con);
       return 1;
    }
    errorConsulta($con);
    desconectar($con);
    return 0;
}

/************ VOTACIONES ***************/
function votarBanda($userfan, $userbanda) // $userfan, $userbanda = STRING, success = return 1, fail = return 0
{           //si hi ha vot borrara el vot si no afegira vot(me gusta/ya no me gusta)
    $select = "SELECT * FROM votos_bandas WHERE id_fan='$userfan' AND id_banda='$userbanda';";
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, $select)) // comprova que la consulta esta ben escrita
    {
        if(mysqli_num_rows($res))//si es 0 salta, si hi ha algo entra(hi ha vot) treu el vot
        {
            $insert = "DELETE FROM votos_bandas WHERE id_fan='$userfan' AND id_banda='$userbanda';";
            if(mysqli_query($con, $insert))
            {
                mysqli_query($con, "UPDATE usuario SET valoracion = valoracion - 1 WHERE username = '$userbanda';");
                desconectar($con);
                return 1;
            }
            else
            {
                errorConsulta($con);
                desconectar($con);
                return 0;
            }
        }
        else  //vota
        {
            $insert = "INSERT INTO votos_bandas VALUES('$userfan','$userbanda');";
            if(mysqli_query($con, $insert))
            {
                mysqli_query($con, "UPDATE usuario SET valoracion = valoracion + 1 WHERE username = '$userbanda';");
                desconectar($con);
                return 1;
            }
            else
            {
                errorConsulta($con);
                desconectar($con);
                return 0;
            }
        }
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
}

function votarLocal($userfan, $userlocal) // $userfan, $userlocal = STRING, success = return 1, fail = return 0
{
    $select = "SELECT * FROM votos_locales WHERE id_fan='$userfan' AND id_local='$userlocal';";
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, $select)) // comprova que la consulta esta ben escrita
    {
        if(mysqli_num_rows($res))//si es 0 salta, si hi ha algo entra(hi ha vot) treu el vot
        {
            $insert = "DELETE FROM votos_locales WHERE id_fan='$userfan' AND id_local='$userlocal';";
            if(mysqli_query($con, $insert))
            {
                mysqli_query($con, "UPDATE usuario SET valoracion = valoracion - 1 WHERE username = '$userlocal';");
                desconectar($con);
                return 1;
            }
            else
            {
                errorConsulta($con);
                desconectar($con);
                return 0;
            }
        }
        else  //vota
        {
            $insert = "INSERT INTO votos_locales VALUES('$userfan','$userlocal');";
            if(mysqli_query($con, $insert))
            {
                mysqli_query($con, "UPDATE usuario SET valoracion = valoracion + 1 WHERE username = '$userlocal';");
                desconectar($con);
                return 1;
            }
            else
            {
                errorConsulta($con);
                desconectar($con);
                return 0;
            }
        }
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
}

function votarConcierto($userfan, $idconcierto) // $userfan = STRING, $idconcierto = INT, success = return 1, fail = return 0
{
    $select = "SELECT * FROM votos_conciertos WHERE id_fan='$userfan' AND id_concierto=$idconcierto;";
    $con = conectar($GLOBALS['db']);
    if($res = mysqli_query($con, $select)) // comprova que la consulta esta ben escrita
    {
        if(mysqli_num_rows($res))//si es 0 salta, si hi ha algo entra(hi ha vot) treu el vot
        {
            $insert = "DELETE FROM votos_conciertos WHERE id_fan='$userfan' AND id_concierto=$idconcierto;";
            if(mysqli_query($con, $insert))
            {
                desconectar($con);
                return 1;
            }
            else
            {
                errorConsulta($con);
                desconectar($con);
                return 0;
            }
        }
        else  //vota
        {
            $insert = "INSERT INTO votos_conciertos VALUES($idconcierto,'$userfan');";
            if(mysqli_query($con, $insert))
            {
                desconectar($con);
                return 1;
            }
            else
            {
                errorConsulta($con);
                desconectar($con);
                return 0;
            }
        }
    }
    else
    {
        errorConsulta($con);
        desconectar($con);
        return 0;
    }
}