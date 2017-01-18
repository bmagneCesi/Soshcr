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
        <link rel="stylesheet" href="vendors/css/bootstrap.css">
        <link rel="stylesheet" href="vendors/css/bootstrap-theme.css">
        <link href='vendors/fonts/glyphicons-halflings-regular.ttf'>

    </head>
    <body id="layout">
        <header>
            <div class="row1">

                <a href="<?php echo $BASE_URL ?>"> <img id="logo" src="img/logo.png" alt=""> </a>
                <a href="<?php echo $BASE_URL ?>">
                    <h1 id="main-title">Le recrutement</h1>
                    <h2 id="sub-title">en hôtellerie & restauration</h2>    
                </a>
                <a id="login" href="login.html">Espace candidat</a>    

            </div>
        </header>