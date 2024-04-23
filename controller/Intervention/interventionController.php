<?php
require_once(BASE_PATH . "/model/Intervention/interventionModel.php");
class ControllerIntervention
{
	private $unModele;
	private $bdd;
	public function __construct($bdd)
	{

		//instanciation de la classe Modele
		$this->unModele = new Intervention($bdd);
	}
	/********************** Gestion de la promotion ***********/
	public function ajouterInterventionClient($POST)
	{
		//controler les données avant insertion dans la table promotion

		//on appelle la méthode du Modele
		$this->unModele->ajouterInterventionClient($POST["id_client"], $POST["description"], $POST["id_materiel"], $POST["id_logiciel"], $POST["id_categorie_intervention"]);
	}
	public function ajouterInterventionAdmin($POST)
	{
		//controler les données avant insertion dans la table promotion

		//on appelle la méthode du Modele
		$this->unModele->ajouterInterventionAdmin($POST["id_client"],$POST["date_debut"], $POST["date_fin"], $POST["status"], $POST["description"], $POST["id_materiel"], $POST["id_logiciel"], $POST["id_categorie_intervention"], $POST["id_technicien"]);
	}
	public function allIntervention()
	{
		return $this->unModele->allIntervention();
		//on realise des controles
	}
	function selectInterventionByUserId($id)
	{
		return $this->unModele->selectInterventionByUserId($id);
	}
	function selectInterventionByTechnicien($id)
	{
		return $this->unModele->selectInterventionByTechnicien($id);
	}

	function selectInterventionNonAssigner()
	{
		return $this->unModele->selectInterventionNonAssigner();
	}

	public function selectInterventionById($id)
	{
		$lesInterventions = $this->unModele->selectInterventionById($id);
		//on realise des controles
		return $lesInterventions;
	}
	public function selectLikeInterventionDateDebut($mot)
	{
		//on realise des controles
		return $this->unModele->selectLikeInterventionDateDebut($mot);
	}
	public function selectLikeInterventionDateFin($mot)
	{
		//on realise des controles
		return $this->unModele->selectLikeInterventionDateFin($mot);
	}
	public function selectLikeInterventionStatus($mot)
	{
		//on realise des controles
		return $this->unModele->selectLikeInterventionStatus($mot);
	}

	public function selectInterventionByAlphaOrderASC()
	{
		//on realise des controles
		return $this->unModele->selectInterventionByAlphaOrderASC();
	}

	public function updateInterventionTechnicien($Intervention)
	{
		$this->unModele->updateInterventionTechnicien($Intervention);
	}

	public function deleteInterventionById($id)
	{
		$this->unModele->deleteInterventionById($id);
	}
	public function assignerTechnicienAIntervention($id_intervention, $id_technicien)
	{
		$this->unModele->assignerTechnicienAIntervention($id_intervention, $id_technicien);
	}
}
