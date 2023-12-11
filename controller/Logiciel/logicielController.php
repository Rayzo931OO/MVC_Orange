<?php
	require_once (BASE_PATH."/model/Logiciel/logicielModel.php");
	class ControllerLogiciel {
		private $unModele ;
		public function __construct ($bdd){

			//instanciation de la classe Modele
			$this->unModele = new Logiciel($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public function ajouterLogiciel($nom, $description, $version) {
			//controler les données avant insertion dans la table promotion

			//on appelle la méthode du Modele
			$this->unModele->ajouterLogiciel($nom, $description, $version);
		}
		public function allLogiciel() {
			$lesLogiciels = $this->unModele->allLogiciel();
			//on realise des controles

			return $lesLogiciels ;
		}

        public function selectLogicielById($id) {
			$lesLogiciels = $this->unModele->selectLogicielById($id);
			//on realise des controles
			return $lesLogiciels ;
		}
		public function selectLikeLogiciel ($mot) {
			$lesLogiciels = $this->unModele->selectLikeLogiciel($mot);
			//on realise des controles
			return $lesLogiciels ;
		}

		public function updateLogiciel($Logiciel)
		{
			$this->unModele->updateLogiciel($Logiciel);
		}

        public function deleteLogicielById($id)
		{
			$this->unModele->deleteLogicielById($id);
		}

	}

?>