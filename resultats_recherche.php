<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
//print_r($_SESSION);
include("connexion.php");
$pdo = connect();


if(isset($_SESSION['formation_minimum'])) {
    $formation=$_SESSION['formation_minimum'];
}
$long  =  $_SESSION['longitudeVille'];
$lat  =  $_SESSION['latitudeVille'];
$classification = $_SESSION['classification'];
$secteur = $_SESSION['secteur_activite'];
$anglais=$_SESSION['anglais'];

if(isset($_SESSION['poste_hotellerie'])){
    $poste_recherche = $_SESSION['poste_hotellerie'];
}
else{
    $poste_recherche = $_SESSION['poste_restauration'];
}

$formation2="";
if(isset($_SESSION['formation_minimum'])) {
    if ($_SESSION['formation_minimum'] == 1) {
        $formation2 = "";
    } else {
        $formation2 = "AND poste_recherche_has_experience.formation_id_formation=" . $formation;
    }
}
$contrat = $_SESSION['contrat'];
if(isset($_SESSION['duree_contrat'])) {
    $type_contrat = $_SESSION['duree_contrat'];
    $contrat1="AND type_contrat.id_type_contrat=".$type_contrat;
    $contrat2="AND poste_recherche_has_experience.type_contrat_id_type_contrat=".$type_contrat;
}
else{
    $contrat1="";
    $contrat2="";
}
if(isset($_SESSION['duree_contrat'])) {
    $experience = $_SESSION['experience'];
    $experience2="AND experience.id_experience >= $experience";
}

