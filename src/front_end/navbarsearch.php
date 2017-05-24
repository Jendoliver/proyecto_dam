<!-- BARRA DE NAVEGACIÓN DE LA BÚSQUEDA -->
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
            <div class="col-sm-5 col-md-5">
                <form action="../front_end/queryresult.php" class="navbar-form" role="search" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar perfiles..." name="busqueda">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                </form>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php if($_SESSION["usertype"]) { ?>
                <li><a href="<?php echo $_SESSION["home"]; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a>
                <li><div id="cerrarsesion"><a class="btn btn-xs btn-danger" href="logout.php">CERRAR SESIÓN</a></div>
                <?php } else { ?>
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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">IDIOMAS
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><img src=img/spanish.png> Español</img></a>
                        <li><a href="#"><img src=img/catalan.png> Catalán</img></a>
                        <li><a href="#"><img src=img/english.png> Inglés</img></a>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>