<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Panier.php");

	if(isset($_COOKIE['panier'])){
		$listePanier = $_COOKIE['panier'];
		$listeProduit = getProductInCart($bdd, $listePanier);

		foreach($listeProduit as $l){
			$id = $l->getID();
			$quantite = Product::getStock($bdd, $id);
			$quantiteClient = $_COOKIE['panier'][$l->getID()];
			$stockUpdate = $quantite[0] - $quantiteClient;	
		}
	}

	if(isset($_POST["idSuppr"])){
		$id = $_POST["idSuppr"];

		setcookie('panier['.$id.']', NULL, time() -3600);

		echo "<p>Le produit a été supprimé</p>";

		header('Location: index.php?p=panier');
	}

	
	include("./app/view/page/panier.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>