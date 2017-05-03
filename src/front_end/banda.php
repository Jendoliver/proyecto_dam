<!doctype html>
<html lang="en">
<?php require "../back_end/libs/selects_lib.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profiles.css">
    <link rel="icon" href="<?php echo $favicon ?>" type="image/x-icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/smoothiexxx.js"></script>
    <script src="js/modify.js"></script>
    <title>La Leche Music</title>
</head>

<body>
    <?php
    if(!auth())
        errorNotLogged();
    else
    { ?>
    <?php require "navbarlogged.php"; ?>
    <?php require "headerperfiles.php"; ?>
        <div class="container"> <!-- INICIO DEL MAIN CONTAINER -->
            <!-- BARRA DE BÚSQUEDA -->
            <div class="row"><br></div>
            <div id="publicity" class="row"><div class="col-md-12"><div class="well" style="text-align: center;">PUBLICIDAD</div></div></div>
            <div class="row">
                <div class="col-md-12">
                    <div id="personalinfo" class="well">
                        <h3>Información personal</h3>
                        <form action="<?php echo $updater ?>" method="POST">
                            <?php session_start(); extract($_SESSION); ?>
                            <?php require "modalmodify.php"; ?>
                            <input type="hidden" id="usertype" value="2">
                            <input type="hidden" name="username" value="<?php echo $username ?>">
                            <div id="publicname"></div>
                            <div id="password"></div>
                            <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <span id="email"><?php echo $email?></span></div>
                            <div><span class="glyphicon glyphicon-home"></span> Ciudad de residencia: <span id="poblacion"><?php echo $poblacion?></span></div>
                            <!-- <div><span class="glyphicon glyphicon-music"></span> Género principal: <span id="genero"></span></div> POR IMPLEMENTAR -->
                            <div><span class="glyphicon glyphicon-globe"></span> Página web: <span id="web"><?php echo $web?></span></div>
                            <div><span class="glyphicon glyphicon-phone-alt"></span> Teléfono de contacto: <span id="telefon"><?php echo $tel?></span></div>
                            <div><span class="glyphicon glyphicon-piggy-bank"></span> Valoración: <?php echo $valoracion?></div>
                            <div id="buttons"><button id="modify" class="btn btn-primary btn-block">Modificar perfil</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Solicitudes de conciertos enviadas</h3>
                        <div class="container-fluid">
                            <?php selectConciertosApuntado($username) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Conciertos en los que has sido aceptado</h3>
                        <div class="container-fluid">
                            <?php selectConciertosAceptado($username) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIN DEL MAIN CONTAINER -->
        <?php require "footer.php" ?>
    </div>
    <?php } ?>
</body>