<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
$_SESSION['step'] = 7;
unset($_SESSION["cursus_scolaire"]);
unset($_SESSION["anglais"]);
print_r($_SESSION);
include("connexion.php");
$pdo = connect();

$utilisateurs=$pdo->query("SELECT * FROM utilisateur");
$utilisateurs->setFetchMode(PDO::FETCH_OBJ);
while( $utilisateur = $utilisateurs->fetch() )
{
//echo 'NomUser : '.$utilisateur->nom.'<br>';
//echo 'Longitude : '.$utilisateur->longitude.'<br>';
//echo 'Latitude : '.$utilisateur->latitude.'<br>';
    $long  =  $_SESSION['longitudeVille'];
    $lat  =  $_SESSION['latitudeVille'];
    $classification = $_SESSION['classification'];
    $secteur = $_SESSION['secteur_activite'];
    if(isset($_SESSION['poste_hotellerie'])){
        $poste_recherche = $_SESSION['poste_hotellerie'];
}
else{
    $poste_recherche = $_SESSION['poste_restauration'];
}
$duree_stage2="";
if (isset($_SESSION['duree_stage'])){
    if ($_SESSION['duree_stage']==0){
        $duree_stage = $_SESSION['duree_stage'];
        $duree_stage2="";
    }
    else{
        $duree_stage = $_SESSION['duree_stage'];
        $duree_stage2="AND type_contrat_id_type_contrat=".$duree_stage;
    }
}

$contrat = $_SESSION['contrat'];

$formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
$resultats=$pdo->query("
SELECT *, COUNT(*) as c, ".$formule." AS dist
FROM utilisateur, poste_recherche_has_experience, poste_recherche
WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
AND poste_recherche_has_experience.poste_recherche_id_poste_recherche=poste_recherche.id_poste_recherche
AND ".$formule." < $utilisateur->nombre_kilometre
AND etablissement_id_etablissement=$classification
AND secteur_id_secteur=$secteur
AND id_poste_recherche=$poste_recherche
AND contrat_id_contrat=$contrat
$duree_stage2
ORDER BY dist ASC");
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    while( $resultat = $resultats->fetch() )
    {


        if ($resultat->nom == $utilisateur->nom){
//echo 'UtilisateurBon : '.$resultat->nom.'<br>';
            echo "Le nombre de personne est de : ".$resultat->c;
        }
    }
}
?>


<ul>
    <li>
        <form method="post">
            <button>
                <img src="img/1-stars.png" alt="">
                <p>tout cursus</p>
            </button>
            <input type="hidden" value="tout cursus" name="cursus_scolaire">
        </form>
    </li>
    <?php
    $cursus_scolaires=$pdo->query("SELECT * FROM cursus_scolaire");
    $cursus_scolaires->setFetchMode(PDO::FETCH_OBJ);
    while( $cursus_scolaire = $cursus_scolaires->fetch() ) {
        ?>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p><?php echo $cursus_scolaire->libelle?></p>
                </button>
                <input type="hidden" value="<?php echo $cursus_scolaire->id_cursus_scolaire?>" name="cursus_scolaire">
            </form>
        </li>
        <?php
    }
    ?>
</ul>

<?php
if ( isset($_POST['cursus_scolaire']) ){

    $_SESSION['cursus_scolaire'] = $_POST['cursus_scolaire'];
    header('Location: anglais.php');
//session_destroy();
//print_r($_SESSION);

}
?>

<?php

if(isset($_SESSION['duree_stage'])) { ?>
    <input type="button" value="Retour" onclick="document.location.href='duree_stage.php';">
<?php }

else  { ?>
    <input type="button" value="Retour" onclick="document.location.href='contrat.php';">
    <?php
}
?>









<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

