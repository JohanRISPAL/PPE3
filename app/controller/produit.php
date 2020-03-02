<?php 
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include("./app/model/Produit.php");
	include("./app/model/Tag.php");

	$productSelected = Product::getProductById($bdd, $_GET["id"]);

	if(isset($_POST["modification"])){
		Product::modifyProduct($bdd, $_GET["id"], $_POST["nom"], $_POST["description"], $_POST["prix"], $_POST["stock"]);

		echo "Le produit est modifié";
	}

	if(isset($_POST["supprTag"])){
		Tag::deleteTagToProduct($bdd, $_GET["id"], $_POST["idTag"]);

		echo "Le tag est supprimé du produit";
	}

	$tag = Tag::getTagOfProduct($bdd, $_GET["id"]);
	
}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur " . $e->getMessage();
}

	include("./app/view/page/produit.php");
?>