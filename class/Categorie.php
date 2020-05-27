<?php

class Categorie implements Databasable {

    public $id_categorie;
    public $nom;

    public function __construct($id_categorie = null, $nom = null) {
        $this->id_categorie = $id_categorie;
        $this->nom = $nom;
    }

    public function charger() {
        if (!$this->id_categorie) {
            return false;
        }
        $req = "SELECT * FROM categorie WHERE id_categorie = {$this->id_categorie}";
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_categorie) {
            $req = "UPDATE categorie SET nom = {$cnx->esc($this->nom)} WHERE id_categorie = {$this->id_categorie}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO categorie VALUES(DEFAULT,{$cnx->esc($this->nom)})";
            $this->id_categorie = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_categorie) {
            return false;
        }
        $req = " DELETE FROM categorie WHERE id_categorie = {$this->id_categorie}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {
        $req = "SELECT * FROM categorie WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public function getTabProduit() {
        return Produit::tab("id_categorie = {$this->id_categorie}", 'nom');
    }

    public static function tous() {
        return Categorie::tab(1, 'nom');
    }

}
