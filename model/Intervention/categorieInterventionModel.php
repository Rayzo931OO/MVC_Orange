<?php

class CategorieIntervention
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterCategorieIntervention($date_inter, $status, $description, $id_technicien, $id_categorie_intervention)
    {
        $req = $this->bdd->prepare("select create_intervention( :date_inter, :status, :description, :id_technicien, :id_categorie_intervention);");
        $req->bindParam(':date_inter', $date_inter);
        $req->bindParam(':status', $status);
        $req->bindParam(':description', $description);
        $req->bindParam(':id_technicien', $id_technicien);
        $req->bindParam(':id_categorie_intervention', $id_categorie_intervention);

        return $req->execute();
    }

    public function allCategorieIntervention()
    {
        //ecriture de la requete
        $requete = "select * from categorie_intervention_view;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        return $req->fetchAll();
    }

    function selectCategorieInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req->execute();
        return $req->fetch();
    }

    function selectLikeCategorieIntervention($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from type_intervervention where nom like :nom or description like :description");
        $req->bindParam(':nom', $mot);
        $req->bindParam(':description', $mot);
        $req->execute();
        return $req->fetchAll();

    }

    function updateCategorieIntervention($intervention)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("UPDATE intervention set date_inter= :date_inter, status= :status, description= :description, id_technicien= :id_technicien, id_categorie_intervention= :id_categorie_intervention where id_intervention= :id_intervention;");
        $req->bindParam(':date_inter', $intervention['date_inter']);
        $req->bindParam(':status', $intervention['status']);
        $req->bindParam(':description', $intervention['description']);
        $req->bindParam(':id_technicien', $intervention['id_technicien']);
        $req->bindParam(':id_categorie_intervention', $intervention['id_categorie_intervention']);
        $req->bindParam(':id_intervention', $intervention['id_intervention']);
        $req->execute();
        return $req->fetchAll();
    }

    function deleteCategorieInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req->execute();
        return $req->fetch();
    }

}