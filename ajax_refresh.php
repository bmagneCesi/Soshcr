<?php
// PDO connect *********
include("connexion.php");
$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM ville WHERE ville_nom_reel LIKE (:keyword) ORDER BY id_ville ASC LIMIT 0, 6";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['ville_nom_reel']);
	// add new option
    echo '<li onclick="set_item(\''.$rs['ville_nom_reel'].'\')">'.$country_name.'</li>';
}
?>