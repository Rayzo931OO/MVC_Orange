<?php

class User
{
	private $bdd;
	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}

	public function ajouterUser($nom, $prenom, $email, $code_postal, $adresse, $telephone,$sexe, $mot_de_passe, $role)
	{
		$req = $this->bdd->prepare("INSERT INTO user (nom, prenom, email, code_postal, adresse, telephone,sexe, mot_de_passe, role) VALUES (:nom, :prenom, :email, :code_postal, :adresse, :telephone, :sexe, :mot_de_passe, :role)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':email', $email);
		$req->bindParam(':code_postal', $code_postal);
		$req->bindParam(':adresse', $adresse);
		$req->bindParam(':telephone', $telephone);
		$req->bindParam(':sexe', $sexe);
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

	public function allSuperviseur()
	{
		//ecriture de la requete
		$requete = "select * from superviseur_view;";
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
		$req = $this->bdd->prepare("SELECT * from user where id_utilisateur= :id_utilisateur;");
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
		$req = $this->bdd->prepare("SELECT * from user where role= :role and (nom like :mot or prenom like :mot or  email like :mot or telephone like :mot or sexe like :mot);");
		$req->bindParam(':role', $role);
		$req->bindParam(':mot', $mot);
		$req->execute();
		return $req->fetchAll();
	}

	function updateUser($user)
	{
		try {
			$req = $this->bdd->prepare("select update_user( :id_utilisateur, :nom, :prenom, :code_postal, :adresse, :telephone, :sexe);");
			$req->bindParam(':id_utilisateur', $user['id']);
			$req->bindParam(':nom', $user['nom']);
			$req->bindParam(':prenom', $user['prenom']);
			$req->bindParam(':code_postal', $user['code_postal']);
			$req->bindParam(':adresse', $user['adresse']);
			$req->bindParam(':telephone', $user['telephone']);
			$req->bindParam(':sexe', $user['sexe']);

			$req->execute();
			$result = $req->fetch();
			// var_dump($result); // Check how many rows were affected
			// var_dump($req->rowCount()); // Check how many rows were affected
			if ($result) {
				$_SESSION["nom"] = $user['nom'];
				$_SESSION["prenom"] = $user['prenom'];
				$_SESSION["code_postal"] = $user['code_postal'];
				$_SESSION["adresse"] = $user['adresse'];
				$_SESSION["telephone"] = $user['telephone'];
				$_SESSION["sexe"] = $user['sexe'];
			}
			return $result; // Returns true if one or more rows were updated
		} catch (PDOException $e) {
			error_log("Error in updateUser: " . $e->getMessage());
			var_dump("Error in updateUser: " . $e->getMessage());
			return false;
		}
	}

	function updateUserWithRole($user)
	{
		try {
			$req = $this->bdd->prepare("select update_user_with_role( :id_utilisateur, :nom, :prenom, :code_postal, :adresse, :telephone, :sexe, :role);");
			$req->bindParam(':id_utilisateur', $user['id']);
			$req->bindParam(':nom', $user['nom']);
			$req->bindParam(':prenom', $user['prenom']);
			$req->bindParam(':code_postal', $user['code_postal']);
			$req->bindParam(':adresse', $user['adresse']);
			$req->bindParam(':telephone', $user['telephone']);
			$req->bindParam(':sexe', $user['sexe']);
			$req->bindParam(':role', $user['role']);

			$req->execute();
			return $req->fetch();
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
		return $req->fetch();
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
	function userLogout()
	{
		$_SESSION = array();
		// Destroy the session
		session_destroy();
	}
}
