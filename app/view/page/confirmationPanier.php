<h2>Création d'adresse</h2>
<form id="creationCommande" method="post" action="index.php?p=confirmationPanier">
	<input type="hidden" name="creationCommande" value=true>
	<p>
      <label>
        <input type="checkbox" name="categorie" value="maison">
        <span>Maison</span>
      </label>
    </p>	<p>
      <label>
        <input type="checkbox" name="categorie" value="boulot">
        <span>Boulot</span>
      </label>
    </p>
	<input type="text" name="adresse" placeholder="Adresse : ">
	<input type="text" name="cp" placeholder="Code postal : ">
	<input type="text" name="ville" placeholder="Ville : ">



<h2>Adresse Existante</h2>

<?php
	echo "<h3> Maison </h3>";
	foreach($adresseExistante as $a){
		 $adresseComplete = $a->getAdresse(). " " . $a->getCp() . " " . $a->getVille();
		 
		if($a->getNom() == "maison"){
			echo '<p>
      				<label>
       						<input type="checkbox" name="adresse" value="'.$a->getID().'">
        					<span>'. $adresseComplete.'</span>
      				</label>
    			</p>';
		}
	}

	echo "<h3> Boulot </h3>";

	foreach($adresseExistante as $a){
		$adresseComplete = $a->getAdresse(). " " . $a->getCp() . " " . $a->getVille();
		if($a->getNom() == "boulot"){
			echo '<p>
      				<label>
       						<input type="checkbox" name="adresse" value="'.$a->getID().'">
        					<span>'. $adresseComplete.'</span>
      				</label>
    			</p>';
		}
	}
?>
	<br/>
	<input type="submit" name="envoieCommande" value="Valider la commande">
</form>