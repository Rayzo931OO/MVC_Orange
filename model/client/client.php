<?php

class client{
    private $bdd ; 

    public function __construct($bdd){
        $this->bdd = $bdd;
    }

    public function allClient(){
        $req = "select * from client" ; 
        $req->execute();
        return $req->fetchAll();
    }

}
    
