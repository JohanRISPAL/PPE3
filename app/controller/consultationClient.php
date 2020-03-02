<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Users.php");
	include ("./app/model/Commande.php");

	$user = Users::getUserWithoutAdminConnected($bdd, $_SESSION["id"]);
	$nbCommande = Commande::getCommandeByUser($bdd, $_GET["id"]);

	include("./app/view/page/consultationClient.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>