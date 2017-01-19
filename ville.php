<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<div class="form col-xs-12 col-sm-4 col-sm-offset-4 text-center">
    <h3 class="title-heading">Où est situé votre établissement ?</h3>
	<form class="navbar-form" method="post">
		<div class="input-group add-on" style="width:100%">

		  <!--<input class="form-control" placeholder="ville" style="height:35px" name="ville" id="country_id" onkeyup="autocomplet()">-->
			<input class="form-control" placeholder="ville" style="height:35px" name="ville" id="country_id">
			<script>
				function initialize() {

					var input = document.getElementById('country_id');
					var autocomplete = new google.maps.places.Autocomplete(input);
				}

				google.maps.event.addDomListener(window, 'load', initialize);
			</script>

			<div class="input-group-btn"  style="width:40px">
		    <button class="btn btn-default" id="seach-btn" type="submit" style="height:35px">
				<i class="fa fa-search" aria-hidden="true"></i>
			</button>

		  </div>

		</div>

	</form>
</div>


<?php

// première page
if ( isset($_POST['ville']) ) {

	$geocoder = 'http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';
	$query = sprintf($geocoder, urlencode(utf8_encode($_POST['ville'])));
	$result = json_decode(file_get_contents($query));
	$json = $result->results[0];
	$lat = $json->geometry->location->lat;
	$long = $json->geometry->location->lng;
	echo $lat;
	echo $long;

	$_SESSION['ville'] = $_POST['ville'];
	$_SESSION['longitudeVille'] = $long;
	$_SESSION['latitudeVille'] = $lat;

	include("connexion.php");
	$pdo = connect();
	$utilisateurs=$pdo->query("SELECT * FROM utilisateur");
	$utilisateurs->setFetchMode(PDO::FETCH_OBJ);
	while( $utilisateur = $utilisateurs->fetch() )
	{
		//echo 'NomUser : '.$utilisateur->nom.'<br>';
		//echo 'Longitude : '.$utilisateur->longitude.'<br>';
		//echo 'Latitude : '.$utilisateur->latitude.'<br>';
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





	//header('Location: classification.php');
}

?>


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->
