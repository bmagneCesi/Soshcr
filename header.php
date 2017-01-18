<?php 
    $BASE_URL = "http://" . $_SERVER['SERVER_NAME'];
 ?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Restauration, recrutement</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="vendors/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="vendors/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="vendors/bootstrap/bootstrap-theme.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    </head>
    <body id="layout">
        
        <header>

            <div class="col-xs-2">
                <a href="/"> <img id="logo" class="img-responsive" src="img/logo.png" alt=""> </a>
            </div> 
            
            <!-- Title desktop -->
             <div class="col-xs-8 text-center hidden-xs ">
                <img class="title" src="img/title.png" class="img-responsive">  
            </div>
            <!-- Title desktop -->

             <div class="col-xs-2 col-xs-offset-8 col-sm-offset-0">
                <a id="login" href="login.html">
                    <span id="login-text" class="hidden-xs">Espace candidat</span>
                    <span id="login-icon" class="hidden-sm hidden-md hidden-lg img-responsive"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                </a>  
            </div>  

            <!-- Title phone -->
            <div class="clearfix"></div>
             <div class="col-xs-12 text-center hidden-sm hidden-md hidden-lg">
                <img class="title" src="img/title.png" class="img-responsive">  
            </div>
            <!-- Title phone -->

        </header>
