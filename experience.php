<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
<?php
unset($_SESSION["experience"]);
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
    if(isset($_SESSION['formation_minimum'])) {
        $formation=$_SESSION['formation_minimum'];
    }
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

    $formation2="";
    if(isset($_SESSION['formation_minimum'])) {
        if ($_SESSION['formation_minimum'] == 1) {
            $formation2 = "";
        } else {
            $formation2 = "AND utilisateur.formation_id_formation=" . $formation;
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

    $formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
    $resultats=$pdo->query("
SELECT *, COUNT(*) as c, ".$formule." AS dist
FROM utilisateur, poste_recherche_has_experience, poste_recherche, contrat, type_contrat, formation
WHERE utilisateur.id_utilisateur=poste_recherche_has_experience.utilisateur_id_utilisateur
AND poste_recherche_has_experience.poste_recherche_id_poste_recherche=poste_recherche.id_poste_recherche
AND poste_recherche_has_experience.contrat_id_contrat=contrat.id_contrat
AND contrat.id_contrat=type_contrat.contrat_id_contrat
AND utilisateur.formation_id_formation=formation.id_formation
AND ".$formule." < $utilisateur->nombre_kilometre
AND etablissement_id_etablissement=$classification
AND secteur_id_secteur=$secteur
AND id_poste_recherche=$poste_recherche
AND poste_recherche_has_experience.contrat_id_contrat=$contrat
$contrat1
$contrat2
$formation2
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
                    <p>0 mois</p>
                </button>
                <input type="hidden" value="1" name="experience">
            </form>
        </li>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p>6 mois</p>
                </button>
                <input type="hidden" value="2" name="experience">
            </form>
        </li>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p>1 an</p>
                </button>
                <input type="hidden" value="3" name="experience">
            </form>
        </li>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p>3 ans</p>
                </button>
                <input type="hidden" value="4" name="experience">
            </form>
        </li>
        <li>
            <form method="post">
                <button>
                    <img src="img/1-stars.png" alt="">
                    <p>6 ans</p>
                </button>
                <input type="hidden" value="5" name="experience">
            </form>
        </li>
</ul>

<?php
if ( isset($_POST['experience']) ){

$_SESSION['experience'] = $_POST['experience'];
header('Location: anglais.php');
//session_destroy();
//print_r($_SESSION);

}
?>



<?php

if(isset($_SESSION['duree_contrat']) && isset($_SESSION['formation_minimum'] )) { ?>
    <input type="button" value="Retour" onclick="document.location.href='formation_minimum.php';">
<?php }

else  { ?>
    <input type="button" value="Retour" onclick="document.location.href='contrat.php';">
    <?php
}
?>






<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

