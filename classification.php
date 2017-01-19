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
		<?php
		$classifications=$pdo->query("SELECT * FROM etablissement");
		$classifications->setFetchMode(PDO::FETCH_OBJ);
		while( $classification = $classifications->fetch() ) {
			?>
			<li>
				<form method="post">
					<button>
						<img src="img/1-stars.png" alt="">
						<p><?php echo $classification->libelle?></p>
					</button>
					<input type="hidden" value="<?php echo $classification->id_etablissement?>" name="classification">
				</form>
			</li>
			<?php
		}
		?>
	</ul>
</form>

<input type="button" value="Retour" onclick="document.location.href='ville.php';">




<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->


