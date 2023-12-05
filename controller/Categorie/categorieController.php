<?php
	require_once ("model/Categorie/categorieModel.php"); 
    require_once ("bdd/bdd.php"); 
	class ControleurCategorie {
		private $unModele ;
		public function __construct ($bdd){

			//instanciation de la classe Modele 
			$this->unModele = new Categorie($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public function ajouterCategorie($nom, $description, $type_description) {
			//controler les données avant insertion dans la table promotion 

			//on appelle la méthode du Modele 
			$this->unModele->ajouterCategorie($nom, $description, $type_description); 
		}
		public function allCategorie() {
			$lesCategories = $this->unModele->allCategorie(); 
			//on realise des controles 

			return $lesCategories ;
		}

        public function selectCategorieById($id) {
			$lesCategories = $this->unModele->selectCategorieById($id); 
			//on realise des controles 
			return $lesCategories ;
		}
		public function selectLikeCategorie ($mot) {
			$lesCategories = $this->unModele->selectLikeCategorie($mot); 
			//on realise des controles 
			return $lesCategories ;
		}

		public function updateCategorie($categorie)
		{
			$this->unModele->updateCategorie($categorie);
		}

        public function deleteCategorieById($id)
		{
			$this->unModele->deleteCategorieById($id);
		}
		
	}

?>