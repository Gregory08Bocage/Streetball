<?php

class Terrain implements Databasable {

    public $id_terrain;
    public $nom_terrain;

    public function __construct($id_terrain = null, $nom_terrain = null) {
        $this->id_terrain = $id_terrain;
        $this->nom_terrain = $nom_terrain;
    }

    public function charger() {
        if (!$this->id_terrain) {  // si pas d'id, retourne false
            return false;
        }
        $req = "SELECT * FROM terrain WHERE id_terrain = {$this->id_terrain}";
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_terrain) {
            $req = "UPDATE terrain SET id_terrain = {$this->id_terrain}, nom_terrain = {$cnx->esc($this->nom_terrain)} WHERE id_terrain = {$this->id_terrain}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO terrain VALUES(DEFAULT, {$cnx->esc($this->nom_terrain)})";
            $this->id_terrain = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_terrain) {
            return false;
        }
        $req = "DELETE FROM terrain WHERE id_terrain = {$this->id_terrain}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();  // execute la requete
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {

        $req = "SELECT * FROM terrain WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public static function tous() {
        return Terrain::tab(1, 'id_terrain');
    }

}
