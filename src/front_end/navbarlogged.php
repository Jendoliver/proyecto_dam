<?php session_start(); ?>
<!-- BARRA DE NAVEGACIÓN DEL USUARIO LOGUEADO -->
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
                <li><a href="<?php echo $_SESSION["home"]; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"]; ?></a>
                <li><div id="cerrarsesion"><a class="btn btn-xs btn-danger" href="logout.php">CERRAR SESIÓN</a></div>
            </ul>
        </div>
    </div>
</nav>