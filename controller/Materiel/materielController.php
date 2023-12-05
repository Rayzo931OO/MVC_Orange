<?php
	require_once ("model/Materiel/materielModel.php"); 
    require_once ("bdd/bdd.php"); 
	class ControleurMateriel {
		private $unModele ;
		public function __construct ($bdd){

			//instanciation de la classe Modele 
			$this->unModele = new Materiel($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public public function ajouterMateriel($nom, $description) {
			//controler les données avant insertion dans la table promotion 

			//on appelle la méthode du Modele 
			$this->unModele->ajouterMateriel($nom, $description); 
		}
		public function allMateriel() {
			$lesMateriels = $this->unModele->allMateriel(); 
			//on realise des controles 

			return $lesMateriels ;
		}

        public function selectMaterielById($id) {
			$lesMateriels = $this->unModele->selectMaterielById($id); 
			//on realise des controles 
			return $lesMateriels ;
		}
		public function selectLikeMateriel ($mot) {
			$lesMateriels = $this->unModele->selectLikeMateriel($mot); 
			//on realise des controles 
			return $lesMateriels ;
		}

		public function updateMateriel($Materiel)
		{
			$this->unModele->updateMateriel($Materiel);
		}

        public function deleteMaterielById($id)
		{
			$this->unModele->deleteMaterielById($id);
		}
		
	}

?>