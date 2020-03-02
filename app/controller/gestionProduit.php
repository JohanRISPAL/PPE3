<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Produit.php");
	include ("./app/model/Commande.php");
	include ("./app/model/Adresse.php");

	
	$commande = Commande::getAllCommande($bdd);
	
	$tendance = Product::getProductInTendance($bdd, 2);

	if(isset($_POST["tendance"])){
		Product::suppresionTendance($bdd, $_POST["tendance"]);

		echo "<p>Le produit n'est plus en tendance<p>";
	}

	$desactive = Product::getDesactivedProduct($bdd, 0);

	if(isset($_POST["activ"])){
		Product::setActiveProduct($bdd, $_POST["activ"]);

		echo "<p>Le produit n'est plus désactivé</p>";
	}

	include("./app/view/page/gestionProduit.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>