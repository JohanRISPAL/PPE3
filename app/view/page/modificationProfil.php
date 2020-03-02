<div class="row" id="modifProfil">
	<input type="hidden" id="id" name="modification" value="<?php echo $_SESSION['id'];?>">
	<div class="col l12">
		<div class="col l4 offset-l1">
			<h2>Prénom :</h2>
			<input type="text" name="prenom" id="firstName" value="<?php echo $user->getPrenom();?>">
		</div>
		<div class="col l4 offset-l2">
			<h2>Nom :</h2>
			<input type="text" name="nom" id="name" value="<?php echo $user->getNom()?>">
		</div>
	</div>
	<div class="col l12">
		<div class="col l4 offset-l1">
			<h2>Login :</h2>
			<input type="text" name="login" id="login" minlength="3" value="<?php echo $user->getLogin()?>">
		</div>
		<div class="col l4 offset-l2">
			<h2>Mot de passe :</h2>
			<input type="text" name="pwd" id="mdp" minlength="3" value="<?php echo $user->getMdp()?>">
		</div>
	</div>
	<div class="col l10 offset-l1">
		<h2>Confirmation du mot de passe :</h2>
	    <input type="text" name="confiPwd" id="confiMdp" value="<?php echo $user->getMdp()?>">
	</div>
    <br/><br/>
    <div class="col l12" id="buttonConfirm">
		<button name="boutonModif" id="buttonModif">Modifier</button>
	</div>
</div>