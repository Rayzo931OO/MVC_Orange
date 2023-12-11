<?php

class Intervention
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterIntervention($date_debut, $date_fin, $status, $description, $id_technicien, $id_materiel,$id_logiciel,  $id_type_intervention)
    {

        $req = $this->bdd->prepare("select create_intervention( :date_debut, :date_fin, :status, :description, :id_technicien, :id_logiciel, :id_materiel, :id_type_intervention);");
        $req->bindParam(':date_debut', $date_debut);
        $req->bindParam(':date_fin', $date_fin);
        $req->bindParam(':status', $status);
        $req->bindParam(':description', $description);
        $req->bindParam(':id_technicien', $id_technicien);
        $req->bindParam(':id_logiciel', $id_logiciel);
        $req->bindParam(':id_materiel', $id_materiel);
        $req->bindParam(':id_type_intervention', $id_type_intervention);

        return $req->execute();
    }

    public function allIntervention()
    {
        //ecriture de la requete
        $requete = "select * from intervention_view;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        return $req->fetchAll();
    }
    function selectInterventionByUserId($id)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from intervention where id_utilisateur= :id_utilisateur;");
		$req->bindParam(':id_utilisateur', $id);
		$req->execute();
		return $req->fetchAll();
	}
    function selectInterventionByTechnicien($id)
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from intervention where id_technicien= :id_technicien;");
		$req->bindParam(':id_technicien', $id);
		$req->execute();
		return $req->fetchAll();
	}

    function selectInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req->execute();
        return $req->fetch();
    }

    function selectLikeInterventionDateDebut($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from intervention where date_debut like :date_debut");
        $req->bindParam(':date_debut', $mot);
        $req->execute();
        return $req->fetchAll();
    }
    function selectLikeInterventionDateFin($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from intervention where date_fin like :date_fin or status like :status");
        $req->bindParam(':date_fin', $mot);
        $req->execute();
        return $req->fetchAll();

    }
    function selectLikeInterventionStatus($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from intervention where status like :status or status like :status");
        $req->bindParam(':status', $mot);
        $req->execute();
        return $req->fetchAll();

    }

    function updateIntervention($intervention)
    {
        $dateTimeDebut = new DateTime($intervention['date_debut']);
        $dateTimeFin = new DateTime($intervention['date_fin']);
        $dateTimeDebutFormated = $dateTimeDebut->format("Y-m-d H:i:s");
        $dateTimeFinFormated = $dateTimeFin->format("Y-m-d H:i:s");

        if ($intervention['id_materiel'] == "") {
            $intervention['id_materiel'] = null;
        }
        if ($intervention['id_logiciel'] == "") {
            $intervention['id_logiciel'] = null;
        }

        try {
			$req = $this->bdd->prepare("UPDATE intervention set date_debut= :date_debut, date_fin= :date_fin, status= :status, description= :description, id_materiel= :id_materiel, id_logiciel= :id_logiciel, id_technicien= :id_technicien, id_type_intervention= :id_type_intervention where id_intervention= :id_intervention;");
            $req->bindParam(':date_debut', $dateTimeDebutFormated);
            $req->bindParam(':date_fin', $dateTimeFinFormated);
            $req->bindParam(':status', $intervention['status']);
            $req->bindParam(':id_materiel', $intervention['id_materiel']);
            $req->bindParam(':id_logiciel', $intervention['id_logiciel']);
            $req->bindParam(':description', $intervention['description']);
            $req->bindParam(':id_technicien', $intervention['id_technicien']);
            $req->bindParam(':id_type_intervention', $intervention['id_type_intervention']);
            $req->bindParam(':id_intervention', $intervention['id_intervention']);
			$req->execute();
			$result = $req->fetch();
			// var_dump($result); // Check how many rows were affected
			// var_dump($req->rowCount()); // Check how many rows were affected

			return $result; // Returns true if one or more rows were updated
	  } catch (PDOException $e) {
			error_log("Error in updateIntervention: " . $e->getMessage());
			var_dump("Error in updateIntervention: ".$e->getMessage());
			return false;
	  }
    }

    function deleteInterventionById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from intervention where id_intervention= :id_intervention;");
        $req->bindParam(':id_intervention', $id);
        $req->execute();
        return $req->fetch();
    }

}