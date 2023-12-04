<?php

class Logiciel
{
    private $bdd;
    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterLogiciel($nom, $description, $version)
	{
		$req = $this->bdd->prepare("INSERT INTO logiciel (nom, description, version) VALUES (:nom, :description, :version)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':description', $description);
		$req->bindParam(':version', $version);

		return $req->execute();
	}

    public function allLogiciel()
    {
        //ecriture de la requete
        $requete = "select * from logiciel;";
        $req = $this->bdd->prepare($requete);
        $req->execute();
        $res = $req->fetchAll();
    }

    function selectLogicielById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from logiciel where id_logiciel= :id_logiciel;");
        $req->bindParam(':id_logiciel', $id);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetch();
    }

    function selectLogicielByCategorie($categorie)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("SELECT * from jonction_logiciel_categorie where id_categorie= :id_categorie;");
        $req->bindParam(':id_categorie', $categorie);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetchAll();
    }

    function selectLikeLogiciel($mot)
    {
        $req = $this->bdd->prepare("SELECT * from logiciel where  nom like :nom or description like :description or version like :version");
        $req->bindParam(':nom', $mot);
        $req->bindParam(':description', $mot);
        $req->bindParam(':version', $mot);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetchAll();

    }

    function updateLogiciel($logiciel)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("UPDATE logiciel set nom= :nom, description= :description, version= :version where id_logiciel= :id_logiciel;");
        $req->bindParam(':nom', $logiciel['nom']);
        $req->bindParam(':description', $logiciel['description']);
        $req->bindParam(':version', $logiciel['version']);
        $req->bindParam(':id_logiciel', $logiciel['id_logiciel']);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetchAll();
    }

    function deleteLogicielById($id)
    {
        //ecriture de la requete
        $req = $this->bdd->prepare("DELETE from logiciel where id_logiciel= :id_logiciel;");
        $req->bindParam(':id_logiciel', $id);
        $req = $this->bdd->prepare($req);
        $req->execute();
        $res = $req->fetch();
    }

}