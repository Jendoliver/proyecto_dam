<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/smoothiexxx.js"></script>
    <title>La Leche Music</title>
</head>
<body id="myPage">
    <?php require_once "../back_end/libs/selects_lib.php"; ?>
    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#myPage">La Leche Music</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#bandas">BANDAS</a></li>
                    <li><a href="#garitos">GARITOS</a></li>
                    <li><a href="#conciertos">CONCIERTOS</a></li>
                    <li><a href="#loultimo">LO ÚLTIMO</a></li>
                    <li><a href="#estilos">ESTILOS MUSICALES</a></li>
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
                		    </div>
    				        <div class="modal-footer">
                                <a href="registro.php" type="submit" class="btn btn-primary btn-sm btn-block">Registrarse</a> <!-- TODO: LINKEAR CON REGISTRO -->
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
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-head" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-head" data-slide-to="1"></li>
            <li data-target="#carousel-head" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="img/ny.jpg" alt="New York" width="1200" height="700">
                <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>The atmosphere in New York is lorem ipsum.</p>
                </div>      
            </div>

            <div class="item">
                <img src="img/chicago.jpg" alt="Chicago" width="1200" height="700">
                <div class="carousel-caption">
                    <h3>Chicago</h3>
                    <p>Thank you, Chicago - A night we won't forget.</p>
                </div>      
            </div>
    
            <div class="item">
                <img src="img/la.jpg" alt="Los Angeles" width="1200" height="700">
                <div class="carousel-caption">
                    <h3>LA</h3>
                    <p>Even though the traffic was a mess, we had the best time playing at Venice Beach!</p>
                </div>      
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#carousel-head" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-head" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    
    <!-- INICIO DEL MAIN CONTAINER -->
    <div class="container-fluid">
        <!-- BARRA DE BÚSQUEDA -->
        <div class="row"><br></div>
        <div id="search" class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="#" method="POST"> <!-- TODO: LINKEAR CON LA BÚSQUEDA -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="button">
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
                    <div class="row" style="text-align: justify;">Lorem fistrum llevame al sircoo me cago en tus muelas tiene musho peligro benemeritaar. Mamaar se calle ustée al ataquerl está la cosa muy malar a peich tiene musho peligro. A peich benemeritaar no te digo trigo por no llamarte Rodrigor no puedor de la pradera llevame al sircoo ese hombree no puedor ahorarr. Está la cosa muy malar hasta luego Lucas a peich ahorarr al ataquerl. Por la gloria de mi madre quietooor a gramenawer quietooor sexuarl la caidita no te digo trigo por no llamarte Rodrigor diodeno diodenoo se calle ustée hasta luego Lucas. A gramenawer apetecan por la gloria de mi madre llevame al sircoo benemeritaar fistro apetecan ahorarr benemeritaar a gramenawer ese pedazo de. Por la gloria de mi madre qué dise usteer por la gloria de mi madre diodeno quietooor está la cosa muy malar hasta luego Lucas tiene musho peligro está la cosa muy malar está la cosa muy malar te voy a borrar el cerito.</div>
                    <div class="row">
                        <h2>LAS MEJORES BANDAS DEL MES</h2>
                        <?php selectMejoresBandas(); ?>
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
                    <div class="row" style="text-align: justify;">Lorem fistrum llevame al sircoo me cago en tus muelas tiene musho peligro benemeritaar. Mamaar se calle ustée al ataquerl está la cosa muy malar a peich tiene musho peligro. A peich benemeritaar no te digo trigo por no llamarte Rodrigor no puedor de la pradera llevame al sircoo ese hombree no puedor ahorarr. Está la cosa muy malar hasta luego Lucas a peich ahorarr al ataquerl. Por la gloria de mi madre quietooor a gramenawer quietooor sexuarl la caidita no te digo trigo por no llamarte Rodrigor diodeno diodenoo se calle ustée hasta luego Lucas. A gramenawer apetecan por la gloria de mi madre llevame al sircoo benemeritaar fistro apetecan ahorarr benemeritaar a gramenawer ese pedazo de. Por la gloria de mi madre qué dise usteer por la gloria de mi madre diodeno quietooor está la cosa muy malar hasta luego Lucas tiene musho peligro está la cosa muy malar está la cosa muy malar te voy a borrar el cerito.</div>
                    <div class="row">
                        <h2>LOS MEJORES GARITOS DEL MES</h2>
                        <?php selectMejoresGaritos(); ?>
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
                    <div class="row" style="text-align: justify;">Lorem fistrum llevame al sircoo me cago en tus muelas tiene musho peligro benemeritaar. Mamaar se calle ustée al ataquerl está la cosa muy malar a peich tiene musho peligro. A peich benemeritaar no te digo trigo por no llamarte Rodrigor no puedor de la pradera llevame al sircoo ese hombree no puedor ahorarr. Está la cosa muy malar hasta luego Lucas a peich ahorarr al ataquerl. Por la gloria de mi madre quietooor a gramenawer quietooor sexuarl la caidita no te digo trigo por no llamarte Rodrigor diodeno diodenoo se calle ustée hasta luego Lucas. A gramenawer apetecan por la gloria de mi madre llevame al sircoo benemeritaar fistro apetecan ahorarr benemeritaar a gramenawer ese pedazo de. Por la gloria de mi madre qué dise usteer por la gloria de mi madre diodeno quietooor está la cosa muy malar hasta luego Lucas tiene musho peligro está la cosa muy malar está la cosa muy malar te voy a borrar el cerito.</div>
                    <div class="row">
                        <h2>LOS MEJORES CONCIERTOS DEL MES</h2>
                        <?php selectMejoresConciertos(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- SECCIÓN LO ÚLTIMO -->
        <div id="loultimo" class="container">
            <div class="row"> <!-- TÍTULO SECCIÓN -->
                <div class="col-md-12"><h1 style="text-align: center;">LO ÚLTIMO</h1></div>
            </div>
            <div class="row">
                <div id="carousel-loulitmo" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-loulitmo" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-loulitmo" data-slide-to="1"></li>
                        <li data-target="#carousel-loulitmo" data-slide-to="2"></li>
                    </ol>
            
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="img/ny.jpg" alt="New York" width="1000" height="300">
                            <div class="carousel-caption">
                                <h3>Noticia 1</h3>
                                <p>El concierto fue un exitazo.</p>
                            </div>      
                        </div>
            
                        <div class="item">
                            <img src="img/chicago.jpg" alt="Chicago" width="1000" height="300">
                            <div class="carousel-caption">
                                <h3>Noticia 2</h3>
                                <p>Espectacular poyankre</p>
                            </div>      
                        </div>
                
                        <div class="item">
                            <img src="img/la.jpg" alt="Los Angeles" width="1000" height="300">
                            <div class="carousel-caption">
                                <h3>Noticia 3</h3>
                                <p>La verdad es que este Los Angeles es bastante botorudorf</p>
                            </div>      
                        </div>
                    </div>
            
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#carousel-loulitmo" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-loulitmo" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- SECCIÓN ESTILOS MUSICALES -->
        <div id="estilos" class="container">
            <div class="row">
                <div class="col-md-3">
                    <!--<img></img>-->
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <h1 style="text-align: center;">ESTILOS MUSICALES</h1>
                    </div>
                    <div class="row">
                        <p style="text-align: center;">¿Buscas alguna banda, garito o concierto de un estilo musical en concreto?
                        <p style="text-align: center;">¡Utiliza nuestras herramientas de búsqueda por género!
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <a style="text-align: center;" href="#" class="btn btn-primary btn-block">¡DESCUBRIR!</a>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!--<img></img>-->
                </div>
            </div>
        </div>
    </div>
</body>
</html>