<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<?php
include("connexion.php");
$_SESSION['step'] = 2;
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
	$formule="(6366*ACOS(COS(RADIANS($lat))*COS(RADIANS(latitude))*COS(RADIANS(longitude)-RADIANS($long))+SIN(RADIANS($lat))*SIN(RADIANS(latitude))))";
	$resultats=$pdo->query("SELECT *, COUNT(*) as c, ".$formule." AS dist FROM utilisateur WHERE ".$formule." < $utilisateur->nombre_kilometre ORDER BY dist ASC");
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





if ( isset($_POST['classification']) ){

	$_SESSION['classification'] = $_POST['classification'];
	header('Location: secteur_activite.php');

}
?>
<div id="classification" class="col-xs-12 sos-form">
	<h3 class="title-heading">Quelle est votre classification ?</h3>
	<ul class="col-lg-8 col-lg-offset-2">
		<?php
		$classifications=$pdo->query("SELECT * FROM etablissement");
		$classifications->setFetchMode(PDO::FETCH_OBJ);
		while( $classification = $classifications->fetch() ) {
			?>
			<li class="col-sm-6 col-md-3 text-center">
				<form method="post">
					<button>
						<img src="img/rating/<?php echo $classification->id_etablissement?>-stars.png" alt="" class="img-responsive form-img">
						<p><?php echo $classification->libelle?></p>
					</button>
					<input type="hidden" value="<?php echo $classification->id_etablissement?>" name="classification">
				</form>
			</li>
			<?php
		}
		?>
	</ul>
	<div class="clearfix spacer"></div>
	<a href="ville.php" class="col-sm-offset-2"><i class="fa fa-caret-left" aria-hidden="true"></i> Précédent</a>
</div>


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->


