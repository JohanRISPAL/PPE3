<h2>Récapitulatif de toutes les commandes</h2>

<?php
	if ($commande != null){
		foreach($commande as $c){
		$adresse = Adresse::getAdresseCommande($bdd, $c->getAdresseID(), $_SESSION["id"]);

		echo '<p>Numero de commande : ' .$c->getID() . '</p>';
		echo '<p>Date de la commande : ' .$c->getDateCommande() . '</p>';
		echo '<p>Etat de la commande : ' . Commande::getEtatCommande($bdd, $c->getEtatCommandeID())[0] . '</p>';
		echo '<p>Adresse de livraison : ' . $adresse[0]->getAdresse(). " " . $adresse[0]->getCp() . " ". $adresse[0]->getVille()  .'</p>';
		echo "<hr/>";
		}
	}else{
		echo "Il n'y a pas de commande pour le moment";
	}
?>	