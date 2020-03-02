<?php

	function getConnexion(){
		$bdd = new PDO('mysql:host=localhost;dbname=gsbonlinestore;charset=utf8', 'root', 'root');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $bdd;
	}

	function getUserConnexion($login, $pass)
	{
		$bdd = getConnexion();
		$result = array();
		$query = $bdd->prepare("SELECT * FROM client WHERE login = ? AND mdp = ?");
		$query->execute(array($login, $pass));

		$queryResult = $query->fetchAll();

		if (sizeof($queryResult) > 0)
		{
			$_SESSION['id'] = $queryResult[0]['id'];
            $_SESSION["nom"] = $queryResult[0]['prenom'];
            $_SESSION["admin"] = $queryResult[0]['isAdmin'];
		}

		echo (json_encode($_SESSION));
	}
?>