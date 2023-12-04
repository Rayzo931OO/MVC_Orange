<?php

class Intervention
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterIntervention($date_debut, $date_fin, $status, $description, $id_technicien, $id_type_intervention)
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

    public function allIntervention()
    {
        //ecriture de la requete
        $requete = "select * from intervention_view;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        $res = $req->fetchAll();
    }

    function selectInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetch();
    }

    function selectLikeIntervention($mot)
    {
        $req = $this->bdd->prepare("SELECT * from intervention where type_intervervention like :type_intervervention or date_debut like :date_debut or status like :status");
        $req->bindParam(':type_intervention', $mot);
        $req->bindParam(':date_debut', $mot);
        $req->bindParam(':status', $mot);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetchAll();

    }

    function updateIntervention($intervention)
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
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetchAll();
    }

    function deleteInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetch();
    }

}