<?php

class User
{
	private $bdd;
	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}

	public function ajouterUser($nom, $prenom, $email, $code_postal, $adresse, $telephone, $mot_de_passe)
	{
		$req = $this->bdd->prepare("INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :code_postal, :adresse, :telephone, :mot_de_passe)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':email', $email);
		$req->bindParam(':code_postal', $code_postal);
		$req->bindParam(':adresse', $adresse);
		$req->bindParam(':telephone', $telephone);
		$req->bindParam(':mot_de_passe', $mot_de_passe);

		return $req->execute();
	}

	public function allClient()
	{
		//ecriture de la requete
		$requete = "select * from client_view;";
		$req = $this->bdd->prepare($requete);
		$req->execute();
		return $req->fetchAll();
	}

	public function allTechniciens()
	{
		//ecriture de la requete
		$requete = "select * from techniciens_view;";
		$req = $this->bdd->prepare($requete);
		$req->execute();
		return $req->fetchAll();
	}

	public function allAdmin()
	{
		//ecriture de la requete
		$requete = "select * from admin_view;";
		$req = $this->bdd->prepare($requete);
		$req->execute();
		return $req->fetchAll();
	}

	function selectUserById($id)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from user where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':id_utilisateur', $id);
		$req = $this->bdd->prepare($req);
		$req->execute();
		return $req->fetchAll();
	}
	function selectWhereUser($email, $password)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from user where email= :email and password= :password;");
		$req->bindParam(':email', $email);
		$req->bindParam(':password', $password);
		$req = $this->bdd->prepare($req);
		$req->execute();
		return $req->fetchAll();
	}
	function selectLikeUser($mot, $role)
	{
		$req = $this->bdd->prepare("SELECT * from user where role= :role and (nom like :mot or prenom like :mot or  email like :mot or telephone like :mot);");
		$req->bindParam(':role', $role);
		$req->bindParam(':mot', $mot);
		$req = $this->bdd->prepare($req);
		$req->execute();
		return $req->fetchAll();

	}

	function updateUser($user, $avatar)
	{
		//ecriture de la requete
		$req =  $this->bdd->prepare ("UPDATE user set nom= :nom, prenom= :prenom, email= :email, codePostal= :codePostal, adresse= :adresse, telephone= :telephone, avatar= :avatar where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':nom', $user['nom']);
		$req->bindParam(':prenom', $user['prenom']);
		$req->bindParam(':email', $user['email']);
		$req->bindParam(':codePostal', $user['codePostal']);
		$req->bindParam(':adresse', $user['adresse']);
		$req->bindParam(':telephone', $user['telephone']);
		$req->bindParam(':avatar', $avatar);	
		$req->bindParam(':id_utilisateur', $user['id']);	
		$req = $this->bdd->prepare($req);
		$req->execute();
		return $req->fetchAll();
	}

	function deleteUserById($id)
	{
		//ecriture de la requete
		$req =  $this->bdd->prepare ("DELETE from user where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':id_utilisateur', $id);
		$req = $this->bdd->prepare($req);
		$req->execute();
		return $req->fetchAll();
	}
}
