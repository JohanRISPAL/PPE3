<?php

class Adresse{
	private $_id;
	private $_nom;
	private $_adresse;
	private $_cp;
	private $_ville;
	private $_clientId;

	public function __construct($_id, $_nom, $_adresse, $_cp, $_ville, $_clientId){
		$this->_id = $_id;
		$this->_nom = $_nom;
		$this->_adresse = $_adresse;
		$this->_cp = $_cp;
		$this->_ville = $_ville;
		$this->_clientId = $_clientId;
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

	public function setSet($_nom){
		$this->_nom = $_nom;
	}

	public function getAdresse(){
		return $this->_adresse;
	}

	public function setAdresse($_adresse){
		$this->_adresse = $_adresse;
	}

	public function getCp(){
		return $this->_cp;
	}

	public function setCp($_cp){
		$this->_cp = $_cp;
	}

	public function getVille(){
		return $this->_ville;
	}

	public function setVille($_ville){
		$this->_ville = $_ville;
	}

	public function getClientId(){
		return $this->_clientId;
	}

	public function setClientId($_clientId){
		$this->_clientId = $_clientId;
	}

	public static function getAllUserAdresse($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM adresse WHERE clientID = ?");
		$query->execute(array($id));
		$queryResult = $query->fetchAll();
		$adresse = array();
		foreach ($queryResult as $q) {
			array_push($adresse, new Adresse($q["id"], $q["nom"], $q["adresse"], $q["cp"], $q["ville"], $id));
		}
		return $adresse;
	}

	public static function createAdresse($bdd, $nom, $adresse, $cp, $ville, $id){
		$query = $bdd->prepare("INSERT INTO adresse (nom, adresse, cp, ville, clientID) VALUES (?, ?, ?, ?, ?)");
		$query->execute(array($nom, $adresse, $cp, $ville, $id));
		return $queryID = $bdd->lastInsertId();
	}


	public static function getAdresseCommande($bdd, $id, $clientID){
		$query = $bdd->prepare("SELECT * FROM adresse WHERE id = ?");
		$query->execute(array($id));
		$queryResult = $query->fetchAll();


		$queryClient = $bdd->prepare("SELECT * FROM client WHERE id = ?");
		$queryClient->execute(array($clientID));
		$queryClientResult = $queryClient->fetch();
		
		$adresse = array();
		foreach ($queryResult as $q) {
			array_push($adresse, new Adresse($q["id"], $q["nom"], $q["adresse"], $q["cp"], $q["ville"], $queryClientResult["id"]));
		}
		return $adresse;
	}
}	
?>