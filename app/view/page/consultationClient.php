<?php
	echo "Nom : " . $user[0]->getNom() . "</br>";
	echo "Prenom : " . $user[0]->getPrenom() . "</br>";
	echo "Date de naissance : " . $user[0]->getDateDeNaissance() . "</br>";
	if ($user[0]->getGenre() == 1){
		echo "Genre : Femme" . "</br>"; 
	}else{
		echo "Genre : Homme" . "</br>";
	}
	echo "Login : " . $user[0]->getLogin() . "</br>";
	echo "Mot de passe : " . $user[0]->getMdp() . "</br>";

	if($nbCommande[0] == 0){
		echo "Cette personne n'a pas passée de commande";
	}else{
		echo "Cette personne à commandée ". $nbCommande[0] ." fois";
	}
?>