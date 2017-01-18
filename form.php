<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<?php 

	if ( empty($_POST) ) { // première page 
		
		include('ville.php');
		
	}else if ( isset($_POST['ville']) ){

		$_SESSION['ville'] = $_POST['ville'];
		include('classification.php');
	
	}else if ( isset($_POST['classification']) ){

		$_SESSION['classification'] = $_POST['classification'];
		include('secteur_activite.php');
	
	}
?>

<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->
