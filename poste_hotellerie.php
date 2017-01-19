<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
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
$formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
$resultats=$pdo->query("
SELECT *, COUNT(*) as c, ".$formule." AS dist
FROM utilisateur, poste_recherche_has_experience, poste_recherche
WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
AND poste_recherche_has_experience.poste_recherche_id_poste_recherche=poste_recherche.id_poste_recherche
AND ".$formule." < $utilisateur->nombre_kilometre
AND etablissement_id_etablissement=$classification
AND secteur_id_secteur=$secteur
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
$utilisateurs->closeCursor();








if ( isset($_POST['poste_hotellerie']) ){

$_SESSION['poste_hotellerie'] = $_POST['poste_hotellerie'];
header('Location: contrat.php');
//session_destroy();
//print_r($_SESSION);

}
?>

<ul>
    <?php
    $postes=$pdo->query("SELECT * FROM poste_recherche WHERE secteur_id_secteur=".$_SESSION['secteur_activite']);
    $postes->setFetchMode(PDO::FETCH_OBJ);
    while( $poste = $postes->fetch() ) {
        ?>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p><?php echo $poste->libelle?></p>
                </button>
                <input type="hidden" value="<?php echo $poste->id_poste_recherche?>" name="poste_hotellerie">
            </form>
        </li>
        <?php
    }
    ?>
</ul>


<input type="button" value="Retour" onclick="document.location.href='secteur_activite.php';">





<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

