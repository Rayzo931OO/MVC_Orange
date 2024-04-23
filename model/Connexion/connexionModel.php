<?php
class ConnexionModele
{
   private $unPDO; //objet de la classe PDO : PHP DATA OBJECT

   public function __construct()
   {
      $url = "mysql:host=172.20.0.142:3307;dbname=mvc_orange;charset=utf8mb4";
      $user = "admin";
      $mdp = "groupe4123";
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
