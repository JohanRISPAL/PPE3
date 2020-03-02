<?php
Class Categorie{
	private $_id;
	private $_nom;

	public function __construct($_id, $_nom){
		$this->_id = $_id;
		$this->_nom = $_nom;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getNom(){
		return $this->_nom;
	}

	public function setNom($_nom){
		$this->_nom = $_nom;
	}

	public static function getCategorie($bdd){
		$query = $bdd->prepare("SELECT * FROM categorie");
		$query->execute();
		$queryResult = $query->fetchAll();
		$cat = array();
		foreach($queryResult as $q){
			array_push($cat, new Categorie($q["id"], $q["nom"]));
		}
		return $cat;
	}

	public static function createCategorie($bdd, $nom){
		$query = $bdd->prepare("INSERT INTO categorie (nom) VALUES (?)");
		$query->execute(array($nom));
	}
}
?>