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
    <!-- SMOOTH SCROLLING -->
    <script src="js/smoothiexxx.js"></script>
    <!-- MEMBERS ECHO SCRIPT -->
    <script src="js/members.js"></script>
    <!-- FORM VALIDATION -->
    <script src="js/libs/jquery.validate.min.js"></script>
    <script src="js/validation.js"></script>
    <title>Contacta con La Leche Music</title>
</head>
<body>
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
                <a class="navbar-brand" href="index.php">La Leche Music</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
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
                                <a style="font-size: 10px; letter-spacing: 2px; font-color: black" href="passrecover.php">¿Has olvidado tu contraseña?</a>
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
    <div class="container-fluid">
        <div class="container">
            <div id="msg" class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1 style="text-align: center">¡Contacta con nosotros!</h1>
                    <div class="well">
                        <form id="regfan" action="../back_end/libs/mail_lib.php" method="POST">
                            <div class="form-group">
                                <label for="asunto">¿Qué pasa, tronquíbiris?</label>
                                <select class="form-control" name="asunto">
                                    <option value="Sugerencia">¡Tengo una sugerencia!</option>
                                    <option value="Pregunta">¡Tengo una pregunta!</option>
                                    <option value="Queja">¡Tengo una queja!</option>
                                    <option value="Otros">Es sobre otro tema...</option>
                                </select>
                            </div>
                            <input type="hidden" name="asunto">
                            <input type="hidden" name="asunto">
                            <div class="form-group">
                                <label for="contenido">Escribe aquí tu mensaje:</label>
                                <textarea class="form-control" name="contenido"></textarea>
                            </div>
                            <button type="submit" name="sendauto" class="btn btn-success btn-block">Enviar mensaje</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <footer></footer>
    </div>
</body>
</html>