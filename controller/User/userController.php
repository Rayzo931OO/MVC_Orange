<?php
	require_once ("model/User/UserModel.php"); 
    require_once ("bdd/bdd.php"); 
	class ControleurUser {
		private $unModele ;
		public function __construct ($bdd){

			//instanciation de la classe Modele 
			$this->unModele = new User($bdd);
		}
		/********************** Gestion de la promotion ***********/
		public public function ajouterUser($nom, $prenom, $email, $code_postal, $adresse, $telephone, $mot_de_passe){
			//controler les données avant insertion dans la table promotion 

			//on appelle la méthode du Modele 
			$this->unModele->ajouterUser($nom, $prenom, $email, $code_postal, $adresse, $telephone, $mot_de_passe); 
		}
		public function allClient() {
			$lesUsers = $this->unModele->allClient(); 
			//on realise des controles 

			return $lesUsers ;
		}

        public function allTechniciens() {
			$lesUsers = $this->unModele->allTechniciens(); 
			//on realise des controles 

			return $lesUsers ;
		}

        public function allAdmin() {
			$lesUsers = $this->unModele->allAdmin(); 
			//on realise des controles 

			return $lesUsers ;
		}

        public function selectUserById($id) {
			$lesUsers = $this->unModele->selectUserById($id); 
			//on realise des controles 
			return $lesUsers ;
		}

        public function selectWhereUser($email, $password) {
			$lesUsers = $this->unModele->selectWhereUser($email, $password); 
			//on realise des controles 
			return $lesUsers ;
		}
		public function selectLikeUser($mot, $role) {
			$lesUsers = $this->unModele->selectLikeUser($mot, $role); 
			//on realise des controles 
			return $lesUsers ;
		}

		public function updateUser($user, $avatar)
		{
			$this->unModele->updateUser($user, $avatar);
		}

        public function deleteUserById($id)
		{
			$this->unModele->deleteUserById($id);
		}
		
	}

?>