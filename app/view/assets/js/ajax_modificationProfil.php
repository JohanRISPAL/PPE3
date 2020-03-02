<?php
	include("../../../model/ModificationProfil.php");

	if(isset($_REQUEST["modification"])){
		$id = $_REQUEST["id"];
		$name = $_REQUEST["name"];
		$firstName = $_REQUEST["firstname"];
		$login = $_REQUEST["login"];
		$pwd = $_REQUEST["mdp"];

		if($pwd == $_REQUEST["confMdp"]){
			updateUser($id, $name, $firstName, $login, $pwd);
		}
	}
?>