else{
    $experience2="";
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
$utilisateurs=$pdo->query("SELECT * FROM utilisateur");
$utilisateurs->setFetchMode(PDO::FETCH_OBJ);
$nbPers= 0;
while( $utilisateur = $utilisateurs->fetch() )
{
//echo 'NomUser : '.$utilisateur->nom.'<br>';
//echo 'Longitude : '.$utilisateur->longitude.'<br>';
//echo 'Latitude : '.$utilisateur->latitude.'<br>';

    $formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
    if (isset($_SESSION['cursus_scolaire'])){
        $cursus_scolaire=$_SESSION['cursus_scolaire'];
        if($cursus_scolaire == "tout cursus"){
            $cursus_scolaire2="";
        }
        else{
            $cursus_scolaire2="AND poste_recherche_has_experience.cursus_scolaire_id_cursus_scolaire=".$cursus_scolaire;
        }
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
        AND utilisateur.anglais_id_anglais>=$anglais
        $duree_stage2
        $cursus_scolaire2
        ORDER BY dist ASC");
    }
    else{
        $resultats=$pdo->query("
        SELECT *, COUNT(*) as c, ".$formule." AS dist
        FROM utilisateur, poste_recherche_has_experience, poste_recherche, contrat, type_contrat, formation, experience
        WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
        AND poste_recherche_has_experience.poste_recherche_id_poste_recherche=poste_recherche.id_poste_recherche
        AND poste_recherche_has_experience.contrat_id_contrat=contrat.id_contrat
        AND contrat.id_contrat=type_contrat.contrat_id_contrat
        AND poste_recherche_has_experience.formation_id_formation=formation.id_formation
        AND poste_recherche_has_experience.experience_id_experience=experience.id_experience
        AND ".$formule." < $utilisateur->nombre_kilometre
        AND etablissement_id_etablissement=$classification
        AND secteur_id_secteur=$secteur
        AND id_poste_recherche=$poste_recherche
        AND poste_recherche_has_experience.contrat_id_contrat=$contrat
        AND utilisateur.anglais_id_anglais>=$anglais
        $contrat1
        $contrat2
        $formation2
        $experience2
        ORDER BY dist ASC");
    }

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
?>

<br><br><br>





<?php

// Requete SQL pour affichage des profils correspondant aux résultats
$formule2="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
if (isset($_SESSION['cursus_scolaire'])){
    $cursus_scolaire=$_SESSION['cursus_scolaire'];
    if($cursus_scolaire == "tout cursus"){
        $cursus_scolaire2="";
    }
    else{
        $cursus_scolaire2="AND poste_recherche_has_experience.cursus_scolaire_id_cursus_scolaire=".$cursus_scolaire;
    }
    $resultats2=$pdo->query("
        SELECT *, ".$formule2." AS dist
        FROM utilisateur, poste_recherche_has_experience, poste_recherche
        WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
        AND poste_recherche_has_experience.poste_recherche_id_poste_recherche=poste_recherche.id_poste_recherche
        AND ".$formule2." < nombre_kilometre
        AND etablissement_id_etablissement=$classification
        AND secteur_id_secteur=$secteur
        AND id_poste_recherche=$poste_recherche
        AND contrat_id_contrat=$contrat
        AND utilisateur.anglais_id_anglais>=$anglais
        $duree_stage2
        $cursus_scolaire2
        ORDER BY dist ASC");
}
else{
    $resultats2=$pdo->query("
        SELECT *, ".$formule2." AS dist
        FROM utilisateur, poste_recherche_has_experience, poste_recherche, contrat, type_contrat, formation, experience
        WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
        AND poste_recherche_has_experience.poste_recherche_id_poste_recherche=poste_recherche.id_poste_recherche
        AND poste_recherche_has_experience.contrat_id_contrat=contrat.id_contrat
        AND contrat.id_contrat=type_contrat.contrat_id_contrat
        AND poste_recherche_has_experience.formation_id_formation=formation.id_formation
        AND poste_recherche_has_experience.experience_id_experience=experience.id_experience
        AND ".$formule2." < nombre_kilometre
        AND etablissement_id_etablissement=$classification
        AND secteur_id_secteur=$secteur
        AND id_poste_recherche=$poste_recherche
        AND poste_recherche_has_experience.contrat_id_contrat=$contrat
        AND utilisateur.anglais_id_anglais>=$anglais
        $contrat1
        $contrat2
        $formation2
        $experience2
        ORDER BY dist ASC");
}

$resultats2->setFetchMode(PDO::FETCH_OBJ);

?>
<form method="post">
    tout sélectionner <input onclick="CocheTout(this, 'mail_demande_utilisateur[]');" type="checkbox"><br/><br>
    <div id="imprime_moi">
    <?php

while( $resultat2 = $resultats2->fetch() )
{

        ?>
        <input type="checkbox" value="<?php echo $resultat2->mail; ?>" name="mail_demande_utilisateur[]">
        <?php
        echo $resultat2->nom."<br>";
        echo $resultat2->prenom."<br>";
        $age =  (int) ((time() - strtotime($resultat2->date_anniversaire))/ 3600 / 24 / 365);
        echo $age." ans <br>";
        $recommandations=$pdo->query("SELECT COUNT(*) FROM recommandation WHERE utilisateur_id_utilisateur=".$resultat2->id_utilisateur)->fetchColumn();
        if ($recommandations==0){
            echo "pas encore recommandé <br>";
        }
        elseif ($recommandations==1){
            echo "recommandé par ".$recommandations." professionnel <br>";
        }
        else{

            echo "recommandé par ".$recommandations." professionnels <br>";
        }
        echo "Mail: ".$resultat2->mail."<br>";
        echo "Tél: ".$resultat2->telephone."<br>";


        echo "<br><br><br><br>";




}



?>
</div>
    <input type="submit" value="Demander CV"">
    </form>

    <input type="button" value="Commencer nouvelle recherche" onclick="document.location.href='ville.php';">
    <a href="#" onclick="javascript:imprime_bloc('titre', 'imprime_moi');">Imprimer</a>



    <input type="button" value="Retour" onclick="document.location.href='date.php';">

<?php
$tab_demande = [];
if ( isset($_POST['mail_demande_utilisateur']) ){
    foreach ($_POST['mail_demande_utilisateur'] as $demandeCV){
        $tab_demande[] =$demandeCV;
    }
    $_SESSION['mail_demande_utilisateur'] = $tab_demande;

    header('Location: demande_cv.php');
//session_destroy();
//print_r($_SESSION);

}
?>


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

