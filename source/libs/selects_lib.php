<?php
/*
*
*   selects_lib.php: LIBRERÍA DE CONSULTAS SELECT DE LA APLICACIÓN
*
*/

//SELECTS HOMEPAGE
function selectProximosConciertos()
{
    
}

function selectMejoresLocales()
{
    
}

function selectMejoresBandas()
{
    
}

function selectMejoresConciertos()
{
    
}

//SELECTS PERFILES (generales)
function selectImgPerfil()
{
    
}

function selectPublicname()
{
    
}

function selectVideo($src)
{
    
}

//SELECTS FAN
function selectConciertosValorados() // conciertos que el fan ha valorado
{
    
}

function selectProximosConciertosLike() // proximos conciertos de las bandas a las que le has dado like
{
    
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
function createTableCursos($con, $res) // HAY QUE ADAPTAR ESTA FUNCIÓN A NUESTRO PROYECTO CHAVALADA
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