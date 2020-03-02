<?php 
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include("./app/model/Commande.php");
	include("./app/model/ProduitCommande.php");
	include("./app/model/Produit.php");

	$commandeSelected = Commande::getCommandeById($bdd, $_GET["commandeID"]);
	$productInCommande = ProduitCommande::getIdProductInCommande($bdd, $_GET["commandeID"]);
	$etatCommande = Commande::getEtatCommande($bdd, $commandeSelected["etatCommandeID"]);

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur " . $e->getMessage();
}

	include("./app/view/page/consultationCommande.php");
?>