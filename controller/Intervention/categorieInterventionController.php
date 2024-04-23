<?php
require_once("../../model/Intervention/categorieInterventionModel.php");
class ControllerCategorieIntervention
{
   private $unModele;
   public function __construct($bdd)
   {

      //instanciation de la classe Modele
      $this->unModele = new CategorieIntervention($bdd);
   }
   /********************** Gestion de la promotion ***********/
   public function ajouterCategorieIntervention($POST)
   {
      //controler les données avant insertion dans la table promotion

      //on appelle la méthode du Modele
      $this->unModele->ajouterCategorieIntervention($POST["date_debut"], $POST["date_fin"], $POST["status"], $POST["description"], $POST["id_technicien"], $POST["id_categorie_intervention"]);
   }
   public function allCategorieIntervention()
   {
      return $this->unModele->allCategorieIntervention();
      //on realise des controles
   }
   function selectCategorieInterventionByUserId($id)
   {
      return $this->unModele->selectCategorieInterventionById($id);
   }
   public function selectCategorieInterventionById($id)
   {
      $lesInterventions = $this->unModele->selectCategorieInterventionById($id);
      //on realise des controles
      return $lesInterventions;
   }
   public function selectTypeLikeIntervention($mot)
   {
      $lesInterventions = $this->unModele->selectLikeCategorieIntervention($mot);
      //on realise des controles
      return $lesInterventions;
   }

   public function updateCategorieIntervention($Intervention)
   {
      $this->unModele->updateCategorieIntervention($Intervention);
   }

   public function deleteCategorieInterventionById($id)
   {
      $this->unModele->deleteCategorieInterventionById($id);
   }
}
