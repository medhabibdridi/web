<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Newsletter {

    private $idNews;
    private $texte;
    private $idProd;

    function __construct() {
        
    }

    function getIdNews() {
        return $this->idNews;
    }

    function getTexte() {
        return $this->texte;
    }

    function getIdProd() {
        return $this->idProd;
    }

    function setIdNews($idNews) {
        $this->idNews = $idNews;
    }

    function setTexte($texte) {
        $this->texte = $texte;
    }

    function setIdProd($idProd) {
        $this->idProd = $idProd;
    }

    public static function findClientsSubscribed() {
        $array=[];
        $db = Db::getInstance();
        $req = $db->query("SELECT * from clients WHERE subnews='yes'");
        foreach ($req->fetchAll() as $temp) {
            $array []= $temp['mail'];
        }
        return $array;
    }

    public function addNewsLetter() {
        $db = Db::getInstance();
        $req = $db->query("INSERT INTO newsletter(texte,idProd) VALUES('" . $this->texte . "','" . $this->idProd . "')");
    }

}
