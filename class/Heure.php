<?php

class Heure implements Databasable {

    public $id_heure;
    public $heure;

    public function __construct($id_heure = null, $heure = null) {
        $this->id_heure = $id_heure;
        $this->heure = $heure;
    }

    public function charger() {
        if (!$this->id_heure) {  // si pas d'id, retourne false
            return false;
        }
        $req = "SELECT * FROM heure WHERE id_heure = {$this->id_heure}";
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_heure) {
            $req = "UPDATE heure SET id_heure = {$this->id_heure},heure = {$cnx->esc($this->heure)} WHERE id_heure = {$this->id_heure}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO heure VALUES(DEFAULT, {$cnx->esc($this->heure)})";
            $this->id_heure = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_heure) {
            return false;
        }
        $req = "DELETE FROM heure WHERE id_heure = {$this->id_heure}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();  // execute la requete
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {
        $req = "SELECT * FROM heure WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public static function tous() {
        return Heure::tab(1, 'heure');
    }

}
