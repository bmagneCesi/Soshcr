<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
//print_r($_SESSION);
include("connexion.php");
$pdo = connect();
?>


<div class="container">
    <div class="col-md-5">
        <div class="form-area">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Votre demande a bien été envoyée ! </h3>
        </div>
    </div>
</div>
<?php

header('refresh:3;url=resultats_recherche.php');

?>

<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

