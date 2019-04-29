<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reclamation {

    private $idRec;
    private $dateReclamation;
    private $description;
    private $sujet;
    private $etat;
    private $nom;
    private $prenom;
    private $mail;
    private $fileUrl;
    
    function getFileUrl() {
        return $this->fileUrl;
    }

    function setFileUrl($fileUrl) {
        $this->fileUrl = $fileUrl;
    }

    function __construct($idRec = NULL, $nom=NULL, $prenom=NULL, $mail=NULL, $sujet=NULL, $description=NULL, $dateReclamation=NULL, $etat=NULL, $fileUrl=NULL) {
        $this->idRec = $idRec;
        $this->dateReclamation = $dateReclamation;
        $this->description = $description;
        $this->sujet = $sujet;
        $this->etat = $etat;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->fileUrl = $fileUrl;
    }

        public static function findById($id) {
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM reclamations WHERE idRec=".$id);
        foreach ($req->fetchAll() as $temp) {
            $reclamation = new Reclamation($temp['idRec'], $temp['nom'], $temp['prenom'], $temp['mail'], $temp['sujet'], $temp['description'], $temp['dateReclamation'], $temp['etat'],$temp['file_url']);
            $list[] = $reclamation;
        }
        return $list;
    }

    function getIdRec() {
        return $this->idRec;
    }

    function getDateReclamation() {
        return $this->dateReclamation;
    }

    function getDescription() {
        return $this->description;
    }

    function getSujet() {
        return $this->sujet;
    }

    function getEtat() {
        return $this->etat;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getMail() {
        return $this->mail;
    }

    function setIdRec($idRec) {
        $this->idRec = $idRec;
    }

    function setDateReclamation($dateReclamation) {
        $this->dateReclamation = $dateReclamation;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    public function addReclamation($reclamation) {
        $db = Db::getInstance();
        $req = "INSERT INTO reclamations(nom,prenom,mail,sujet,description,dateReclamation,etat) 
        VALUES ('" . $reclamation->getNom() . "','" . $reclamation->getPrenom() .
                "','" . $reclamation->getMail() . "','" .
                $reclamation->getSujet() . "','" . $reclamation->getDescription() . "','" . $reclamation->getDateReclamation() . "','" . $reclamation->getEtat() . "')";
        $db->query($req);
    }

    public static function removeReclamation($id) {
        $db = Db::getInstance();
        $req = $db->query("DELETE from reclamations where idRec=" . $id);
    }
    public static function removeReclamationByMail($id) {
        $db = Db::getInstance();
        $req = $db->query("DELETE from reclamations where mail='".$id."' ");
    }

    public static function removeAllReclamations() {
        $db = Db::getInstance();
        $req = $db->query("DELETE ALL from reclamations");
    }

    public static function updateState($id) {
        $db = Db::getInstance();
        $req = $db->query("UPDATE reclamations set etat='lu' where idRec=" . $id);
    }

    public function displayReclamation() {
        $list = [];
        $req = "SELECT * from reclamations";
        $resultat = $this->db->query($req);
//        foreach ($resultat->fetchAll() as $reclamation) {
//            $list = new Reclamation($reclamation['idRec'], $reclamation['dateRecalamation'], ['description'], ['sujet'], ['etat'], ['nom'], ['prenom'], ['mail']);
//        }
        return $resultat->fetchAll();
    }

//    public static function all() {
//        $list=[];
//        $db= Db::getInstance();
//        $req=$db->query("SELECT reclamations.idRec,reclamations.dateReclamation,reclamations.description,reclamations.sujet,reclamations.etat,reclamations.nom,reclamations.prenom,reclamations.mail,clients.idC from reclamations INNER JOIN clients ON reclamations.mail=clients.mail ORDER BY dateReclamation DESC");
//        foreach ($req->fetchAll() as $temp){
//            $reclamation = new Reclamation($temp['idRec'],$temp['nom'],$temp['prenom'],$temp['mail'],$temp['sujet'],$temp['description'],$temp['dateReclamation'],$temp['etat']);
//            $reclamation->id_client=$temp['idC'];
//            $list[]=$reclamation;
//        }
//        return $list;
//        
//    }
    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * from reclamations ORDER by dateReclamation DESC");
        foreach ($req->fetchAll() as $temp) {
            $reclamation = new Reclamation($temp['idRec'], $temp['nom'], $temp['prenom'], $temp['mail'], $temp['sujet'], $temp['description'], $temp['dateReclamation'], $temp['etat'],$temp['file_url']);
            $list[] = $reclamation;
        }
        return $list;
    }

    public static function allByDateDesc() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * from reclamations ORDER by dateReclamation");
        foreach ($req->fetchAll() as $temp) {
            $reclamation = new Reclamation($temp['idRec'], $temp['nom'], $temp['prenom'], $temp['mail'], $temp['sujet'], $temp['description'], $temp['dateReclamation'], $temp['etat'],$temp['file_url']);
            $list[] = $reclamation;
        }
        return $list;
    }

    public function countReclamations() {
        $req = "SELECT count(*) from reclamations";
        $resultat = $this->db->query($req);
        return $resultat;
    }

    public function getNameRecByID($id) {
        $req = "SELECT nom from reclamations where idRec=" . $id;
        $resultat = $this->db->query($req);
        return $resultat;
    }

    public function getSurnameRecByID($id) {
        $req = "SELECT prenom from reclamations where idRec=" . $id;
        $resultat = $this->db->query($req);
        return $resultat;
    }

    public function getDateRecByID($id) {
        $req = "SELECT dateReclamation from reclamations where idRec=" . $id;
        $resultat = $this->db->query($req);
        return $resultat;
    }

    public function getSubjectRecByID($id) {
        $req = "SELECT sujet from reclamations where idRec=" . $id;
        $resultat = $this->db->query($req);
        return $resultat;
    }

    public function getDescriptionRecByID($id) {
        $req = "SELECT description from reclamations where idRec=" . $id;
        $resultat = $this->db->query($req);
        return $resultat;
    }

    public static function findNavBar($s) {
        $db = Db::getInstance();
        $s1 = strtolower($s);
        $req = $db->prepare("SELECT * FROM reclamations WHERE LOWER (nom) like '%" . $s1 . "%' or LOWER (description) like '%" . $s1 . "%' or LOWER (prenom) like '%" . $s1 . "%' or LOWER (mail) like '%" . $s1 . "%' or LOWER (sujet) like '%" . $s1 . "%'");
        $req->execute();
        $list = [];
        foreach ($req->fetchAll() as $temp) {
            $reclamation = new Reclamation($temp['idRec'], $temp['nom'], $temp['prenom'], $temp['mail'], $temp['sujet'], $temp['description'], $temp['dateReclamation'], $temp['etat']);
            $list[] = $reclamation;
        }
        return $list;
    }

    public function getIDClientByRec() {
        $db = Db::getInstance();
        $m = $this->mail;
        $req = $db->query("SELECT clients.idC from clients INNER JOIN reclamations ON reclamations.mail=clients.mail WHERE reclamations.mail='" . $m . "'");
        foreach ($req->fetchAll() as $temp) {
            if ($temp['idC'] != "") {
                $s = $temp['idC'];
                return $s;
            }
        }
        
    }

}
