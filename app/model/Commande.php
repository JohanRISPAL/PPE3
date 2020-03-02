<?php
	
class Commande{
	private $_id;
	private $_clientID;
	private $_dateCommande;
	private $_etatCommandeID;
	private $_adresseID;

	public function __construct($_id, $_clientID, $_dateCommande, $_etatCommandeID, $_adresseID){
		$this->_id = $_id;
		$this->_clientID = $_clientID;
		$this->_dateCommande = $_dateCommande;
		$this->_etatCommandeID = $_etatCommandeID;
		$this->_adresseID = $_adresseID;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getClientID(){
		return $this->_clientID;
	}

	public function setClientID($_clientID){
		$this->_clientID = $_clientID;
	}

	public function getDateCommande(){
		return $this->_dateCommande;
	}

	public function setDateCommande($_dateCommande){
		$this->_dateCommande = $_dateCommande;
	}

	public function getEtatCommandeID(){
		return $this->_etatCommandeID;
	}

	public function setEtatCommandeID($_etatCommandeID){
		$this->_etatCommandeID = $_etatCommandeID;
	}

	public function getAdresseID(){
		return $this->_adresseID;
	}

	public function setAdresseID($_adresseID){
		$this->_adresseID = $_adresseID;
	}

	public static function getEtatCommande($bdd, $id){
		$query = $bdd->prepare("SELECT nom FROM etat_commande WHERE id = ?");
		$query->execute(array($id));
		return $query->fetch();
	}

	public static function insertCommande($bdd, $idClient, $idAdresse){
		$query = $bdd->prepare("INSERT INTO commande (adresseID, clientID, dateCommande, etatCommandeID) VALUES (?, ?, NOW(), ?)");
		$query->execute(array($idAdresse, $idClient, 1));
	}

	public static function getUserCommande($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM commande WHERE clientID = ?");
		$query->execute(array($id));
		$queryResult = $query->fetchAll();
		$commande = array();
		foreach($queryResult as $q){
			array_push($commande, new Commande($q["id"], $q["clientID"], $q["dateCommande"], $q["etatCommandeID"], $q["adresseID"]));
		}
		return $commande;
	}

	public static function getLastCommande($bdd){
		$query = $bdd->prepare("SELECT * FROM commande ORDER BY id DESC LIMIT 0 ,1");
		$query->execute();
		return $query->fetch();
	}

	public static function getCommandeById($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM commande WHERE id = ?");
		$query->execute(array($id));
		return $query->fetch();
	}

	public static function getAllCommande($bdd){
		$query = $bdd->prepare("SELECT * FROM commande");
		$query->execute();
		$queryResult = $query->fetchAll();
		$commande = array();
		foreach($queryResult as $q){
			array_push($commande, new Commande($q["id"], $q["clientID"], $q["dateCommande"], $q["etatCommandeID"], $q["adresseID"]));
		}
		return $commande;
	}

	public static function getNumberOfCommande($bdd){
		$query = $bdd->prepare("SELECT COUNT(id) as nbCommande FROM commande");
		$query->execute();
		return $query->fetch();
	}

	public static function getCommandeByUser($bdd, $idUser){
		$query = $bdd->prepare("SELECT COUNT(*) as nbCommande FROM commande WHERE clientID = ?");
		$query->execute(array($idUser));
		return $query->fetch();
	}
}
?>