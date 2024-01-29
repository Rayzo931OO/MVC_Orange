<?php

class User
{
	private $bdd;
	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}

	public function ajouterUser($nom, $prenom, $email, $code_postal, $adresse, $telephone, $mot_de_passe, $role)
	{
		$req = $this->bdd->prepare("INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone, mot_de_passe, role) VALUES (:nom, :prenom, :email, :code_postal, :adresse, :telephone, :mot_de_passe, :role)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':email', $email);
		$req->bindParam(':code_postal', $code_postal);
		$req->bindParam(':adresse', $adresse);
		$req->bindParam(':telephone', $telephone);
		$req->bindParam(':mot_de_passe', $mot_de_passe);
		$req->bindParam(':role', $role);

		return $req->execute();
	}

	public function allUsers()
	{
		//ecriture de la requete
		$requete = "select * from users_view;";
		$req = $this->bdd->prepare($requete);
		$req->execute();
		return $req->fetchAll();
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
		$req->execute();
		return $req->fetch();
	}
	function selectTechnicienById($id)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from technicien where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':id_utilisateur', $id);
		$req->execute();
		return $req->fetch();
	}
	function selectWhereUser($email, $password)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from user where email= :email and password= :password;");
		$req->bindParam(':email', $email);
		$req->bindParam(':password', $password);
		$req->execute();
		return $req->fetchAll();
	}
	function selectLikeUser($mot, $role)
	{
		$mot = "%" . $mot . "%";
		$req = $this->bdd->prepare("SELECT * from user where role= :role and (nom like :mot or prenom like :mot or  email like :mot or telephone like :mot);");
		$req->bindParam(':role', $role);
		$req->bindParam(':mot', $mot);
		$req->execute();
		return $req->fetchAll();
	}

	function updateUser($user, $avatar)
	{
		// var_dump($user);
		try {
			$req = $this->bdd->prepare("UPDATE user SET nom= :nom, prenom= :prenom, email= :email, code_postal= :codePostal, adresse= :adresse, telephone= :telephone, avatar= :avatar, role= :role WHERE id_utilisateur= :id_utilisateur;");
			$req->bindParam(':nom', $user['nom']);
			$req->bindParam(':prenom', $user['prenom']);
			$req->bindParam(':email', $user['email']);
			$req->bindParam(':codePostal', $user['codePostal']);
			$req->bindParam(':adresse', $user['adresse']);
			$req->bindParam(':telephone', $user['telephone']);
			$req->bindParam(':avatar', $avatar);
			$req->bindParam(':id_utilisateur', $user['id_utilisateur']);
			$req->bindParam(':role', $user['role']);
			$req->execute();
			$result = $req->fetch();
			// var_dump($result); // Check how many rows were affected
			// var_dump($req->rowCount()); // Check how many rows were affected

			return $result; // Returns true if one or more rows were updated
		} catch (PDOException $e) {
			error_log("Error in updateUser: " . $e->getMessage());
			var_dump("Error in updateUser: " . $e->getMessage());
			return false;
		}
	}

	function deleteUserById($id)
	{
		//ecriture de la requete
		$req =  $this->bdd->prepare("DELETE from user where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':id_utilisateur', $id);
		$req->execute();
		return $req->fetchAll();
	}

	function selectInterventionByUserId($id)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from intervention where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':id_utilisateur', $id);
		$req->execute();
		return $req->fetchAll();
	}
	function technicienExists($id_technicien)
	{
		$req = $this->bdd->prepare("SELECT * FROM technicien WHERE id_technicien = :id_technicien");
		$req->bindParam(':id_technicien', $id_technicien);
		$req->execute();
		$result = $req->fetch();
		return $result ? true : false;
	}
}
