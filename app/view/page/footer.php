	<div class="copyright">
		<p>Copyright ElBijou</p>
	</div>
</body>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./app/view/assets/js/slider.js"></script>
<script src="./app/view/assets/js/listeDeroulante.js"></script>
<script src="./app/view/assets/js/connexion.js"></script>
<script src="./app/view/assets/js/produit.js"></script>
<script src="./app/view/assets/js/espaceAdmin.js"></script>
<?php 
	if (isset($_GET["p"]) && $_GET["p"] == "modificationProfil"){
?>
	<script src="./app/view/assets/js/modificationProfil.js"></script>
<?php	
	}
?>
</html>
