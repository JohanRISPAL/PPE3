<?php
	echo "<p>Nom : ".$nom;
	echo "<p>Prenom : ".$prenom;
?>
	<br/>
	<a href="index.php?p=modificationProfil&id=<?php echo $_SESSION['id'];?>"><button>Modifier profil</button></a>
	<div class="row" id="profil">
<?php

	if ($commande != null){
		foreach($commande as $c){
		$prixTotal = 0;
		$i = 0;
		$adresse = Adresse::getAdresseCommande($bdd, $c->getAdresseID(), $_SESSION["id"]);
		$productInCommande = ProduitCommande::getIdProductInCommande($bdd, $c->getID());
		echo "<div class='col l4 s12'>";
			echo "<div class='card blue-grey darken-1'>";
				echo "<div class='card-content white-text'>";
					echo "<span class='card-title activator'>Commande n°".$c->getID()."</span>";
					echo '<p>Date de la commande : ' .$c->getDateCommande() . '</p>';
					echo '<p>Etat de la commande : ' . Commande::getEtatCommande($bdd, $c->getEtatCommandeID())[0] . '</p>';
					echo '<p>Adresse de livraison : ' . $adresse[0]->getAdresse(). " " . $adresse[0]->getCp() . " ". $adresse[0]->getVille()  .'</p>';
				echo "</div>";
				echo "<div class='card-reveal'>";
					echo "<span class='card-title grey-text text-darken-4'>Commande n°".$c->getID()."<i class='material-icons right'>close</i></span>";
							foreach($productInCommande as $p){
								$produit = Product::getProductById($bdd, $p["produitID"]);
								echo "Produit : " . $produit->getLibelle() . "<br/>";
								echo "Quantite : " . $productInCommande[$i]["quantite"] . "<br/>";
								echo "Prix : " . $produit->getPrix()*$productInCommande[$i]["quantite"] . "€<br/>";
								$prixTotal += $produit->getPrix()*$productInCommande[$i]["quantite"];
								echo "<hr/>";
								$i++;
							}
							echo "Prix total : " . $prixTotal."€";
				echo "</div>";
			echo "</div>";
		echo "</div>";
		}
	}else{
		echo "<p>Vous n'avez pas passé de commande chez nous.</p>";
	}

?>
	</div>