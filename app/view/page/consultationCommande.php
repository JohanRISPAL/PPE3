<h1>Historique de la commande <?php echo $commandeSelected[0];?></h1>

<?php 
	$prixTotal = 0;
	$i = 0;
	foreach($productInCommande as $p){
		$produit = Product::getProductById($bdd, $p["produitID"]);
		echo "Produit : " . $produit->getLibelle() . "<br/>";
		echo "Quantite : " . $productInCommande[$i]["quantite"] . "<br/>";
		echo "Prix : " . $produit->getPrix()*$productInCommande[$i]["quantite"] . "<br/>";
		$prixTotal += $produit->getPrix()*$productInCommande[$i]["quantite"];
		echo "<hr/>";
		$i++;
	}
	echo "Etat de la commande : " . $etatCommande[0] . "<br/>";
	echo "Prix total : " . $prixTotal;
?>