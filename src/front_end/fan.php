<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profiles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
    <title>La Leche Music</title>
</head>

<body>
    <?php /*
    require_once "../back_end/libs/bbdd_lib.php";
    if(!auth())
        errorNotLogged();
    else
    { */?>
    <!-- BARRA NAVEGACION PRINCIPAL -->
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
                <div class="col-sm-5 col-md-5">
                    <form action="#" class="navbar-form" role="search" method="POST"> <!-- TODO: LINKEAR CON LA BÚSQUEDA -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Busca perfiles..." name="q">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <div id="cerrarsesion"><a class="btn btn-xs btn-danger" href="#">CERRAR SESIÓN</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <header id="header">
    
                            <div class="slider">
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <img src="http://placehold.it/1200x400/F34336/F34336&text=EL MEJOR FAN">
                                        </div>
                                        <div class="item">
                                            <img src="http://placehold.it/1200x400/20BFA9/ffffff&text=SIEMPRE FIEL">
                                        </div>
                                        <div class="item">
                                            <img src="http://placehold.it/1200x400/FF0000/ffffff&text=SIEMPRE ROCOSO">
                                        </div>
                                    </div>
    
                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                        <span class="fa fa-angle-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                        <span class="fa fa-angle-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <!--slider-->
                            <nav class="navbar navbar-default">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a id="img-profile" class="navbar-brand" href="#"><img id="profilepic" class="img-responsive" src="img/user_image.png"></a>
                                    <span class="user-name">Alejandro Álvarez</span> <!-- PUBLICNAME -->
                                    <span class="site-description">@jendoliver</span> <!-- USERNAME -->
                                </div>
    
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="mainNav">
                                    <ul class="nav main-menu navbar-nav">
                                        <li><a href="#"><i class="fa fa-home"></i> HOME</a></li>
                                        <li><a href="#">Link</a></li>
                                        <li><a href="#">Link</a></li>
                                    </ul>
    
                                    <ul class="nav  navbar-nav navbar-right">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /.navbar-collapse -->
                            </nav>
    
                        </header>
                        <!--/#HEADER-->
                    </div>
                </div>
            </div>
        </div>
        <div class="container"> <!-- INICIO DEL MAIN CONTAINER -->
            <!-- BARRA DE BÚSQUEDA -->
            <div class="row"><br></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h3>Información personal</h3>
                        <?php //session_start(); extract $_SESSION; ?>
                        <div><span class="glyphicon glyphicon-envelope"></span> Correo electrónico: jandol1996@hotmail.com<?php //echo $email?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        asdasdasdasd
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php // } ?>
</body>