<?php

class Kid implements Databasable {

    public $id_kid;
    public $nom;
    public $prenom;
    public $date_naissance;
    public $taille_tenue;
    public $date_stage;
    public $prix;

    public function __construct($id_kid = null, $nom = null, $prenom = null, $date_naissance = null, $taille_tenue = null, $date_stage = null, $prix = null) {
        $this->id_kid = $id_kid;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->taille_tenue = $taille_tenue;
        $this->date_stage = $date_stage;
        $this->prix = $prix;
    }

    public function charger() {
        if (!$this->id_kid) {  // si pas d'id, retourne false
            return false;
        }
        $req = "SELECT * FROM kid WHERE id_kid = {$this->id_kid}";  // $this = kid
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_kid) {
            $req = "UPDATE kid SET id_kid = {$this->id_kid}, nom = {$cnx->esc($this->nom)}, prenom = {$cnx->esc($this->prenom)}, date_naissance = {$cnx->esc($this->date_naissance)}, taille_tenue = {$cnx->esc($this->taille_tenues)},date_stage = {$cnx->esc($this->date_stage)},prix = {$this->prix} WHERE id_kid = {$this->id_kid}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO kid VALUES(DEFAULT, {$cnx->esc($this->nom)}, {$cnx->esc($this->prenom)}, {$cnx->esc($this->date_naissance)}, {$cnx->esc($this->taille_tenue)},{$cnx->esc($this->date_stage)}, {$this->prix})";
            $this->id_kid = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_kid) { // si pas de kid dans id_kid return false
            return false;
        }
        $req = "DELETE FROM kid WHERE id_kid = {$this->id_kid}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();  // execute la requete
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {

        $req = "SELECT * FROM kid WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public function sauverIdKid() {
        $cnx = Connexion::getInstance();
        $req = "INSERT INTO lignecommande VALUES(DEFAULT,DEFAULT,{$this->id_kid},DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
        $this->id_kid = $cnx->xeq($req)->pk();
    }

    public static function tousStage() {
        return Kid::tab(1, 'date_stage');
    }

    public static function tousPrix() {
        return Kid::tab(1, 'prix');
    }

    public static function lundi() {

        $tab = [];
        for ($i = 0; $i < Cfg::LUNDI; $i++) {
            $jours = new stdClass();
            $jours->u = strtotime("2020-07-01 + {$i} week"); //La fonction strtotime() essaye de lire une date au format anglais fournie par le paramètre time, et de la transformer en timestamp Unix (le nombre de secondes depuis le 1er Janvier 1970 à 00:00:00 UTC), relativement au timestamp now, ou à la date courante si ce dernier est omis.
            $jours->a = date('Y', $jours->u);
            $jours->m = date('m', $jours->u);
            $jours->j = date('d', $jours->u);
            $tab[] = $jours;
        }
        return $tab;
    }

    public static function dispos($unix) {
        return Cfg::DISPO_MAX - count(Kid::tab("date_stage='" . date('Y-m-d', $unix) . "'"));  // dispo visite
    }

}
