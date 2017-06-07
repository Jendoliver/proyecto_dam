<?php

/*
*
*   error_lib.php: LIBRERÍA DE ERRORES
*
*/
require "success_lib.php";

/****** ERRORES GRAVES ******/
function errorConsulta($con)
{
    echo "<h1>ERROR EN LA CONSULTA: ".mysqli_error($con)."</h1>";
}

function errorSelector()
{
    echo "<h1>ERROR EN EL FICHERO SELECTOR.PHP</h1>";
}

function errorInsertor()
{
    echo "<h1>ERROR EN EL FICHERO INSERTOR.PHP</h1>";
}

function errorRegistro()
{
    echo "<h1>ERROR EN LA FUNCIÓN DE REGISTRO</h1>";
}

function console_log( $data ) // Para depurar php
{
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

/****** ERRORES COMUNES ******/
function errorLogin()
{
    global $homepage;
    $message = "Login incorrecto";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$homepage';
    </script>";
}

function errorPassword()
{
    global $registro;
    $message = "Las contraseñas no coinciden";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$registro';
    </script>";
}

function errorNotLogged()
{
    global $homepage;
    $message = "No has iniciado sesión --- ACCESO DENEGADO";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$homepage';
    </script>";
}

function errorUserExists()
{
    global $registro;
    $message = "El nombre de usuario indicado ya está en uso";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$registro';
    </script>";
}

function fechaErronea()
{
    global $garitopage;
    $message = "El formato de la fecha es incorrecto. Utiliza el calendario";
    echo "<script type='text/javascript'>
    alert('$message');
    window.location = '$garitopage';
    </script>";
}

/*function errorNotLogged()
{
    ?>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">No has iniciado sesión</h4>
          </div>
          <div class="modal-body">
            <p>Acceso denegado.</p>
          </div>
          <div class="modal-footer">
            <a class="btn btn-block btn-primary" href="../../front_end/" data-dismiss="modal">IR A LA HOMEPAGE</a>
          </div>
        </div>
      </div>
    </div>
    <?php
}*/

function errorNoResults()
{
    echo "<h1>No hay resultados</h1>";
}

function debug($error)
{
    echo "<script type='text/javascript'>console.log('$error');</script>";
}
?>