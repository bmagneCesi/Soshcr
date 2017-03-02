<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<div class="form col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 text-center">
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
session_destroy();
session_start();
$_SESSION['step'] = 1;
// première page
if ( isset($_POST['ville']) && $_POST['ville'] !="" ) {

	$geocoder = 'http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';
	$query = sprintf($geocoder, urlencode($_POST['ville']));
	$result = json_decode(file_get_contents($query));
	if ($result == NULL || $result->status == "ZERO_RESULTS" || $result->status == "INVALID_REQUEST"  || $result->status == "REQUEST_DENIED" ){
		
	}
	else
	{
		$json = $result->results[0];
		$lat = $json->geometry->location->lat;
		$long = $json->geometry->location->lng;
		//echo $lat;
		//echo $long;

		$_SESSION['ville'] = $_POST['ville'];
		$_SESSION['longitudeVille'] = $long;
		$_SESSION['latitudeVille'] = $lat;

		header('Location: classification.php');
	}
	
}
else{
	
}

?>


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->
