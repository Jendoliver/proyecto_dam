<?php
    // if(!(alreadyExists($_POST["register_bandname"],"bands"))) { COMPROBACIÓN SI NOMBRE BANDA EXISTE EN BASE "bands", IMPLEMENTAR CON BASE DE DATOS
    $_SESSION["bandname"] = $_POST["register_bandname"];
    $_SESSION["style"] = $_POST["register_style"];
    $_SESSION["city"] = $_POST["register_city"];
    header('Location: ../html/registro_exito.html');
    /* else
    {
        $message = "El nombre de la banda ya existe";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location = '../html/registro_banda.html';
        </script>";
    } */
?>