<?php

class technicien{
    private $bdd ; 

    public function __construct($bdd){
        $this->bdd = $bdd;
    }

    public function allTechnicien(){
        $req = "select * from technicien" ; 
        $req->execute();
        return $req->fetchAll();
    }
}
    

?>