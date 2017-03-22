<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profiles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/smoothiexxx.js"></script>
    <title>La Leche Music</title>
</head>

<body>
    <?php
    require "../back_end/libs/selects_lib.php";
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
                    <div class="well">
                        <h3>Información personal</h3>
                        <?php session_start(); extract($_SESSION); ?>
                        <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <?php echo $email?></div>
                        <div><span class="glyphicon glyphicon-home"></span> Ciudad de residencia: <?php echo $poblacion?></div>
                        <div><span class="glyphicon glyphicon-globe"></span> Página web: <?php echo $web?></div>
                        <div><span class="glyphicon glyphicon-phone-alt"></span> Teléfono de contacto: <?php echo $tel?></div>
                        <div><span class="glyphicon glyphicon-piggy-bank"></span> Valoración: <?php echo $valoracion?></div>
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