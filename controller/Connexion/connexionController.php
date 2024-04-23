<?php
	require_once (BASE_PATH."../../model/Connexion/connexionModel.php");
	class ControllerConnexion {
		private $unModele ;
		public function __construct (){

			//instanciation de la classe Modele
			$this->unModele = new ConnexionModele();
		}
		/********************** Gestion de la promotion ***********/
		public function verifConnexion($email, $mdp){
			//controler les données avant insertion dans la table promotion

			//on appelle la méthode du Modele
         return $this->unModele->verifConnexion($email, $mdp);
		}
      public function getPDO()
      {
         return $this->unModele->getPDO();
      }

	}

?>