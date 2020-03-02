<?php
	session_start();
	include("../../../model/Login.php");
	if(isset($_REQUEST["connexion"])){
		$login = $_REQUEST["user"];
		$pass = $_REQUEST["pass"];

		getUserConnexion($login, $pass);
	}
?>