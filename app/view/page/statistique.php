<h2>Les produits les mieux vendus</h2>
<?php
	for($i = 0; $i < sizeof($mostSoldProduct); $i++){
		$prod = Product::getProductById($bdd, $mostSoldProduct[$i]["produitID"]);
		if($i == 0){
			echo "Le plus vendu : " . $prod->getLibelle() . "</br>";
			echo "Nombre de vente : " . $mostSoldProduct[$i]["nbproduit"] . "</br>"  . "</br>";
		}elseif($i == 1){
			echo "Le deuxième plus vendu : " . $prod->getLibelle() . "</br>";
			echo "Nombre de vente : " . $mostSoldProduct[$i]["nbproduit"]  . "</br>"  . "</br>";
		}elseif($i == 2){
			echo "Le troisieme	 plus vendu : " . $prod->getLibelle() . "</br>";
			echo "Nombre de vente : " . $mostSoldProduct[$i]["nbproduit"]  . "</br>";
		}
	}
?>

<h2>Nombre total de commande passé</h2>

<?php echo "<p>Il y a eu " . $nbCommande[0] . " commandes passées sur le site </p>"; ?>

<h2>Argent moyen des paniers</h2>

<?php
	$prixMoyen = 0;

	foreach($priceCart as $p){
		$prixMoyen = ($prixMoyen + $p["prixPanier"]);
	}
	$moyenne = $prixMoyen/count($priceCart);
	echo "Les paniers ont des objets qui coute en moyenne " . round($moyenne, 2) . "€";
?>