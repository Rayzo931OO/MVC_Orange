<?php
require_once(BASE_PATH . "/model/Intervention/typeInterventionModel.php");
class ControllerTypeIntervention
{
   private $unModele;
   public function __construct($bdd)
   {

      //instanciation de la classe Modele
      $this->unModele = new TypeIntervention($bdd);
   }
   /********************** Gestion de la promotion ***********/
   public function ajouterTypeIntervention($POST)
   {
      //controler les données avant insertion dans la table promotion

      //on appelle la méthode du Modele
      $this->unModele->ajouterTypeIntervention($POST["date_debut"], $POST["date_fin"], $POST["status"], $POST["description"], $POST["id_technicien"], $POST["id_type_intervention"]);
   }
   public function allTypeIntervention()
   {
      return $this->unModele->allTypeIntervention();
      //on realise des controles
   }
   function selectTypeInterventionByUserId($id)
   {
      return $this->unModele->selectTypeInterventionById($id);
   }
   public function selectTypeInterventionById($id)
   {
      $lesInterventions = $this->unModele->selectTypeInterventionById($id);
      //on realise des controles
      return $lesInterventions;
   }
   public function selectTypeLikeIntervention($mot)
   {
      $lesInterventions = $this->unModele->selectLikeTypeIntervention($mot);
      //on realise des controles
      return $lesInterventions;
   }

   public function updateTypeIntervention($Intervention)
   {
      $this->unModele->updateTypeIntervention($Intervention);
   }

   public function deleteTypeInterventionById($id)
   {
      $this->unModele->deleteTypeInterventionById($id);
   }
}
