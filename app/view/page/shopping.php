<div class="row">
	<div class="col l1 offset-l1">
		<div class="col l12">
			<h2>Filtres</h2>
			<li><a href="index.php?p=shopping&i=1&categorie=0">Tous</a></button></li>
		</div>
			<?php
				foreach($categorie as $c){
		?>
			<div class="col l12">
				<li><a href="index.php?p=shopping&i=1&categorie=<?php echo $c->getID(); ?>" > <?php echo $c->getNom(); ?></a></li>
			</div>
		<?php
				}
			?>
	</div>
<?php
	if(isset($alert)){
		echo "<br/>".$alert;
	}
?>
	<div class="col l7">
<?php
	foreach ($product as $p){
		if($p->getEtat() != 0)
		{
			echo "<div class='col l4'>";
			if(Product::isNewProduct($bdd, $p->getDateDeCreation(), $p->getID()) == 1 ){
				echo '<div class="newShopping"><p>nouveau</p></div>';
			}
			echo "<div class='image'><img class='imageProduct' src='./app/view/assets/image/default.png' alt='Image produit'></div>";
			echo "<a href='index.php?p=produit&id=".$p->getID()."'>".$p->getLibelle()."</a></br>";
			echo "<p>Prix : ".$p->getPrix()."€</p>";
			echo "</div>";
		}
	}
?>
	</div>
</div>
<div class="page">
<?php
	if(isset($i)){
		if ($i > 1)
		{
			?>
				<a href="index.php?p=shopping&i=<?php echo $i - 1; ?>&categorie=<?php 
				if(isset($_GET['categorie'])){
					echo $_GET['categorie'];
				}?>">Page précédente</a>
			<?php
		}
		
		for ($j = 1; $j <= ceil($nbPages); $j++)
		{
			?>
				<a href="index.php?p=shopping&i=<?php echo $j; ?>&categorie=<?php 
				if(isset($_GET['categorie'])){
					echo $_GET['categorie'];
				}?>"><?php echo $j ?></a>
			<?php
		}

		if ($i < ceil($nbPages))
		{
			?>
				<a href="index.php?p=shopping&i=<?php echo $i + 1; ?>&categorie=<?php 
				if(isset($_GET['categorie'])){
					echo $_GET['categorie'];
				}?>">Page suivante</a>
			<?php
		}

	}
?>
</div>