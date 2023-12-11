<?php

class TypeIntervention
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterTypeIntervention($date_debut, $date_fin, $status, $description, $id_technicien, $id_type_intervention)
    {
        $req = $this->bdd->prepare("select create_intervention( :date_debut, :date_fin, :status, :description, :id_technicien, :id_type_intervention);");
        $req->bindParam(':date_debut', $date_debut);
        $req->bindParam(':date_fin', $date_fin);
        $req->bindParam(':status', $status);
        $req->bindParam(':description', $description);
        $req->bindParam(':id_technicien', $id_technicien);
        $req->bindParam(':id_type_intervention', $id_type_intervention);

        return $req->execute();
    }

    public function allTypeIntervention()
    {
        //ecriture de la requete
        $requete = "select * from type_intervention_view;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        return $req->fetchAll();
    }

    function selectTypeInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req->execute();
        return $req->fetch();
    }

    function selectLikeTypeIntervention($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from type_intervervention where nom like :nom or description like :description");
        $req->bindParam(':nom', $mot);
        $req->bindParam(':description', $mot);
        $req->execute();
        return $req->fetchAll();

    }

    function updateTypeIntervention($intervention)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("UPDATE intervention set date_debut= :date_debut, date_fin= :date_fin, status= :status, description= :description, id_technicien= :id_technicien, id_type_intervention= :id_type_intervention where id_intervention= :id_intervention;");
        $req->bindParam(':date_debut', $intervention['date_debut']);
        $req->bindParam(':date_fin', $intervention['date_fin']);
        $req->bindParam(':status', $intervention['status']);
        $req->bindParam(':description', $intervention['description']);
        $req->bindParam(':id_technicien', $intervention['id_technicien']);
        $req->bindParam(':id_type_intervention', $intervention['id_type_intervention']);
        $req->bindParam(':id_intervention', $intervention['id_intervention']);
        $req->execute();
        return $req->fetchAll();
    }

    function deleteTypeInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req->execute();
        return $req->fetch();
    }

}