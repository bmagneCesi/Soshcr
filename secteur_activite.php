<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
$_SESSION['step'] = 3;
unset($_SESSION["secteur_activite"]);
unset($_SESSION["poste_hotellerie"]);
unset($_SESSION["poste_restauration"]);
print_r($_SESSION);
include("connexion.php");
$pdo = connect();

$utilisateurs=$pdo->query("SELECT * FROM utilisateur");
$utilisateurs->setFetchMode(PDO::FETCH_OBJ);
$nbPers= 0;
while( $utilisateur = $utilisateurs->fetch() )
{
    //echo 'NomUser : '.$utilisateur->nom.'<br>';
    //echo 'Longitude : '.$utilisateur->longitude.'<br>';
    //echo 'Latitude : '.$utilisateur->latitude.'<br>';
    $long  =  $_SESSION['longitudeVille'];
    $lat  =  $_SESSION['latitudeVille'];
    $classification = $_SESSION['classification'];
    $formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
    $resultats=$pdo->query("
    SELECT *, COUNT(*) as c, ".$formule." AS dist 
    FROM utilisateur, poste_recherche_has_experience 
    WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
    AND ".$formule." < $utilisateur->nombre_kilometre
    AND etablissement_id_etablissement=$classification  
    ORDER BY dist ASC");
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    while( $resultat = $resultats->fetch() )
    {


        if ($resultat->nom == $utilisateur->nom){
            //echo 'UtilisateurBon : '.$resultat->nom.'<br>';
            $nbPers = $resultat->c;
        }


    }
}
echo "Le nombre de personne est de : ".$nbPers;
$utilisateurs->closeCursor();








if ( isset($_POST['secteur_activite']) ){
    $_SESSION['secteur_activite'] = $_POST['secteur_activite'];
    unset($_SESSION['poste_hotellerie']);
    unset($_SESSION['service_restauration']);

    if ($_SESSION['secteur_activite']==1){

        header('Location: poste_hotellerie.php');
    }
    elseif ($_SESSION['secteur_activite']==2){
        header('Location: service_restauration.php');
    }

    //session_destroy();
    //print_r($_SESSION);

}
?>
<div id="secteur" class="col-xs-12 sos-form">
<h3 class="title-heading">Dans quel secteur d’activité recrutez vous ?</h3>
<ul class="col-lg-8 col-lg-offset-2">
    <?php
    $secteurs=$pdo->query("SELECT * FROM secteur");
    $secteurs->setFetchMode(PDO::FETCH_OBJ);
    while( $secteur = $secteurs->fetch() ) {
        ?>
        <li class="col-sm-6 col-md-6 text-center">
            <form method="post">
                <button>
                    <img src="img/secteur/<?php echo $secteur->id_secteur?>-secteur.png" alt="" class="img-responsive form-img">
                    <p><?php echo $secteur->libelle?></p>
                </button>
                <input type="hidden" value="<?php echo $secteur->id_secteur?>" name="secteur_activite">
            </form>
        </li>
        <?php
    }
    ?>
</ul>

    <div class="clearfix spacer"></div>
    <a href="classification.php" class="col-sm-offset-2"><i class="fa fa-caret-left" aria-hidden="true"></i> Précédent</a>
</div>




<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

