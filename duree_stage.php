<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
unset($_SESSION["duree_stage"]);
unset($_SESSION["cursus_scolaire"]);
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
                <p>toutes durées</p>
            </button>
            <input type="hidden" value="0" name="duree_stage">
        </form>
    </li>

    <?php
    $contrats=$pdo->query("SELECT * FROM type_contrat WHERE contrat_id_contrat =".$_SESSION['contrat']);
    $contrats->setFetchMode(PDO::FETCH_OBJ);
    while( $contrat = $contrats->fetch() ) {
        ?>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p><?php echo $contrat->libelle?></p>
                </button>
                <input type="hidden" value="<?php echo $contrat->id_type_contrat?>" name="duree_stage">
            </form>
        </li>
        <?php
    }
    ?>
</ul>



<?php
if ( isset($_POST['duree_stage']) ){

    $_SESSION['duree_stage'] = $_POST['duree_stage'];
    header('Location: cursus_scolaire.php');
//session_destroy();
//print_r($_SESSION);

}
?>







    <input type="button" value="Retour" onclick="document.location.href='contrat.php';">


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

