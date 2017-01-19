<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<?php print_r($_SESSION); ?>


<?php
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
    $formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
    $resultats=$pdo->query("SELECT *, COUNT(*) as c, ".$formule." AS dist FROM utilisateur, poste_recherche_has_experience WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur AND ".$formule." < $utilisateur->nombre_kilometre AND etablissement_id_etablissement=$classification  ORDER BY dist ASC");
    $resultats->setFetchMode(PDO::FETCH_OBJ);
    while( $resultat = $resultats->fetch() )
    {


        if ($resultat->nom == $utilisateur->nom){
            //echo 'UtilisateurBon : '.$resultat->nom.'<br>';
            echo "Le nombre de personne est de : ".$resultat->c;
        }

    }
}
$utilisateurs->closeCursor();





if ( isset($_POST['secteur_activite']) ){

   // $_SESSION['secteur_activite'] = $_POST['secteur_activite'];
   // header('Location: secteur_activite.php');

}
?>



<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

