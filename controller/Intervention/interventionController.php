<?php
	require_once ("model/Intervention/interventionModel.php"); 
    require_once ("bdd/bdd.php"); 
	class ControleurIntervention {
		private $unModele ;
		public function __construct ($bdd){

			//instanciation de la classe Modele 
			$this->unModele = new Intervention($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public function ajouterIntervention($date_debut, $date_fin, $status, $description, $id_technicien, $id_type_intervention) {
			//controler les données avant insertion dans la table promotion 

			//on appelle la méthode du Modele 
			$this->unModele->ajouterIntervention($date_debut, $date_fin, $status, $description, $id_technicien, $id_type_intervention); 
		}
		public function allIntervention() {
			$lesInterventions = $this->unModele->allIntervention(); 
			//on realise des controles 

			return $lesInterventions ;
		}

        public function selectInterventionById($id) {
			$lesInterventions = $this->unModele->selectInterventionById($id); 
			//on realise des controles 
			return $lesInterventions ;
		}
		public function selectLikeIntervention ($mot) {
			$lesInterventions = $this->unModele->selectLikeIntervention($mot); 
			//on realise des controles 
			return $lesInterventions ;
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