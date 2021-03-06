<!doctype html>
<html lang="en">
<?php require "../back_end/libs/selects_lib.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="<?php echo $favicon ?>" type="image/x-icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/smoothiexxx.js"></script>
    <title>La Leche Music</title>
</head>
<body id="myPage">
    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <img class="navbar-brand" id="logo" src="<?php echo $logo ?>"></img>
                <a class="navbar-brand" href="#myPage">La Leche Music</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#bandas">BANDAS</a></li>
                    <li><a href="#garitos">GARITOS</a></li>
                    <li><a href="#conciertos">CONCIERTOS</a></li>
                    <li><a href="#estilos">CONTACTO</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!auth()) { ?> <!-- CAMBIO DE NAV SEGÚN LOGIN -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">ACCEDER
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <div class="modal-body">
                                <form id="login-form" action="../back_end/selector.php" method="POST">
        				    		<div id="div-login-msg">
                                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                        <span id="text-login-msg">Datos de acceso:</span>
                                    </div>
        				    		<input id="login_username" class="form-control" type="text" placeholder="Usuario" name="username" required>
        				    		<input id="login_password" class="form-control" type="password" placeholder="Contraseña" name="password" required>
                		    	    <button type="submit" name="login" class="btn btn-success btn-sm btn-block">Login</button>
                                </form>
                                <a style="font-size: 12px; letter-spacing: 2px; color: black !important;" href="passrecover.php">¿Has olvidado tu contraseña?</a>
                		    </div>
    				        <div class="modal-footer">
                                <a href="registro.php" type="submit" class="btn btn-primary btn-sm btn-block">Registrarse</a>
    				        </div>
                        </ul>
                    </li>
                    <?php } else { ?>
                    <li><a href="<?php echo $_SESSION["home"]; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a>
                    <li><div id="cerrarsesion"><a class="btn btn-xs btn-danger" href="logout.php">CERRAR SESIÓN</a></div>
                    <?php } ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">IDIOMAS
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><img src=img/spanish.png> Español</img></a>
                            <li><a href="#"><img src=img/catalan.png> Catalán</img></a>
                            <li><a href="#"><img src=img/english.png> Inglés</img></a>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- CAROUSEL DE IMAGENES -->
    <div id="carousel-head" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="img/header.png" alt="Welcome" width="1200" height="700">
            </div>
        </div>
    </div>
    
    <!-- INICIO DEL MAIN CONTAINER -->
    <div class="container-fluid">
        <!-- BARRA DE BÚSQUEDA -->
        <div class="row"><br></div>
        <div id="search" class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="../front_end/queryresult.php" method="POST"><!-- TODO: LINKEAR CON LA BÚSQUEDA -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="busqueda">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- SECCIÓN BANDAS -->
        <div id="bandas" class="container">
            <div class="row"> <!-- TÍTULO SECCIÓN -->
                <div class="col-md-12"><h1>NUESTRAS BANDAS</h1></div>
            </div>
            <div class="row">
                <div class="col-md-6"> <!-- IMAGEN SECCIÓN -->
                    <img src="img/bandas.jpg" class="img-responsive"></img>
                </div>
                <div class="col-md-6">
                    <div class="row" style="text-align: justify;">¡Descubre una selección de bandas exquisitas en nuestra plataforma! Tanto si eres un fan y buscas nuevo material que seguir como si eres un garito y buscas buenos músicos para llenar tu sala, aquí encontrarás lo mejor de lo mejor. ¡Esto es la leche!</div>
                    <hr>
                    <div class="row">
                        <h2>LAS MEJORES BANDAS DEL MES</h2>
                        <?php if($_SESSION["usertype"] == 1) selectMejoresBandas(1); else selectMejoresBandas(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- SECCIÓN GARITOS -->
        <div id="garitos" class="container">
            <div class="row"> <!-- TÍTULO SECCIÓN -->
                <div class="col-md-12"><h1>NUESTROS GARITOS</h1></div>
            </div>
            <div class="row">
                <div class="col-md-6"> <!-- IMAGEN SECCIÓN -->
                    <img src="img/garitos.jpg" class="img-responsive"></img>
                </div>
                <div class="col-md-6">
                    <div class="row" style="text-align: justify;">¿Acabas de formar una banda y no sabes dónde tocar? ¿Te gustaría saber qué conciertos ofrecerá un garito de tu zona? ¡En La Leche Music encontrarás una variedad de garitos y géneros colosal! ¡No te quedes sin planes este finde, tronco!</div>
                    <hr>
                    <div class="row">
                        <h2>LOS MEJORES GARITOS DEL MES</h2>
                        <?php if($_SESSION["usertype"] == 1) selectMejoresGaritos(1); else selectMejoresGaritos(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- SECCIÓN CONCIERTOS -->
        <div id="conciertos" class="container">
            <div class="row"> <!-- TÍTULO SECCIÓN -->
                <div class="col-md-12"><h1>NUESTROS CONCIERTOS</h1></div>
            </div>
            <div class="row">
                <div class="col-md-6"> <!-- IMAGEN SECCIÓN -->
                    <img src="img/concierto.jpg" class="img-responsive"></img>
                </div>
                <div class="col-md-6">
                    <div class="row" style="text-align: justify;">En La Leche Music nos tomamos muy en serio la calidad de nuestros músicos y garitos, y por ello contamos con un potente sistema de votaciones gestionado por los propios fans. ¿Quieres saber qué se pía de tu último bolo? ¡Descúbrelo!</div>
                    <hr>
                    <div class="row">
                        <h2>LOS MEJORES CONCIERTOS DEL MES</h2>
                        <?php if($_SESSION["usertype"] == 1) selectMejoresConciertos(1); else selectMejoresConciertos(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- SECCIÓN CONTACTO -->
        <div id="estilos" class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-responsive" src="img/logo_big_inverted.png"></img>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <h1 style="text-align: center;">¿Qué te pongo, tron?</h1>
                    </div>
                    <div class="row">
                        <p style="text-align: center;">¿Tienes alguna pregunta, duda o queja sobre el funcionamiento de la plataforma?
                        <p style="text-align: center;">¡Háznoslo saber mediante nuestro formulario de contacto!
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <a style="text-align: center;" href="contactform.php" class="btn btn-primary btn-block">¡CONTACTA!</a>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img class="img-responsive" src="img/logo_big.png"></img>
                </div>
            </div>
        </div>
    </div>
</body>
</html>