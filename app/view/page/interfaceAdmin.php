<div class="row">
	<div class="col l12">
		<div class="buttonOption">
			<button class="button" id="creation" value="creation">Création de produit</button> 
			<button class="button" id="statistique" value="statistique">Statistique</button>
			<button class="button" id="manage" value="manage">Gestion de produits</button>
			<button class="button" id="commande" value="commande">Liste commandes</button>
			<button class="button" id="clients" value="clients">Liste clients</button>
		</div>
	</div>
</div>
<div class="container creationContainer">
	<?php
		include("./app/view/page/creation.php");
	?>
</div>
<div class="container statistiqueContainer">
	<?php
		include("./app/view/page/statistique.php");
	?>
</div>
<div class="container manageContainer">
	<?php
		include("./app/view/page/gestionProduit.php");
	?>
</div>
<div class="container commandeContainer">
	<?php
		include("./app/view/page/recapitulatifCommande.php");
	?>
</div>
<div class="container clientsContainer">
	<?php
		include("./app/view/page/listClient.php");
	?>
</div>