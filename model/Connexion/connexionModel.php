<?php
class ConnexionModele
{
   private $unPDO; //objet de la classe PDO : PHP DATA OBJECT

   public function __construct()
   {
      $url = "mysql:host=localhost:3306;dbname=mvc_orange;charset=utf8mb4";
      $user = "root";
      $mdp = "";
      try {
         $this->unPDO = new PDO($url, $user, $mdp);
      } catch (PDOException $exp) {
         echo "Erreur Connexion :" . $exp->getMessage();
      }
   }
   public function verifConnexion ($email, $mdp)
   {
      $requete ="select * from user where email= :email and mot_de_passe= :mdp ;";
      $donnees=array(":email"=>$email, ":mdp"=>$mdp);
      $select = $this->unPDO->prepare($requete);
      $select->execute ($donnees);
      return $select->fetch ();
   }
   public function getPDO()
   {
      return $this->unPDO;
   }
}
