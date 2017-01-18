<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<?php 

	$data = array(); // données du restaurateur
	
	if ( empty($_POST) ) { // première page 
		
		include('ville.php');
		
	}else if ( isset($_POST['ville']) ){

		$data['ville'] = $_POST['ville'];
		include('classification.php');

	}else if ( isset($_POST['classification']) ){

		$data['classification'] = $_POST['classification'];
		var_dump($data);

	}

?>

<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

