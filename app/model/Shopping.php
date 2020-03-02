<?php

	function getNumberOfPage($bdd)
	{
		$query = $bdd->prepare("SELECT COUNT(*) as nb FROM produit;");
		$query->execute(array());
		$queryResult = $query->fetch();

		return (int)$queryResult["nb"]/3;
	}
?>