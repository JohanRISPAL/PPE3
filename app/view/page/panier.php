<?php
	if(!(empty($listeProduit))){
	$count = 1;
	$listePrix = array();
	$quantite = 1;
	$coutTotal = 0;
	foreach($listeProduit as $l){
		echo "Article n°" . $count . " : "; 
		echo $l->getLibelle() . "<br/>";
		echo "Quantité : " . $l->getQuantite() . "<br/>";
		if ($l->getQuantite() != 1){
			$quantite = $l->getQuantite();
		}
		echo "Prix : " . $quantite * $l->getPrix() . "<br/>";
		array_push($listePrix, $quantite * $l->getPrix());

	
?>
		<form name="supprimerPanier" method="post" action="index.php?p=panier">
			<input type="hidden" name="idSuppr" value="<?php echo $l->getID(); ?>">
			<input type="submit" value="Supprimer du panier">
		</form> 
<?php
		$count++;
		}

	foreach($listePrix as $prix){
		$coutTotal += $prix;
	}

	echo "Prix total : " . $coutTotal;
?>
	<form name="envoieCommande" method="post" action="index.php?p=confirmationPanier">
			<input type="hidden" name="validationCommande" value="true">
			<input type="submit" value="Valider la commande">
	</form>
<?php
	}else{
		echo "<p class='emptyCart'>Le panier est vide.</p>";
	}
?>