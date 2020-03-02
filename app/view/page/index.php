<div class="carousel carousel-slider center">
    <div class="carousel-fixed-item center">
     	<a href="#">J'en profite !</a>
    </div>
    <div class="carousel-item">
    	<img src="./app/view/assets/image/sapin.jpg">
    	<h3 class="carousel-fixed-item">Promotion de Noël</h3>
    </div>
    <div class="carousel-item red">
      <h2>Ceci est le deuxième panel</h2>
      <p class="white-text">ce panel est encore en construction</p>
    </div>
</div>

<?php 
	if(isset($_SESSION["id"])){
?>
		<div class="title">
			<h4>produits à la une</h4>
		</div>
<?php
	}
?>
<div class="row">
	<div class="col l12 highlighted">
		<?php
			if(isset($produitTendance)){
				foreach ($produitTendance as $p){
					echo "<div class='col l4 s2'>";
					if(Product::isNewProduct($bdd, $p->getDateDeCreation(), $p->getID()) == 1 ){
						echo '<div class="new"><p>nouveau</p></div>';
					}
					echo "<div class='image'><img class='imageProduct' src='./app/view/assets/image/default.png' alt='Image produit'></div>";
					echo "<a href='index.php?p=produit&id=".$p->getID()."'>".$p->getLibelle()."</a></br>";
					echo "<p>Prix :".$p->getPrix()."€</p>";
					echo "</div>";
				}
			}
		?>
	</div>
</div>	
<?php 
	if(isset($_SESSION["id"])){
?>
		<div class="title">
			<h4>tous nos produits</h4>
		</div>
<?php
	}
?>
	<div class="row">
		<div class="col l12 all">
			<?php
				if(isset($allProduct)){
					for($i = 0; $i < $nbDisplayProduct; $i++){
						echo "<div class='col l3 s2'>";
						if(Product::isNewProduct($bdd, $allProduct[$i]->getDateDeCreation(), $allProduct[$i]->getID()) == 1 ){
							echo '<div class="newProduct"><p>nouveau</p></div>';
						}
						echo "<div class='image'><img class='imageProduct' src='./app/view/assets/image/default.png' alt='Image produit'></div>";
						echo "<a href='index.php?p=produit&id=".$allProduct[$i]->getID()."'>".$allProduct[$i]->getLibelle()."</a></br>";
						echo "<p>Prix :".$allProduct[$i]->getPrix()."€</p>";
						echo "</div>";
					}
				}
			?>
		</div>
	</div>
<div class="buttonAllProduct">
	<a href="index.php?p=shopping&i=1">voir tous nos produits</a>
</div>