<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Categorie.php");
	include ("./app/model/Produit.php");
	include ("./app/model/Commande.php");
	include ("./app/model/Adresse.php");
	include ("./app/model/Tag.php");
	include ("./app/model/Users.php");
	include ("./app/model/ProduitCommande.php");

	
	$commande = Commande::getAllCommande($bdd);

	if($_SESSION["id"] == 0){
		header("Location: index.php");
	}

	if(isset($_POST["ajout"])){
		if(isset($_POST["misEnAvant"])){
			Product::insertProduit($bdd, $_POST["nomProduct"], $_POST["description"], $_POST["prix"], $_POST["quantite"], $_POST["categorieProduct"], 1);
			Product::ajoutTendance($bdd, Product::getLastProductInsert($bdd)["id"]);
		}else{
			Product::insertProduit($bdd, $_POST["nomProduct"], $_POST["description"], $_POST["prix"], $_POST["quantite"], $_POST["categorieProduct"], 0);
		}
		
		echo "<p>Le produit est bien créé</p>";
	}

	if(isset($_POST["categorie"])){
		Categorie::createCategorie($bdd, $_POST["nom"]);
		
		echo "<p>La catégorie est bien créée</p>";
	}
	
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

	$mostSoldProduct = Product::getMostSoldProduct($bdd);

	$nbCommande = Commande::getNumberOfCommande($bdd);

	$priceCart = Product::getAVGPriceByCart($bdd);

	$categorie = Categorie::getCategorie($bdd);

	$products = Product::getProduct($bdd);
	$tags = Tag::getTag($bdd);

	if(isset($_POST["product"]) && isset($_POST["tag"])){
		Tag::insertTagForProduct($bdd, $_POST["product"], $_POST["tag"]);

		echo "Le tag est ajouté";
	}elseif(isset($_POST["product"]) && isset($_POST["newTag"])){
		Tag::insertTag($bdd, $_POST["newTag"]);
		$lastTag = Tag::getLastInsertTag($bdd);

		Tag::insertTagForProduct($bdd, $_POST["product"], $lastTag[0]->getID());

		echo "Le tag est créé et ajouté au produit";
	}

	$commande = Commande::getAllCommande($bdd);

	$users = Users::getUserWithoutAdminConnected($bdd, $_SESSION["id"]);

	include("./app/view/page/interfaceAdmin.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>