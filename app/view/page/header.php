<div class="topPage">
	<div class="row">
		<div class="col l12">
			<div class="col l2 s1 offset-l2">		
				<form name="searchField" method="GET" action="index.php?p=shopping&i=1">
					<input type="text" name="recherche" placeholder="Recherche...">
					<input type="submit" value="Valider">
				</form>
			</div>
			<div class="col l2 s3 offset-l1">
				<img class="logo" src="./app/view/assets/image/gsbonlinestore.png">
			</div>
			<div class="col l2 s3 offset-l2">
				<?php 
					if(isset($_SESSION["id"])){
						echo "<a href='index.php?p=profil'><i class='material-icons'>perm_identity</i></a>";
						echo "<a href='index.php?p=panier'><i class='material-icons'>shopping_basket</i></a>";
						echo "<a href='index.php?p=deconnexion'><i class='material-icons'>settings_power</i></a>";
					}else{
						echo "<a href='index.php?p=login'><i class='material-icons'>power_settings_new</i></a>";
						echo "<a href='index.php?p=inscription'><i class='material-icons'>person_add</i></a>";
					}
					if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
						echo "<a href='index.php?p=interfaceAdmin'><i class='material-icons'>supervisor_account</i></a>";
					}
				?>
			</div>
		</div>
	</div>
</div>

<div class="link">
			<div class="navbarre">
		<?php 
			if(!isset($_GET['p'])){
		?>
			<div class="active">
				<a href="index.php">Accueil</a>
			</div>
			<div class="nonactive">
				<a href="index.php?p=shopping&i=1">Boutique</a>
				<a href="index.php?p=contact">Contact</a>
			</div>
		<?php
			}elseif($_GET['p'] == "shopping"){
		?>
			<div class="nonactive">
					<a href="index.php">Accueil</a>
			</div>
			<div class="active">
				<a href="index.php?p=shopping&i=1&categorie=0">Boutique</a>
			</div>
			<div class="nonactive">
				<a href="index.php?p=contact">Contact</a>
			</div>
		<?php
			}elseif($_GET['p'] == "contact"){
		?>
			<div class="nonactive">
					<a href="index.php">Accueil</a>
					<a href="index.php?p=shopping&i=1&categorie=0">Boutique</a>
			</div>
			<div class="active">
				<a href="index.php?p=contact">Contact</a>
			</div>
		<?php
			}else{
		?>
				<a href="index.php">Accueil</a>
				<a href="index.php?p=shopping&i=1&categorie=0">Boutique</a>
				<a href="index.php?p=contact">Contact</a>
		<?php
			}
		?>
	</div>
</div>

<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>PPE deuxieme annee</title>
      <link rel="stylesheet" href="./app/view/assets/css/index.css">
      <link rel="stylesheet" href="./app/view/assets/css/home.css">
      <link rel="stylesheet" href="./app/view/assets/css/shopping.css">
      <link rel="stylesheet" href="./app/view/assets/css/produit.css">
      <link rel="stylesheet" href="./app/view/assets/css/interfaceAdmin.css">
      <link rel="stylesheet" href="./app/view/assets/css/inscription.css">
      <?php 
      	if(isset($_GET["p"]) && $_GET["p"] == "profil"){
      ?>
		<link rel="stylesheet" href="./app/view/assets/css/profil.css">
      <?php
  		}
  	  ?>
      <link rel="stylesheet" href="./app/view/assets/css/modificationProfil.css">
      <?php 
      	if(isset($_GET["p"]) && $_GET["p"] == "contact"){
      ?>
      		<link rel="stylesheet" href="./app/view/assets/css/contact.css">
      <?php
      	}
      ?>
      <?php 
      	if(isset($_GET["p"]) && $_GET["p"] == "panier"){
      ?>
      		<link rel="stylesheet" href="./app/view/assets/css/panier.css">
      <?php
      	}
      ?>
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
	</head>
<body>
