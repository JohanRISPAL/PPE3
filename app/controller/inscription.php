<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Inscription.php");
	
	if(isset($_POST["inscription"])){
		insertUser($bdd, $_POST["nom"],  $_POST["prenom"], $_POST["dateNaissance"], $_POST["genre"], $_POST["login"], $_POST["pwd"]);
		echo "<p> Vous êtes désormais inscrit </p>";
	}
	
	include("./app/view/page/inscription.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>