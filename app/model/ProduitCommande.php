<?php

class ProduitCommande{
	private $_id;
	private $_produitID;
	private $_commandeID;
	private $_quantite;

	public function __construct($_id, $_produitID, $_commandeID, $_quantite){
		$this->_id = $_id;
		$this->_produitID = $_produitID;
		$this->_commandeID = $_commandeID;
		$this->_quantite = $_quantite;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getProduitID(){
		return $this->_produitID;
	}

	public function setProduitID($_id){
		$this->_produitID = $_produitID;
	}

	public function getCommandeID(){
		return $this->_commandeID;
	}

	public function setCommandeID($_id){
		$this->_commandeID = $_commandeID;
	}

	public function getQuantite(){
		return $this->_quantite;
	}

	public function setQuantite($_id){
		$this->_quantite = $_quantite;
	}

	public static function insertProduitCommande($bdd, $produitID, $commandeID, $quantite){
		$query = $bdd->prepare("INSERT INTO ligne_commande (produitID, commandeID, quantite) VALUES (?, ?, ?)");
		$query->execute(array($produitID, $commandeID, $quantite));
	}

	public static function getIdProductInCommande($bdd, $idCommande){
		$query = $bdd->prepare("SELECT * FROM ligne_commande WHERE commandeID = ?");
		$query->execute(array($idCommande));
		return $query->fetchAll();
	}

}
?>