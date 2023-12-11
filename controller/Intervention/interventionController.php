<?php
	require_once (BASE_PATH."/model/Intervention/interventionModel.php");
	class ControllerIntervention {
		private $unModele ;
		private $bdd;
		public function __construct ($bdd){

			//instanciation de la classe Modele
			$this->unModele = new Intervention($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public function ajouterIntervention($POST) {
			//controler les données avant insertion dans la table promotion

			//on appelle la méthode du Modele
			$this->unModele->ajouterIntervention($POST["date_debut"], $POST["date_fin"], $POST["status"], $POST["description"], $POST["id_technicien"],$POST["id_materiel"],$POST["id_logiciel"], $POST["id_type_intervention"]);
		}
		public function allIntervention() {
			return $this->unModele->allIntervention();
			//on realise des controles
		}
		function selectInterventionByUserId($id)
		{
			return$this->unModele->selectInterventionByUserId($id);
		}
		function selectInterventionByTechnicien($id)
		{
			return$this->unModele->selectInterventionByTechnicien($id);
		}

        public function selectInterventionById($id) {
			$lesInterventions = $this->unModele->selectInterventionById($id);
			//on realise des controles
			return $lesInterventions ;
		}
		public function selectLikeInterventionDateDebut ($mot) {
			//on realise des controles
			return $this->unModele->selectLikeInterventionDateDebut($mot) ;
		}
		public function selectLikeInterventionDateFin ($mot) {
			//on realise des controles
			return $this->unModele->selectLikeInterventionDateFin($mot) ;
		}
		public function selectLikeInterventionStatus ($mot) {
			//on realise des controles
			return $this->unModele->selectLikeInterventionStatus($mot) ;
		}

		public function selectInterventionByAlphaOrdderASC () {
			//on realise des controles
			return $this->unModele->selectInterventionByAlphaOrdderASC() ;
		}

		public function updateIntervention($Intervention)
		{
			$this->unModele->updateIntervention($Intervention);
		}

        public function deleteInterventionById($id)
		{
			$this->unModele->deleteInterventionById($id);
		}

	}

?>