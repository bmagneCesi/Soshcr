<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<div class="form col-xs-12 col-sm-4 col-sm-offset-4 text-center">
    <h3 class="title-heading">Où est situé votre établissement ?</h3>
	<form class="navbar-form" method="post">
		<div class="input-group add-on" style="width:100%">
		  <input class="form-control" placeholder="ville" style="height:35px" name="ville" id="country_id" onkeyup="autocomplet()">
		  <div class="input-group-btn"  style="width:40px">
		    <button class="btn btn-default" type="submit" style="height:35px"><i class="glyphicon glyphicon-search"></i></button>
		  </div>
		</div>
		<div class="input_container">
			<ul id="country_list_id"></ul>
		</div>
	</form>
</div>

<?php


	if (isset($_POST['ville']) && $_POST['ville'] != "") {

		$_SESSION['ville'] = $_POST['ville'];

		if (isset($_SESSION['ville']) && $_SESSION['ville'] != "")
			header('Location: etablissement.php');

	}

?>

<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

