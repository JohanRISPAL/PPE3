<?php
	session_start();

	if(isset($_GET['p'])){
		include('./app/view/page/header.php');
		include('./app/controller/'.$_GET['p'].'.php');
		include('./app/view/page/footer.php');
	}else{
		include('./app/view/page/header.php');
		include('./app/controller/index.php');
		include('./app/view/page/footer.php');
	}

	if(isset($_POST["checkDeco"])){
		setcookie('panier[]', NULL, -1);
		session_destroy();
		header('Location: index.php');
	}

?>