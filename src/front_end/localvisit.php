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
    {  
    $type = checkUserType($_GET["u"]);
    switch($type) // Patch to avoid accessing to a page without the user being of that type (really ugly)
    {
        case 1: header("Location: $fanpagevisit?u=".$_GET["u"]); break;
        case 2: header("Location: $bandpagevisit?u=".$_GET["u"]); break;
        case 3: getSession($_GET["u"], $type, 0); break;
        default: header("Location: ".$_SESSION["home"]);
    }
    
    ?>
    <?php require "navbarlogged.php"; ?>
    <?php require "headervisit.php"; ?>
        <div class="container"> <!-- INICIO DEL MAIN CONTAINER -->
            <!-- BARRA DE BÚSQUEDA -->
            <div class="row"><br></div>
            <div id="publicity" class="row"><div class="col-md-12"><div class="well" style="text-align: center;">PUBLICIDAD</div></div></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h3>Información personal</h3>
                        <?php session_start(); extract($_SESSION); ?>
                        <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: <?php echo $emailvisit?></div>
                        <div><span class="glyphicon glyphicon-home"></span> Dirección: <?php echo $direccionvisit.", ".$poblacionvisit?></div>
                        <div><span class="glyphicon glyphicon-globe"></span> Página web: <?php echo $webvisit?></div>
                        <div><span class="glyphicon glyphicon-phone-alt"></span> Teléfono de contacto: <?php echo $telvisit?></div>
                        <div><span class="glyphicon glyphicon-piggy-bank"></span> Valoración: <?php echo $valoracionvisit?></div>
                    </div>
                </div>
                <!-- GMAP -->
                <div id="mapcontainer" class="col-md-6">
                    <div id="map"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h3>Grupos pendientes de aprobar</h3>
                        <div class="container-fluid">
                            <?php selectGruposAprobar($usernamevisit); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h3>Conciertos creados</h3>
                        <div class="container-fluid">
                            <?php selectProximosConciertosLocal($usernamevisit); ?>
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
                    {address: "<?php echo $direccionvisit.', '.$poblacionvisit ?>", data: "<h3><?php echo $publicnamevisit ?></h3>", icon: "http://maps.google.com/mapfiles/marker_orange.png"},
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