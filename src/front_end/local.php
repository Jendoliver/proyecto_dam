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
    <script src="js/updateconcert.js"></script>
    <!-- GMAP -->
    <script src="js/libs/gmap3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgDVAtY7m3iZGAQ1ciAP1CXx7krD5i9Dw"></script>
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
                <div class="col-md-6">
                    <div id="personalinfo" class="well">
                        <h3>Información personal</h3>
                        <form action="<?php echo $updater ?>" method="POST">
                            <?php session_start(); extract($_SESSION); ?>
                            <?php require "modalmodify.php"; ?>
                            <input type="hidden" id="usertype" value="3">
                            <input type="hidden" name="username" value="<?php echo $username ?>">
                            <div id="publicname"></div>
                            <div id="password"></div>
                            <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <span id="email"><?php echo $email?></span></div>
                            <div><span class="glyphicon glyphicon-home"></span> Dirección: <span id="direccion"><?php echo $direccion."</span>, <span id='poblacion'>".$poblacion?></span></div>
                            <!-- <div><span class="glyphicon glyphicon-music"></span> Género principal: <span id="genero"></span></div> POR IMPLEMENTAR -->
                            <div><span class="glyphicon glyphicon-globe"></span> Página web: <span id="web"><?php echo $web?></span></div>
                            <div><span class="glyphicon glyphicon-phone-alt"></span> Teléfono de contacto: <span id="telefon"><?php echo $tel?></span></div>
                            <div><span class="glyphicon glyphicon-piggy-bank"></span> Valoración: <?php echo $valoracion?></div>
                            <div id="buttons"><button id="modify" class="btn btn-primary btn-block">Modificar perfil</button></div>
                        </form>
                    </div>
                </div>
                <!-- GMAP -->
                <div id="mapcontainer" class="col-md-6">
                    <div id="map"></div>
                </div>
            </div>
            <div id="concerts" class="row">
                <div class="col-md-12">
                    <div class="well">
                        <h3>Crear un nuevo concierto</h3> <!-- FORMULARIO NUEVO CONCIERTO -->
                        <div class="container-fluid">
                            <form action="<?php echo $insertor; ?>" method="POST">
                                <div class="form-group">
                                    <label for="date">Fecha del concierto:</label>
                                    <input type="date" class="form-control" name="concertdate" min="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Remuneración del concierto por grupo:</label>
                                    <input type="num" class="form-control" name="cash" placeholder="€" min="0" required>
                                </div>
                                <button type="submit" name="crear_concierto" class="btn btn-success btn-block">¡Crear concierto!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h3>Grupos pendientes de aprobar</h3>
                        <div class="container-fluid">
                            <?php selectGruposAprobar($username); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <?php require "modaldeleteconcert.php"; ?>
                        <h3>Conciertos creados</h3>
                        <div class="container-fluid">
                            <?php selectProximosConciertosLocal($username); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIN DEL MAIN CONTAINER -->
        <?php require "footer.php" ?>
    </div>
    <script>
        $(document).ready(init);
        function init() 
        {
            $('#map')
                .gmap3({
                    zoom: 4
                })
                .infowindow()
                .marker([
                    {address: "<?php echo $direccion.', '.$poblacion ?>", data: "<h3><?php echo $publicname ?></h3>", icon: "http://maps.google.com/mapfiles/marker_orange.png"},
                ])
                .on('click', function (marker) {  //Al clicar obrim una finestra sobre la marca i hi insertem el data de la marca
                    marker.setIcon('http://maps.google.com/mapfiles/marker_green.png');
                    var map = this.get(0); //this.get(0) retorna la primera propietat vinculada-> gmap3
                    var infowindow = this.get(1); //this.get(1) retorna la segona propietat vinculada -> infowindow
                    infowindow.setContent(marker.data);     //dins la finestra mostrem el atribut data de la marca
                    infowindow.open(map, marker);
                })
                .fit();
        }
    </script>
    <?php } ?>
</body>