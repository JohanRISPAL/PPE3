<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Produit.php");
	include ("./app/model/Commande.php");

	$mostSoldProduct = Product::getMostSoldProduct($bdd);

	$nbCommande = Commande::getNumberOfCommande($bdd);

	$priceCart = Product::getAVGPriceByCart($bdd);

	include("./app/view/page/statistique.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>