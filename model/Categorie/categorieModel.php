<?php

class Categorie
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterCategorie($nom, $description)
	{
		$req = $this->bdd->prepare("INSERT INTO categorie (nom, description) VALUES (:nom, :description)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':description', $description);
		return $req->execute();
	}

    public function allCategorie()
    {
        //ecriture de la requete
        $requete = "select * from categorie;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        return $req->fetchAll();

    }

    function selectCategorieById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from categorie where id_categorie= :id_categorie;");
        $req->bindParam(':id_categorie', $id);
        $req->execute();
        return $req->fetch();
    }

    function selectLikeCategorie($mot)
    {
        $mot = "%" . $mot . "%";
        $req = $this->bdd->prepare("SELECT * from categorie where  nom like :nom or description like :description or type_description like :type_description");
        $req->bindParam(':nom', $mot);
        $req->bindParam(':description', $mot);
        $req->bindParam(':type_description', $mot);
        $req->execute();
        return $req->fetchAll();

    }

    function updateCategorie($categorie)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("UPDATE categorie set nom= :nom, description= :description where id_categorie= :id_categorie;");
        $req->bindParam(':nom', $categorie['nom']);
        $req->bindParam(':description', $categorie['description']);
        $req->bindParam(':id_categorie', $categorie['id_categorie']);
        $req->execute();
        return $req->fetchAll();
    }

    function deleteCategorieById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from categorie where id_categorie= :id_categorie;");
        $req->bindParam(':id_categorie', $id);
        $req->execute();
        return $req->fetch();
    }

}