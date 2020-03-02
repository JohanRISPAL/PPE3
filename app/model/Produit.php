<?php

class Product{
	private $_id;
	private $_nom;
	private $_prix;
	private $_quantite;
	private $_dateDeCreation;
	private $_description;
	private $_etat;
	private $_categorie;

	public function __construct($_id, $_nom = "missingname", $_prix = 0, $_quantite, $_dateDeCreation = "0000-00-00 00:00:00", $_description = "Il n'y a pas de description pour ce produit", $_etat = 0, $_categorie = 0){
		$this->_id = $_id;
		$this->_nom = ucfirst($_nom);
		$this->_prix = $_prix;
		$this->_quantite = $_quantite;
		$this->_dateDeCreation = $_dateDeCreation;
		$this->_description = $_description;
		$this->_etat = $_etat;
		$this->_categorie = $_categorie; 
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getLibelle(){
		return $this->_nom;
	}

	public function setLibelle($_nom){
		$this->_nom = $_nom;
	}

	public function getPrix(){
		return $this->_prix;
	}

	public function setPrix($_prix){
		$this->_prix = $_prix;
	}

	public function getQuantite(){
		return $this->_quantite;
	}

	public function setQuantite($_quantite){
		$this->_quantite = $_quantite;
	}

	public function getDateDeCreation(){
		return $this->_dateDeCreation;
	}

	public function setDateDeCreation($_dateDeCreation){
		$this->_dateDeCreation = $_dateDeCreation;
	}

	public function getDescription(){
		return $this->_description;
	}

	public function setDescription($_description){
		$this->_description = $_description;
	}

	public function getEtat(){
		return $this->_etat;
	}

	public function setEtat($_etat){
		$this->_etat = $_etat;
	}

	public function getCategorie(){
		return $this->_categorie;
	}

	public function setCategorie($_categorie){
		$this->_categorie = $_categorie;
	}

	public static function getProductById($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM produit WHERE id = ?");
		$query->execute(array($id));
		$queryResult = $query->fetch();
		$prod = new Product($queryResult["id"], $queryResult["nom"], $queryResult["prix"], $queryResult["stock"], $queryResult["dateDeCreation"], $queryResult["description"], $queryResult["etat"], $queryResult["categorieID"]);
		return $prod;
	}

	public static function updateStock($bdd, $stock, $id){
		$query = $bdd->prepare("UPDATE produit SET stock = ? WHERE id = ?");
		$query->execute(array($stock, $id));
	}


	public static function getProductByPage($bdd,$categorieID, $nbPage, $limit = 9)
	{
		$nb = ($nbPage-1)*9; 
		$prod = array();
		if($categorieID == 0){

			$query = $bdd->prepare("SELECT * FROM produit WHERE etat != 0 LIMIT :nb, :limit");
			$query->bindValue(':nb', $nb, PDO::PARAM_INT);
			$query->bindValue(":limit", $limit, PDO::PARAM_INT);
			$query->execute();
			$queryResult = $query->fetchAll();
			
			foreach ($queryResult as $q) {
				array_push($prod, new Product($q["id"], $q["nom"], $q["prix"], $q["stock"], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]));
			}
		}else{
			$query = $bdd->prepare("SELECT * FROM produit WHERE categorieID = :cat AND etat != 0 LIMIT :nb, :limit");
			$query->bindValue(':nb', $nb, PDO::PARAM_INT);
			$query->bindValue(":limit", $limit, PDO::PARAM_INT);
			$query->bindValue(":cat", $categorieID, PDO::PARAM_INT);
			$query->execute();
			$queryResult = $query->fetchAll();
			
			foreach ($queryResult as $q) {
				array_push($prod, new Product($q["id"], $q["nom"], $q["prix"], $q["stock"], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]));
			}
		}
		return $prod;
	}

	
	public static function getStock($bdd, $id){
		$query = $bdd->prepare("SELECT stock FROM produit WHERE id = ?");
		$query->execute(array($id));
		return $query->fetch();
	}

	public static function insertProduit($bdd, $nom, $description, $prix, $quantite, $idCategorie, $tendance){
		$query = $bdd->prepare("INSERT INTO produit (categorieID, dateDeCreation, description, nom, prix, stock, etat) VALUES (?, NOW(), ?, ?, ?, ?, ?)");
		$query->execute(array($idCategorie, $description, $nom, $prix, $quantite, $tendance));
	}

	public static function getProductInTendance($bdd, $etat){
		$query = $bdd->prepare("SELECT * FROM produit WHERE etat = ? ORDER BY dateTendance");
		$query->execute(array($etat));
		$queryResult = $query->fetchAll();
		$prod = array();
		foreach ($queryResult as $q) {
			array_push($prod, new Product($q["id"], $q["nom"], $q["prix"], $q["stock"], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]));
		}
		return $prod;
		
	}

	public static function suppresionTendance($bdd, $id){
		$query = $bdd->prepare("UPDATE produit SET etat = 1 WHERE id = ?");
		$query->execute(array($id));
	}

	public static function ajoutTendance($bdd, $id){

		$query = $bdd->prepare("UPDATE produit SET etat = 2 WHERE id = ?");
		$query->execute(array($id));

		$queryDate = $bdd->prepare("UPDATE produit SET dateTendance = NOW() WHERE id = ?");
		$queryDate->execute(array($id));

		$nbMisEnAvant = $bdd->prepare("SELECT etat FROM produit WHERE etat = 2");
		$nbMisEnAvant->execute();

		if(count($nbMisEnAvant->fetchAll()) > 3){
			$queryUnset = $bdd->prepare("UPDATE produit as p1 SET etat = 0  WHERE dateTendance <= (SELECT minimum FROM(SELECT MIN(dateTendance) as minimum from produit) as pTemp)");
			$queryUnset->execute();

			$queryUnsetDate = $bdd->prepare("UPDATE produit as p1 SET dateTendance = NULL WHERE dateTendance <= (SELECT minimum FROM(SELECT MIN(dateTendance) as minimum from produit) as pTemp)");
			$queryUnsetDate->execute();

		}
	}

	public static function getLastProductInsert($bdd){
		$query = $bdd->prepare("SELECT * FROM produit WHERE id >= ALL (SELECT id FROM produit)");
		$query->execute();
		return $query->fetch();
	}

	public static function modifyProduct($bdd, $id, $nom, $description, $prix, $stock){
		$queryNom = $bdd->prepare("UPDATE Produit SET nom = ? WHERE id = ?");
		$queryNom->execute(array($nom, $id));

		$queryDescription = $bdd->prepare("UPDATE Produit SET description = ? WHERE id = ?");
		$queryDescription->execute(array($description, $id));

		$queryPrix = $bdd->prepare("UPDATE Produit SET prix = ? WHERE id = ?");
		$queryPrix->execute(array($prix, $id));

		$queryStock = $bdd->prepare("UPDATE Produit SET stock = ? WHERE id = ?");
		$queryStock->execute(array($stock, $id));
	}

	public static function getNbProductByCategorie($bdd, $idCategorie){
		$nbProd = 0;

		if($idCategorie == 0){
			$query = $bdd->prepare("SELECT COUNT(id) as nb FROM produit");
			$query->execute();
			$nbProd = $query->fetch();
		}else{
			$query = $bdd->prepare("SELECT COUNT(id) as nb FROM produit WHERE categorieID = ?");
			$query->execute(array($idCategorie));
			$nbProd = $query->fetch();
		}
		return $nbProd["nb"];
	}

	public static function getProduct($bdd){
		$query = $bdd->prepare("SELECT * FROM produit");
		$query->execute();
		$queryResult = $query->fetchAll();

		$prod = array();
		
		foreach ($queryResult as $q) {
			array_push($prod, new Product($q["id"], $q["nom"], $q["prix"], $q["stock"], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]));
		}

		return $prod;
	}

	public static function setActiveProduct($bdd, $id){
		$query = $bdd->prepare("UPDATE produit SET etat = 1 WHERE id = ?");
		$query->execute(array($id));
	}

	public static function setDesactiveProduct($bdd, $id){
		$query = $bdd->prepare("UPDATE produit SET etat = 0 WHERE id = ?");
		$query->execute(array($id));
	}

	public static function getDesactivedProduct($bdd, $etat){
		$query = $bdd->prepare("SELECT * FROM produit WHERE etat = ?");
		$query->execute(array($etat));
		$queryResult = $query->fetchAll();
		$prod = array();
		foreach ($queryResult as $q) {
			array_push($prod, new Product($q["id"], $q["nom"], $q["prix"], $q["stock"], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]));
		}
		return $prod;
	}

	public static function getMostSoldProduct($bdd){
		$query = $bdd->prepare("SELECT produitID, SUM(quantite) as nbproduit FROM ligne_commande GROUP BY produitID ORDER BY nbproduit DESC LIMIT 3");
		$query->execute();
		return $queryResult = $query->fetchAll();
	}

	public static function getAVGPriceByCart($bdd){
		$query = $bdd->prepare("SELECT SUM(quantite*prix) as prixPanier FROM ligne_commande INNER JOIN produit ON ligne_commande.produitID = produit.id GROUP BY commandeID");
		$query->execute();
		return $query->fetchAll();
	}

	public static function getProductByName($bdd, $name){ 
		$prod = array();

		$query = $bdd->prepare("SELECT * FROM produit WHERE etat != 0 AND nom LIKE :name");
		$query->bindValue(":name", "%".$name."%", PDO::PARAM_STR);
		$query->execute();
		$queryResult = $query->fetchAll();
		foreach ($queryResult as $q) {
			array_push($prod, new Product($q["id"], $q["nom"], $q["prix"], $q["stock"], $q["dateDeCreation"], $q["description"], $q["etat"], $q["categorieID"]));
		}

		return $prod;
	}

	public static function getProductLinkedByTag($bdd, $idtag, $id){
		$query = $bdd->prepare("SELECT produit.id FROM `produit` INNER JOIN produit_tag ON produit.id = produitID WHERE produit_tag.tagID = ? AND produit.id != ?");
		$query->execute(array($idtag, $id));
		return $queryResult = $query->fetchAll();
	}

	public static function isNewProduct($bdd, $date, $id){
		$query = $bdd->prepare("SELECT * FROM `produit` WHERE DATEDIFF (NOW(), ?) <= 7 ");
		$query->execute(array($date));
		$queryResult = $query->fetchAll();
		$boolean = 0;

		foreach($queryResult as $q){
			if ($id == $q["id"]){
				$boolean = 1;
			}
		}

		return $boolean;
	}
}
?>