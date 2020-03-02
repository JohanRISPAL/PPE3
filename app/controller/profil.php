<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Profil.php");
	include ("./app/model/Produit.php");
	include ("./app/model/Adresse.php");
	include ("./app/model/Commande.php");
	include ("./app/model/ProduitCommande.php");


	$nom = getUser($bdd, $_SESSION["id"])["nom"];
	$prenom = getUser($bdd, $_SESSION["id"])["prenom"];

	$commande = Commande::getUserCommande($bdd, $_SESSION["id"]);

	if(isset($_GET["modif"]) && $_GET["modif"] == "true"){
		echo "Votre profil a bien était modifié";
	}
	
	include("./app/view/page/profil.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>