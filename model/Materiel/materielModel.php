<?php

class Materiel
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterMateriel($nom, $description, $id_categorie)
	{
		$req = $this->bdd->prepare("INSERT INTO materiel (nom, description, id_categorie) VALUES (:nom, :description, :id_categorie)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':description', $description);
		$req->bindParam(':id_categorie', $id_categorie);

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
        $req->execute();
        return $req->fetch();
    }

    function selectMaterielByCategorie($categorie)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from jonction_materiel_categorie where id_categorie= :id_categorie;");
        $req->bindParam(':id_categorie', $categorie);
        $req->execute();
        return $req->fetchAll();
    }

    function selectLikeMateriel($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from materiel where  nom like :nom or description like :description");
        $req->bindParam(':nom', $mot);
        $req->bindParam(':description', $mot);
        $req->execute();
        return $req->fetchAll();

    }

    function updateMateriel($materiel)
    {

        try {
            $req = $this->bdd->prepare("UPDATE materiel set nom= :nom, description= :description where id_materiel= :id_materiel;");
            $req->bindParam(':id_materiel', $materiel['id_materiel']);
            $req->bindParam(':nom', $materiel['nom']);
            $req->bindParam(':description', $materiel['description']);
            return $req->execute(); // return true si tout est ok sinon false
        } catch (Exception $e) {
            var_dump($e);
            return false;
        }
    }

    function deleteMaterielById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from materiel where id_materiel= :id_materiel;");
        $req->bindParam(':id_materiel', $id);
        $req->execute();
        return $req->fetch();
    }

}