<div class="row" id="product">
	<div class="col l12">
		<div id="listProduct">
			<div class="col l4 offset-l2">
				<p><span><img class="imageProduct" src="./app/view/assets/image/default.png" alt="Image produit"></span></p>
			</div>
			<div class="col l4">
					<p><?php echo $productSelected->getLibelle();?></p>
					<p><span>Description : <?php echo $productSelected->getDescription();?></span></p>
					<p><span>Prix : <?php echo $productSelected->getPrix();?>€</span></p>
					<div class="col l12">
						<form name="ajoutPanier" method="post" action="index.php?p=shopping&i=1">
								<input type="hidden" name="id" value="<?php echo $productSelected->getID(); ?>">
								<?php 
									if($productSelected->getQuantite() >= 1){
										?>
										<div class="col l3">
											<input type="number" name="quantite" min="1" max="<?php echo $productSelected->getQuantite();?>" step="1" value="1">
										</div>
										<div class="col l4">
											<input type="submit" value="Ajouter au panier">
										</div>
									<?php
									}else{
										echo "Nous ne disposons plus de ce produit, vous ne pouvez pas le commander";
									}
									?>
								
						</form>
					</div>
	<p>Tag(s):</p>
<?php 
	if(!empty($tag)){
		foreach($tag as $t){
			$ta = Tag::getTagById($bdd, $t["id"]);
			echo $ta[0]->getLibelle();
			if($_SESSION["admin"] == 1){
				echo "<form name='supprimerTag' method='post'>
						<input type='hidden' name='supprTag' value='true'>
						<input type='hidden' name='idTag' value='".$ta[0]->getID()."'>
						<input type='submit' name='suppr' value='Supprimer le tag'>
					</form>";
			}
			echo "<br/>";
		}
	}else{
		echo "Ce produit n'a pas encore de tag";
	}


	if($_SESSION["admin"] == 1 && $productSelected->getEtat() == 1){
		echo "	<form name='ajoutTendance' method='post' action='index.php?p=shopping&i=1&categorie=0'>
			<input type='hidden' name='addTendance' value='".$productSelected->getID()."'>
			<input type='submit' name='ajoutTendance' value='Ajouter tendance'>
		</form>";
		echo "	<form name='desactiveProduct' method='post' action='index.php?p=shopping&i=1&categorie=0'>
			<input type='hidden' name='desactiv' value='".$productSelected->getID()."'>
			<input type='submit' name='desactive' value='Désactiver le produit'>
		</form>";			
	}elseif($_SESSION["admin"] == 1 && $productSelected->getEtat() == 2){
		echo "	<form name='desactiveProduct' method='post' action='index.php?p=shopping&i=1&categorie=0'>
			<input type='hidden' name='desactiv' value='".$productSelected->getID()."'>
			<input type='submit' name='desactive' value='Désactiver le produit'>
		</form>";			
	}

	if($_SESSION["admin"] == 1){
		echo "<a href='index.php?p=modificationProduit&id=".$productSelected->getID()."'><button>Modifier le produit</button></a>";
	}
?>
					</div>
				</div>
		</div>
</div>
</br> </br> </br>
	<div class="buttonProduct">
		<button class="buttonUnder active" id="descriptionButton">Description</button>
		<button class="buttonUnder nonactive" id="reviewButton">Review</button>
	</div>

<div class="row">
	<div class="col l6 offset-l4">
		<div class="description">
			<p>Description : <?php echo $productSelected->getDescription();?></p>
		</div>
		<div class="review">
			<p>oui</p>
		</div>
	</div>
</div>

<div class="title">
	<h4>Produit(s) lié(s)</h4>
</div>
<div class="row">
	<div class="col l12 linked">
		<?php
			if(!empty($tag)){
				foreach($tag as $t){
					$p = Product::getProductLinkedByTag($bdd, $t["id"], $_GET["id"]);
					foreach($p as $product){
						$products = Product::getProductById($bdd, $product["id"]);
			?>
						<div class="col l3 s2">
								<img class="imageProduct" src="./app/view/assets/image/default.png" alt="Image produit"><br/>
								<a href="index.php?p=produit&id=<?php echo $products->getID(); ?>"><?php echo $products->getLibelle(); ?></a><br/>
								<p>Prix : <?php echo $products->getPrix();?>€</p>
							</div>
			<?php		
					}
					
				}
			}else{
				echo "Ce produit n'a pas de produits liés.";
			}

		?>
	</div>
</div>