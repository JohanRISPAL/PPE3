<h2>Suppression des tendances</h2>

<?php
	foreach($tendance as $t){
		echo $t->getLibelle();
		echo "<br/>";
		echo "<form id='supprTendance' method='post' action='index.php?p=interfaceAdmin'>
			<input type='hidden' name='tendance' value='".$t->getID()."'>
			<input type='submit' name='suppTendance' value='Enlever tendance'>
		</form>";
		echo "<br>";
	}
?>

<h2>Produits désactivés</h2>
<?php
	foreach($desactive as $d){
		echo $d->getLibelle();
		echo "<br/>";
		echo "<form id='activeProduct' method='post' action='index.php?p=interfaceAdmin'>
			<input type='hidden' name='activ' value='".$d->getID()."'>
			<input type='submit' name='active' value='Activer le produit'>
		</form>";
		echo "<br>";
	}
?>
