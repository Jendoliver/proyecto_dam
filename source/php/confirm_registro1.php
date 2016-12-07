<?php
    // if(!(alreadyExists($_POST["register_username"],"users"))) { COMPROBACIÓN SI NOMBRE USUARIO EXISTE EN BASE "users", IMPLEMENTAR CON BASE DE DATOS
    
    if($_POST["register_password"] != $_POST["register_password_conf"]) 
    { // CHECK PASSWORDS COINCIDEN
        $message = "Las contraseñas no coinciden"; // ESTE BLOQUE JS IMPRIME UN POPUP CON UN BOTÓN DE ACEPTAR
        echo "<script type='text/javascript'>
        alert('$message');
        window.location = '../html/registro.html';
        </script>";
    }
    // TODO: AÑADIR COMPROBACIONES DE COMPLEJIDAD PARA LA CONTRASEÑA(p.ej: strlen($_POST["register_password") > X, 
    
    else if (!filter_var($_POST["register_email"], FILTER_VALIDATE_EMAIL)) 
    { // CHECK FORMATO EMAIL
        $message = "El email introducido no tiene un formato válido";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location = '../html/registro.html';
        </script>";
    }
    
    else // if(!(alreadyExists($_POST["register_email"],"users"))) { COMPROBACIÓN SI NOMBRE USUARIO EXISTE EN BASE "users", IMPLEMENTAR CON BASE DE DATOS
    { // SI TODO VA GUAY REDIRIGIMOS AL USUARIO A LA SEGUNDA PARTE DEL REGISTRO SEGÚN SU TIPO DE USUARIO
        session_start(); // TAMBIÉN GUARDAMOS LOS DATOS DE SU REGISTRO EN VARIABLES $_SESSION PARA MÁS ADELANTE USARLAS EN SU PERFIL
        $_SESSION["username"] = $_POST["register_username"];
        $_SESSION["password"] = $_POST["register_password"];
        $_SESSION["email"] = $_POST["register_email"];
        if(isset($_POST["register_image"]))
            $_SESSION["image"] = $_POST["register_image"];
        else
            $_SESSION["image"] = "http://img.desmotivaciones.es/201012/aaaaa_28.jpg"; // hay que cambiar esto poyankres (imagen por defecto del perfil)
        switch($_POST["register_usertype"])
        {
            case "fan": /*AQUÍ HAY QUE INSERTAR EN LA BASE DE DATOS*/ header('Location: ../html/registro_exito.html'); break;
            case "banda": header('Location: ../html/registro_banda.html'); break;
            case "garito": header('Location: ../html/registro_garito.html'); break;
            default: echo "<h1>ERROR: MURRI FIRDST</h1>";
        }
    }
?>