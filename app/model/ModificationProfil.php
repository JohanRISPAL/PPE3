<?php
	function getConnexion(){
		$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $bdd;
	}

	function updateUser($id, $nom, $prenom, $login, $mdp){
		$bdd = getConnexion();
		
		$query = $bdd->prepare("UPDATE client SET nom = ? WHERE id = ?");
		$query->execute(array($nom, $id));

		$queryP = $bdd->prepare("UPDATE client SET prenom = ? WHERE id = ?");
		$queryP->execute(array($prenom, $id));

		$queryL = $bdd->prepare("UPDATE client SET login = ? WHERE id = ?");
		$queryL->execute(array($login, $id));

		$queryM = $bdd->prepare("UPDATE client SET mdp = ? WHERE id = ?");
		$queryM->execute(array($mdp, $id));
	}
?>