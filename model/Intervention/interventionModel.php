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
		$requete = "select * from intervention;";
		$req = $this->bdd->prepare($requete);
		$req->execute();
		$res = $req->fetchAll();
	}

}