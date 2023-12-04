<?php

class User
{
	private $bdd;
	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}

	public function ajouterUser($nom, $prenom, $email, $code_postal, $adresse, $telephone, $mot_de_passe, $date_inscription, $date_modification)
	{
		$req = $this->bdd->prepare("INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone, mot_de_passe
		date_inscription, date_modification) VALUES (:nom, :prenom, :email, :code_postal, :adresse, :telephone, :mot_de_passe, :date_inscription, :date_modification)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':email', $email);
		$req->bindParam(':code_postal', $code_postal);
		$req->bindParam(':adresse', $adresse);
		$req->bindParam(':telephone', $telephone);
		$req->bindParam(':mot_de_passe', $mot_de_passe);
		$req->bindParam(':date_inscription', $date_inscription);
		$req->bindParam(':date_modification', $date_modification);

		return $req->execute();
	}

	public function allUser()
	{
		//ecriture de la requete
		$requete = "select * from user;";
		$req = $this->bdd->prepare($requete);
		$req->execute();
		$res = $req->fetchAll();
	}

	function selectUserById($id)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("select * from user where id=id) VALUES (:id)");
		$req->bindParam(':id', $id);
		$req = $this->bdd->prepare($req);
		$req->execute();
		$res = $req->fetchAll();
	}
	function selectWhereUser($email, $password)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("select * from user where email=email and password=password;");
		$req->bindParam(':email', $email);
		$req->bindParam(':password', $password);
		$req = $this->bdd->prepare($req);
		$req->execute();
		$res = $req->fetchAll();
	}
	function selectLikeUser($mot, $role)
	{
		$req = $this->bdd->prepare("select * from user where role=role and (nom like '" . $mot . "' or prenom like '" . $mot . "' or  email like '" . $mot . "' or telephone like '" . $mot . "');");
		$req->bindParam(':role', $role);
		$req = $this->bdd->prepare($req);
		$req->execute();
		$res = $req->fetchAll();

	}

	function updateUser($user, $avatar)
	{
		//ecriture de la requete
		$req =  $this->bdd->prepare ("update user set nom=nom, prenom=prenom, email=email, codePostal=codePostal, adresse=adresse, telephone=telephone, avatar=avatar where id=id;");
		$req->bindParam(':nom', $user['nom']);
		$req->bindParam(':prenom', $user['prenom']);
		$req->bindParam(':codePostal', $user['nom']);
		$req->bindParam(':adresse', $user['nom']);
		$req->bindParam(':telephone', $user['nom']);
		$req->bindParam(':avatar', $avatar);	
		$req = $this->bdd->prepare($req);
		$req->execute();
		$res = $req->fetchAll();
	}

	function deleteUserById($id)
	{
		//ecriture de la requete
		$req =  $this->bdd->prepare ("delete from user where id=id;");
		$req->bindParam(':id', $id);
		$req = $this->bdd->prepare($req);
		$req->execute();
		$res = $req->fetchAll();
	}
}
