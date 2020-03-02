<h2>Modification du produit</h2>

<form id="modificationProduit" method="post" action="index.php?p=produit&id=<?php echo $_GET["id"];?>">
	<input type="hidden" name="modification" value="true">
	<h4>Nom</h4>
	<input type="text" name="nom" value="<?php echo $produit->getLibelle(); ?>">

	<h4>Description</h4>
	<textarea name="description" cols="100" rows="7" style="resize:none" ><?php echo $produit->getDescription(); ?></textarea> 

	<h4>Prix</h4>
	<input type="number" name="prix" step="0.01" value="<?php echo $produit->getPrix(); ?>">
	<br/><br/>

	<h4>Stock</h4>
	<input type="number" name="stock" step="1" value="<?php echo $produit->getQuantite(); ?>">
	<br/><br/>

	<input type="submit" name="modif" value="Modifier">
</form>