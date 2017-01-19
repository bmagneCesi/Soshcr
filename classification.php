<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

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
	$formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
	$resultats=$pdo->query("SELECT *, COUNT(*) as c, ".$formule." AS dist FROM utilisateur WHERE ".$formule." < $utilisateur->nombre_kilometre ORDER BY dist ASC");
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





if ( isset($_POST['classification']) ){

	$_SESSION['classification'] = $_POST['classification'];
	header('Location: secteur_activite.php');

}
?>

	<ul>
		<li>
			<form method="post">
				<button>
					<img src="img/1-stars.png" alt="">
					<p>brasserie hôtel non classé hôtel 1 étoile</p>
				</button>
				<input type="hidden" value="1" name="classification">
			</form>
		</li>
		<li>
			<form method="post">
				<button>
					<img src="img/3-stars.png" alt="">
					<p>restaurant traditionnel hôtel 2 et 3 étoiles</p>
				</button>
				<input type="hidden" value="2" name="classification">
			</form>
		</li>
		<li>
			<form method="post">
				<button>
					<img src="img/5-stars.png" alt="">
					<p>gastronomique hôtel 4 et 5 étoiles</p>
				</button>
				<input type="hidden" value="3" name="classification">
			</form>
		</li>
		<li>
			<form method="post">
				<button>
					<img src="" alt="">
					<p>collectivité</p>
				</button>
				<input type="hidden" value="0" name="classification">
			</form>
		</li>
	</ul>
</form>

<input type="button" value="Retour" onclick="document.location.href='ville.php';">




<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->


