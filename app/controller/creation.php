<?php 
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include("./app/model/Produit.php");
	include("./app/model/Categorie.php");
	include("./app/model/Tag.php");

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

	include("./app/view/page/creation.php");
}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur " . $e->getMessage();
}
?>