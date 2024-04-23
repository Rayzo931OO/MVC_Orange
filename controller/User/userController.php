<?php
require_once(BASE_PATH . "/model/user/userModel.php");
class ControllerUser
{
	private $unModele;
	public function __construct($bdd)
	{

		//instanciation de la classe Modele
		$this->unModele = new User($bdd);
	}
	/********************** Gestion de la promotion ***********/
	public function ajouterUser($POST)
	{
		//controler les données avant insertion dans la table promotion

		//on appelle la méthode du Modele
		$this->unModele->ajouterUser($POST["nom"], $POST["prenom"], $POST["email"], $POST["code_postal"], $POST["adresse"], $POST["telephone"], $POST["mot_de_passe"], $POST["role"]);
	}
	public function allUsers()
	{
		//on realise des controles

		return $this->unModele->allUsers();
	}
	public function allClient()
	{
		//on realise des controles

		return $this->unModele->allClient();
	}

	public function allTechniciens()
	{
		//on realise des controles

		return $this->unModele->allTechniciens();
	}

	public function allAdmin()
	{
		//on realise des controles

		return $this->unModele->allAdmin();
	}

	public function selectUserById($id)
	{
		//on realise des controles
		return $this->unModele->selectUserById($id);
	}
	public function selectTechnicienById($id)
	{
		//on realise des controles
		return $this->unModele->selectTechnicienById($id);
	}

	public function selectWhereUser($email, $password)
	{
		//on realise des controles
		return $this->unModele->selectWhereUser($email, $password);
	}
	public function selectLikeUser($mot, $role)
	{
		//on realise des controles
		return $this->unModele->selectLikeUser($mot, $role);
	}

	public function updateUser($user, $null)
	{
		$this->unModele->updateUser($user, $null);
	}

	public function deleteUserById($id)
	{
		$this->unModele->deleteUserById($id);
	}
	function selectInterventionByUserId($id)
	{
		$this->unModele->selectInterventionByUserId($id);
	}
	function technicienExists($id_technicien)
	{
		$this->unModele->technicienExists($id_technicien);
	}
	function userLogout()
	{
		$this->unModele->userLogout();
	}
}
