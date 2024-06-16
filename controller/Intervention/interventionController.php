<?php
require_once("../../model/Intervention/interventionModel.php");
class ControllerIntervention
{
	private $unModele;
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
		$this->unModele->ajouterInterventionClient($POST["id_client"],$POST["description"], $POST["id_materiel"]);
	}
	public function ajouterInterventionAdmin($POST)
	{
		//controler les données avant insertion dans la table promotion

		//on appelle la méthode du Modele
		$this->unModele->ajouterInterventionAdmin($POST["id_client"],$POST["date_inter"], $POST["status"], $POST["description"], $POST["id_materiel"], $POST["id_technicien"]);
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

	public function updateInterventionTechnicien($Intervention, $role)
	{
		$this->unModele->updateInterventionTechnicien($Intervention, $role);
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
