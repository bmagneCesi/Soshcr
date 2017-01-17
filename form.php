<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->

<?php 

	$data = array();
	
	if ( empty($_POST) ) {
		
		include('ville.php');
		
	}else if ( isset($_POST['ville']) ){

		$data['ville'] = $_POST['ville'];
		include('etablissement.php');

	}else if ( isset($_POST['rank']) ){

		$data['rank'] = $_POST['rank'];
		var_dump($data);

	}

?>

<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->

