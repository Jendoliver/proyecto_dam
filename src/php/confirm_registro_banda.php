<?php
    // if(!(alreadyExists($_POST["register_bandname"],"bandas"))) { COMPROBACIÓN SI NOMBRE BANDA EXISTE EN BASE "bands", IMPLEMENTAR CON BASE DE DATOS
    session_start();
    $_SESSION["bandname"] = $_POST["register_bandname"];
    $_SESSION["style"] = $_POST["register_style"];
    $_SESSION["city"] = $_POST["register_city"];
    $_SESSION["website"] = $_POST["register_website"];
    $_SESSION["telnum"] = $_POST["telnum"];
    $_SESSION["memnum"] = $_POST["register_memnum"];
    header('Location: ../html/registro_banda_miembros.php');
    /* else  (SI EL NOMBRE DE LA BANDA YA EXISTE)
    {
        $message = "El nombre de la banda ya existe";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location = '../html/registro_banda.html';
        </script>";
    } */
?>