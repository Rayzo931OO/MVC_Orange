<?php

class Materiel
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterMateriel($nom, $description)
	{
		$req = $this->bdd->prepare("INSERT INTO materiel (nom, description) VALUES (:nom, :description)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':description', $description);

		return $req->execute();
	}

    public function allMateriel()
    {
        //ecriture de la requete
        $requete = "select * from materiel;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        return $req->fetchAll();
    }

    function selectMaterielById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from materiel where id_materiel= :id_materiel;");
        $req->bindParam(':id_materiel', $id);
        $req = $this->bdd->prepare($req);
        $req->execute();
        return $req->fetch();
    }

    function selectMaterielByCategorie($categorie)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from jonction_materiel_categorie where id_categorie= :id_categorie;");
        $req->bindParam(':id_categorie', $categorie);
        $req = $this->bdd->prepare($req);
        $req->execute();
        return $req->fetchAll();
    }

    function selectLikeMateriel($mot)
    {
        $req = $this->bdd->prepare("SELECT * from materiel where  nom like :nom or description like :description");
        $req->bindParam(':nom', $mot);
        $req->bindParam(':description', $mot);
        $req = $this->bdd->prepare($req);
        $req->execute();
        return $req->fetchAll();

    }

    function updateMateriel($materiel)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("UPDATE materiel set nom= :nom, description= :description where id_materiel= :id_materiel;");
        $req->bindParam(':nom', $materiel['nom']);
        $req->bindParam(':description', $materiel['description']);
        $req->bindParam(':id_materiel', $materiel['id_materiel']);
        $req = $this->bdd->prepare($req);
        $req->execute();
        return $req->fetchAll();
    }

    function deleteMaterielById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from materiel where id_materiel= :id_materiel;");
        $req->bindParam(':id_materiel', $id);
        $req = $this->bdd->prepare($req);
        $req->execute();
        return $req->fetch();
    }

}