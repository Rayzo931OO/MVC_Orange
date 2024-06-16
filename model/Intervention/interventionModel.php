<?php

class Intervention
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterInterventionAdmin($id_client,$date_inter, $status, $description, $id_materiel, $id_technicien)
    {

        $req = $this->bdd->prepare("select create_intervention( :date_inter, :status, :description, :id_technicien, :id_materiel, :id_utilisateur);");
        $req->bindParam(':id_utilisateur', $id_client);
        $req->bindParam(':date_inter', $date_inter);
        $req->bindParam(':status', $status);
        $req->bindParam(':description', $description);
        $req->bindParam(':id_materiel', $id_materiel);
        $req->bindParam(':id_technicien', $id_technicien);

        return $req->execute();
    }
    public function ajouterInterventionClient($id_client,$description, $id_materiel)
    {
        $date_inter = null;
        $status = "En cours";
        $id_technicien = null;

        $req = $this->bdd->prepare("select create_intervention( :date_inter, :status, :description, :id_technicien, :id_materiel, :id_utilisateur);");
        $req->bindParam(':id_utilisateur', $id_client);
        $req->bindParam(':date_inter', $date_inter);
        $req->bindParam(':status', $status);
        $req->bindParam(':description', $description);
        $req->bindParam(':id_materiel', $id_materiel);
        $req->bindParam(':id_technicien', $id_technicien);
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
		$req = $this->bdd->prepare("SELECT * from intervention where id_client= :id_client;");
		$req->bindParam(':id_client', $id);
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
    function selectInterventionNonAssigner()
	{
		//ecriture de la requete
		$req = $this->bdd->prepare("SELECT * from intervention where id_technicien IS NULL;");
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
        $req = $this->bdd->prepare("SELECT * from intervention where date_inter like :date_inter");
        $req->bindParam(':date_inter', $mot);
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
    function selectInterventionByAlphaOrderASC()
    {
        $req = $this->bdd->prepare("SELECT * FROM intervention ORDER BY name ASC;");
        $req->execute();
        return $req->fetchAll();

    }

    function updateInterventionTechnicien($intervention)
    {
        $dateTimeDebut = new DateTime($intervention['date_inter']);
        $dateTimeDebutFormated = $dateTimeDebut->format("Y-m-d H:i:s");

        try {
			$req = $this->bdd->prepare("UPDATE intervention set date_inter= :date_inter, status= :status where id_intervention= :id_intervention;");
            $req->bindParam(':date_inter', $dateTimeDebutFormated);
            $req->bindParam(':status', $intervention['status']);
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
    function updateInterventionAdmin($intervention)
    {
        $dateInter = new DateTime($intervention['date_inter']);
        $dateInterFormated = $dateInter->format("Y-m-d H:i:s");

        if ($intervention['id_materiel'] == "") {
            $intervention['id_materiel'] = null;
        }
        if ($intervention['id_logiciel'] == "") {
            $intervention['id_logiciel'] = null;
        }

        try {
			$req = $this->bdd->prepare("UPDATE intervention set date_inter= :date_inter, status= :status, description= :description, id_materiel= :id_materiel, id_technicien= :id_technicien where id_intervention= :id_intervention;");
            $req->bindParam(':date_inter', $dateInterFormated);
            $req->bindParam(':status', $intervention['status']);
            $req->bindParam(':id_materiel', $intervention['id_materiel']);
            $req->bindParam(':description', $intervention['description']);
            $req->bindParam(':id_technicien', $intervention['id_technicien']);
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
    function assignerTechnicienAIntervention($id_intervention, $id_technicien)
    {
        $req = $this->bdd->prepare("UPDATE intervention SET id_technicien = :id_technicien WHERE id_intervention = :id_intervention");
        $req->bindParam(':id_technicien', $id_technicien);
        $req->bindParam(':id_intervention', $id_intervention);
        $req->execute();
    }

}