<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class reponseReclamation {

    private $idRep;
    private $sujet;
    private $description;
    private $mailRec;

    function getMailRec() {
        return $this->mailRec;
    }

    function setMailRec($mailRec) {
        $this->mailRec = $mailRec;
    }

    function getIdRep() {
        return $this->idRep;
    }

    function getSujet() {
        return $this->sujet;
    }

    function getDescription() {
        return $this->description;
    }

    function setIdRep($idRep) {
        $this->idRep = $idRep;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function __construct($sujet, $description, $mailRec) {
        $this->sujet = $sujet;
        $this->description = $description;
        $this->mailRec = $mailRec;
    }

    public function addRepRec() {
        $db = Db::getInstance();
        $req = "INSERT INTO reponsereclamations(sujet,description,mailRec) VALUES ('" . $this->sujet . "','" . $this->description . "','" . $this->mailRec . "')";
        $db->query($req);
    }
    public static function findInClients($m){
        $db= Db::getInstance();
        $req=("SELECT * from clients WHERE mail='".$m."' ");
        $resultat=$db->query($req);
        
        return $resultat->fetchAll();
        
    }

}
