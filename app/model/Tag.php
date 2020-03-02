<?php

class Tag{
	private $_id;
	private $_nom;

	public function __construct($_id, $_nom = "missingname"){
		$this->_id = $_id;
		$this->_nom = ucfirst($_nom);
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

	public static function getTagById($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM tag WHERE id = ?");
		$query->execute(array($id));
		$queryResult = $query->fetchAll();

		$tag = array();
		foreach($queryResult as $q){
			array_push($tag, new Tag($q["id"], $q['nom']));
		}
		return $tag;
	}

	public static function getTagOfProduct($bdd, $id){
		$query = $bdd->prepare("SELECT tag.id FROM `tag` INNER JOIN produit_tag ON tag.id = produit_tag.tagID INNER JOIN produit ON produit_tag.produitID = produit.id WHERE produit_tag.produitID = ?");
		$query->execute(array($id));
		return $query->fetchAll();
	}

	public static function getTag($bdd){
		$query = $bdd->prepare("SELECT * FROM tag");
		$query->execute();
		$queryResult = $query->fetchAll();

		$tag = array();
		foreach($queryResult as $q){
			array_push($tag, new Tag($q["id"], $q['nom']));
		}
		return $tag;
	}

	public static function insertTagForProduct($bdd, $idProduct, $idTag){
		$query = $bdd->prepare("INSERT INTO produit_tag (produitID, tagID) VALUES (?, ?)");
		$query->execute(array($idProduct, $idTag));
	}

	public static function insertTag($bdd, $name){
		$query = $bdd->prepare("INSERT INTO tag (nom) VALUES (?)");
		$query->execute(array($name));
	}

	public static function getLastInsertTag($bdd){
		$query = $bdd->prepare("SELECT * FROM tag ORDER BY id DESC LIMIT 0, 1 ");
		$query->execute();

		$tag = array();
		$queryResult = $query->fetch();

		array_push($tag, new Tag($queryResult["id"], $queryResult["nom"]));

		return $tag;
	}

	public static function deleteTagToProduct($bdd, $idProduct, $idTag){
		$query = $bdd->prepare("DELETE FROM `produit_tag` WHERE produitID = ? AND tagID = ?");
		$query->execute(array($idProduct, $idTag));
	}
}
?>