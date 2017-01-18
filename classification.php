<!-- HEADER -->
<?php include('header.php') ?>
<!-- HEADER -->
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


<?php
include("connexion.php");
$pdo = connect();





if ( isset($_POST['classification']) ){

	$_SESSION['classification'] = $_POST['classification'];
	header('Location: secteur_activite.php');

}
?>


<!-- FOOTER -->
<?php include('footer.php') ?>
<!-- FOOTER -->


