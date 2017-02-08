<?php
/*
*
*   selects_lib.php: LIBRERÍA DE CONSULTAS SELECT DE LA APLICACIÓN
*
*/
require_once "bbdd_lib.php";

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
    
}

function selectConciertosAceptado() // conciertos para los que han aceptado a la banda
{
    
}

//SELECTS LOCAL
function selectGruposAprobar() // grupos que se han apuntado a un concierto propuesto
{
    
}

function selectProximosConciertosLocal() // seleccionar proximos conciertos propuestos por el local
{
    
}

//UTILIDADES
function createTableCursos($res) // HAY QUE ADAPTAR ESTA FUNCIÓN A NUESTRO PROYECTO CHAVALADA
{
    if($row = mysqli_fetch_assoc($res)) //comprobamos que hay algo para evitar warning
    {
        $table = "<table class='table table-hover'>"; // ese bootstrap joder
        $table .= "<thead>";
        foreach($row as $key => $value) // header tabla
        {
            $table .= "<th>$key</th>";
        }
        $table .= "<th>Modificar curs</th><th>Visualitzar alumnes</th></thead><tbody>"; // columna de botón modificar, cierre del header y apertura del body
    
        do // llenar tabla con el contenido de la query
        {
            $i = 0;
            $table .= "<tr>"; // principio de fila
            foreach($row as $key => $value) // llenamos una fila
            {
                if($i == 0) // pillamos la primary para lanzar el modify sobre eso
                {    
                    $idcurso = $value;
                    $table .= "<td>$value</td>";
                }
                else if($i == 1)
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>Monitor</td>"; break;
                        case 1: $table .= "<td>Director</td>"; break;
                        case 2: $table .= "<td>Premonitor</td>"; break;
                        case 3: $table .= "<td>Altres</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else if($i == 2)
                {
                    switch($value)
                    {
                        case 0: $table .= "<td>Matí</td>"; break;
                        case 1: $table .= "<td>Tarda</td>"; break;
                        case 2: $table .= "<td>Cap de setmana</td>"; break;
                        case 3: $table .= "<td>Intensiu</td>"; break;
                        default: errorCreateTable();
                    }
                }
                else
                    $table .= "<td>$value</td>";
                $i++;
            }
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='idcurso' value='$idcurso'><input type='submit' class='btn btn-info btn-sm' name='curso' value='MODIFICAR'></form></td>"; // botón de modificar
            $table .= "<td><form action='../front_end/modificardatos.php' method='POST'><input type='hidden' name='idcurso' value='$idcurso'><input type='submit' class='btn btn-info btn-sm' name='alumnos' value='MOSTRAR'></form></td>";
            $table .= "</tr>";
        } while ($row = mysqli_fetch_assoc($res));
        $table .= "</tbody></table>";
        echo $table;
    }
    else
        errorNoResults();
}

?>