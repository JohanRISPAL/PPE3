<?php 
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	include ("./app/model/Shopping.php");
	include ("./app/model/Produit.php");
	include ("./app/model/Categorie.php");

	$categorie = Categorie::getCategorie($bdd);

	$nbPages = 0;
	if(isset($_GET["categorie"])){
		$nbPages = Product::getNbProductByCategorie($bdd, $_GET["categorie"])/9;
	}else{
		$nbPages = Product::getNbProductByCategorie($bdd, 0)/9;
	}

	if(isset($_GET["i"])){
		$i = $_GET['i'];

		if($i > ceil($nbPages)){
			$i = ceil($nbPages);
		}else if($i < 1){
			$i = 1;
		}

		if(isset($_GET["categorie"])){
			$product = Product::getProductByPage($bdd, $_GET["categorie"], $_GET["i"]);
		}else{
			$product = Product::getProductByPage($bdd, 0, $_GET["i"]);
		}
	}

	if(isset($_GET["recherche"])){
		$product = Product::getProductByName($bdd, $_GET["recherche"]);
		$nbProduct = count($product);
		if($nbProduct == 1){
			$alert = "Il y a ".$nbProduct." résultat pour ".$_GET["recherche"];
		}elseif ($nbProduct > 1) {
			$alert = "Il y a ".$nbProduct." résultats pour ".$_GET["recherche"];
		}else {
			$alert = "Il n'y a pas de résultat pour ".$_GET["recherche"];
		}
	}

	if(isset($_POST["id"])){
		$id = $_POST["id"];
		$quantite = $_POST["quantite"];
		setcookie('panier['.$id.']', $quantite);

		echo "<p>Le produit a été ajouté avec succes</p>";
	}

	if(isset($_POST["addTendance"])){
		$nbPlaceTendance = Product::ajoutTendance($bdd, $_POST["addTendance"]);

		echo "Le produit est en tendance";
	}

	if(isset($_POST["desactiv"])){
		Product::setDesactiveProduct($bdd, $_POST["desactiv"]);

		echo "Le produit est désactivé";
	}

	include("./app/view/page/shopping.php");

}catch(PDOException $e){
	echo "Dommage va chercher dans ton code où tu as fais l'erreur" . $e->getMessage();
}

	
?>