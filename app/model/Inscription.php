<?php
	function userExist($bdd, $nom, $prenom){
		$query = $bdd->prepare("SELECT * FROM client WHERE nom = ? & prenom = ?");
		$query->execute(array($nom, $prenom));

		if(count($query->fetch()) == 1){
			return count($query->fetch());
		}
		return false;
	}

	function insertUser($bdd, $nom, $prenom, $date, $genre, $login, $mdp){
		$query = $bdd->prepare("INSERT INTO client (prenom, nom, dateDeNaissance, genre, login, mdp, isAdmin) VALUES(?, ?, ?, ?, ?, ?, ?)");
		$query->execute(array($prenom, $nom, $date, $genre, $login, $mdp, 0));
	}
?>