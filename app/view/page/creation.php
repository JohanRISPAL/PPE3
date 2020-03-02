<h2>Ajout objet</h2>
<form id="ajoutObjet" method="post" action="index.php?p=interfaceAdmin">
	<input type="hidden" name="ajout" value="1">
	<h4>Nom</h4>
	<input type="text" name="nomProduct">

	<h4>Description</h4>
	<input type="textarea" name="description">

	<h4>Prix</h4>
	<input type="text" name="prix">

	<h4>Quantité</h4>
	<input type="number" name="quantite" min=1 value=1 step=1>

	<h4>Catégorie</h4>
<?php
	foreach($categorie as $c){
		echo '<label>
		        <input name="categorieProduct" type="radio" value="'.$c->getID().'" />
		        <span>'. $c->getNom().'</span>
		    </label>';
	}
?>
	<br/> <br/>
	<label>
   		<input type="checkbox" name="misEnAvant" value="1">
   		<span>Mise en avant</span>
    </label>
	<br/>
	<p>Attention si il y à déjà trois objets mis en avant, le plus anciens sera supprimé</p>

	<br/><br/>
	<input type="submit" name="ajoutFinal" value="Créer produit">
</form>

<h2>Création de categorie</h2>
<form id="ajoutCreation" method="post" action="index.php?p=interfaceAdmin">
	<input type="hidden" name="categorie" value="1">

	<h4>Nom de la catégorie</h4>
	<input type="text" name="nom">

	<input type="submit" name="ajoutFinal" value="Créer catégorie">
</form>

<h2>Ajout tag</h2>
<form id="tag" method="post">
	<div class="input-field col s12">
    <select name="product">
      <option value="" disabled selected>Produit :</option>
<?php
		foreach($products as $p){
?>
			<option value="<?php echo $p->getID();?>"><?php echo $p->getLibelle();?></option>
<?php
		}
?>
    </select>
  	</div>

	<div class="input-field col s12">
    <select name="tag">
      <option value="" disabled selected>Tag :</option>
<?php
		foreach($tags as $t){
?>
			<option value="<?php echo $t->getID();?>"><?php echo $t->getLibelle();?></option>
<?php
		}
?>
    </select>
  </div>



	<h4>Créer un tag</h4>
	<input type="text" name="newTag">

<input type="submit" value="Ajouter un tag" />

</form>