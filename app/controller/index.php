<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Produit.php");
	include ("./app/model/Users.php");
	
	if(isset($_SESSION["id"])){
		$idTendance = 2;

		$produitTendance = Product::getProductInTendance($bdd, $idTendance);
		$allProduct = Product::getProduct($bdd);
		if (sizeof($allProduct) < 8 ){
			$nbDisplayProduct = sizeof($allProduct);
		}else{
			$nbDisplayProduct = 8;
		}
	}else{
		echo "<p>Bienvenue sur notre site de GSB, connecte toi pour profiter du site</p>";
	}

	if(isset($_POST["creationCommande"])){
		echo "La commande est envoyée";
	}

	if(isset($_GET["recherche"])){
		header("Location: index.php?p=shopping&recherche=".$_GET["recherche"]);
	}

	if(isset($_GET["commande"])){
		echo "<p>La commande est bien envoyée</p>";
	}
	
	include("./app/view/page/index.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

?>