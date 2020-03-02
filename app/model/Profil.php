<?php
	function getUser($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM client WHERE id = ?");
		$query->execute(array($id));
		return $query->fetch();
	}
?>