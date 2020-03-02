<?php
	include ("./app/model/produit.php");

	function getProductInCart($bdd, $idProduct){
		$in = "(";
		$count = 0;

		foreach ($idProduct as $id => $qty) {
			if ($id != "PHPSESSID"){
				$in .= $id;
			}

			if ($count < count($idProduct) - 1){
				$in .= ", ";
			}
			$count++;
		}

		$in .= ");";


		$query = "SELECT * FROM produit WHERE id IN" . $in;
		$queryPrepare = $bdd->prepare($query);
		$queryPrepare->execute();
		$queryResult = $queryPrepare->fetchAll();

		$queryData = [];

		foreach ($queryResult as $q) {
			$queryData[] = new Product($q["id"], $q["nom"], $q["prix"], $_COOKIE['panier'][$q["id"]], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]);
		}

		return $queryData;
	}

?>