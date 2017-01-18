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

	$_SESSION['ville'] = $_POST['ville'];
	header('Location: classification.php');
}

?>


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->
