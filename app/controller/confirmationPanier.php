<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/ConfirmationPanier.php");
	include ("./app/model/Produit.php");
	include ("./app/model/Adresse.php");
	include ("./app/model/Commande.php");
	include ("./app/model/ProduitCommande.php");

	$adresseExistante = Adresse::getAllUserAdresse($bdd, $_SESSION["id"]);
	
	$listePanier = $_COOKIE['panier'];
	$listeProduit = getProductInCart($bdd, $listePanier);

	if(isset($_POST["creationCommande"])){
		if(isset($_POST["categorie"])){
			$adresse = Adresse::createAdresse($bdd, $_POST["categorie"], $_POST["adresse"], $_POST["cp"], $_POST["ville"], $_SESSION["id"]);

			Commande::insertCommande($bdd, $_SESSION["id"], $adresse);

			$lastIdCommande = Commande::getLastCommande($bdd);

			foreach($listeProduit as $l){
				$id = $l->getID();
				$quantite = $l->getStock($bdd, $id);
				$quantiteClient = $_COOKIE['panier'][$l->getID()];
				$stockUpdate = $quantite[0] - $quantiteClient;

				ProduitCommande::insertProduitCommande($bdd, $id, $lastIdCommande[0], $quantiteClient );
				Product::updateStock($bdd, $stockUpdate, $id);

				setcookie('panier['.$id.']', NULL, time() -3600);
			}

			header('Location: index.php?commande=1');
		}elseif(isset($_POST["adresse"])){
		$idAdresse = $_POST["adresse"];

		Commande::insertCommande($bdd, $_SESSION["id"], $idAdresse);

		$lastIdCommande = Commande::getLastCommande($bdd);
		
		foreach($listeProduit as $l){
			$id = $l->getID();
			$quantite = $l->getStock($bdd, $id);
			$quantiteClient = $_COOKIE['panier'][$l->getID()];
			$stockUpdate = $quantite[0] - $quantiteClient;

			ProduitCommande::insertProduitCommande($bdd, $id, $lastIdCommande[0], $quantiteClient );
			Product::updateStock($bdd, $stockUpdate, $id);

			setcookie('panier['.$id.']', NULL, time() -3600);
		}

		header('Location: index.php?commande=1');
	}
}
	
	include("./app/view/page/confirmationPanier.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>