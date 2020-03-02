<div class="row" id="inscriptionContainer">
	<form id="inscriptions" method="post" action="index.php?p=inscription">
		<input type="hidden" name="inscription" value="true">
		<div class="col l12">
			<div class="col l6">
				<h4>Prenom</h4>
				<input type="text" name="prenom" required>
			</div>

			<div class="col l6">
				<h4>Nom</h4>
				<input type="text" name="nom" required>
			</div>
		</div>
		<div class="col l12">
			<div class="col l6">
				<h4>Date de Naissance</h4>
				<input type="date" name="dateNaissance" required placeholder="Date de naissance : ">
			</div>
			<div class="col l6">
				<h4>Genre</h4>
				<label>
			        <input name="genre" type="radio" value="1" />
			        <span>Femme</span>
			    </label>
			    <label>
			        <input name="genre" type="radio" value="2" />
			        <span>Homme</span>
			    </label>
			</div>
		</div>
		<div class="col l12">
			<div class="col l6">
				<h4>Login</h4>
				<input type="text" name="login" required
			       minlength="3" placeholder="Login de connexion">
			</div>
			<div class="col l6">
			    <h4>Mot de passe</h4>
				<input type="password" name="pwd" required
			       minlength="3" placeholder="Mot de passe de connexion">
			</div>
		</div>
		<div class="buttonInscription">
			<input type="submit" name="inscription" value="Inscription">
		</div>
	</form>
</div>