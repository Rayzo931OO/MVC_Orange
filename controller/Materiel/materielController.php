<?php
	require_once (BASE_PATH."/model/Materiel/materielModel.php");
	class ControllerMateriel {
		private $unModele ;
		public function __construct ($bdd){

			//instanciation de la classe Modele
			$this->unModele = new Materiel($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public function ajouterMateriel($POST) {
			//controler les données avant insertion dans la table promotion

			//on appelle la méthode du Modele
			$this->unModele->ajouterMateriel($POST["nom"], $POST["description"], $POST["id_categorie"]);
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