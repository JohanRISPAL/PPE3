<?php

class Users{
	private $_id;
	private $_prenom;
	private $_nom;
	private $_dateDeNaissance;
	private $_genre;
	private $_login;
	private $_mdp;
	private $_isAdmin;

	public function __construct($_id, $_prenom = "missingname", $_nom = 0, $_dateDeNaissance, $_genre = "0000-00-00 00:00:00", $_login = "Il n'y a pas de login pour ce produit", $_mdp = 0, $_isAdmin = 0){
		$this->_id = $_id;
		$this->_prenom = ucfirst($_prenom);
		$this->_nom = $_nom;
		$this->_dateDeNaissance = $_dateDeNaissance;
		$this->_genre = $_genre;
		$this->_login = $_login;
		$this->_mdp = $_mdp;
		$this->_isAdmin = $_isAdmin; 
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getPrenom(){
		return $this->_prenom;
	}

	public function setPrenom($_prenom){
		$this->_prenom = $_prenom;
	}

	public function getNom(){
		return $this->_nom;
	}

	public function setNom($_nom){
		$this->_nom = $_nom;
	}

	public function getDateDeNaissance(){
		return $this->_dateDeNaissance;
	}

	public function setDateDeNaissance($_dateDeNaissance){
		$this->_dateDeNaissance = $_dateDeNaissance;
	}

	public function getGenre(){
		return $this->_genre;
	}

	public function setGenre($_genre){
		$this->_genre = $_genre;
	}

	public function getLogin(){
		return $this->_login;
	}

	public function setLogin($_login){
		$this->_login = $_login;
	}

	public function getMdp(){
		return $this->_mdp;
	}

	public function setMdp($_mdp){
		$this->_mdp = $_mdp;
	}

	public function getIsAdmin(){
		return $this->_isAdmin;
	}

	public function setIsAdmin($_isAdmin){
		$this->_isAdmin = $_isAdmin;
	}

	public function getUserWithoutAdminConnected($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM client WHERE id != ?");
		$query->execute(array($id));

		$queryResult = $query->fetchAll();
		$user = array();

		foreach ($queryResult as $q) {
			array_push($user, new Users($q["id"], $q["prenom"], $q["nom"], $q["dateDeNaissance"], $q["genre"], $q["login"], $q["mdp"], $q["isAdmin"]));
		}

		return $user;
	}

	public function getUserById($bdd, $id){
		$query = $bdd->prepare("SELECT * FROM client WHERE id = ?");
		$query->execute(array($id));

		$queryResult = $query->fetch();

		return new Users($queryResult["id"], $queryResult["prenom"], $queryResult["nom"], $queryResult["dateDeNaissance"], $queryResult["genre"], $queryResult["login"], $queryResult["mdp"], $queryResult["isAdmin"]);
	}


	public function getUser($bdd, $login, $pwd){
		$query = $bdd->prepare("SELECT * FROM client WHERE login = ? AND mdp = ?");
		$query->execute(array($login, $pwd));
		$queryResult = $query->fetch();

		return new Users($queryResult["id"], $queryResult["prenom"], $queryResult["nom"], $queryResult["dateDeNaissance"], $queryResult["genre"], $queryResult["login"], $queryResult["mdp"], $queryResult["isAdmin"]);
	}
}
?>