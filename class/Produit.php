<?php

class Produit implements Databasable {

    public $id_produit;
    public $id_categorie;
    public $id_taille;
    public $nom;
    public $ref;
    public $prix;
    public $stock;

    public function __construct($id_produit = null, $id_categorie = null, $id_taille = null, $nom = null, $ref = null, $prix = null, $stock = null) {
        $this->id_produit = $id_produit;
        $this->id_categorie = $id_categorie;
        $this->id_taille = $id_taille;
        $this->nom = $nom;
        $this->ref = $ref;
        $this->prix = $prix;
        $this->stock = $stock;
    }

    public function charger() {
        if (!$this->id_produit) {
            return false;
        }
        $req = "SELECT * FROM produit WHERE id_produit = {$this->id_produit}";
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_produit) {
            $req = "UPDATE produit SET id_categorie = {$this->id_categorie}, id_taille = {$this->id_taille}, nom = {$cnx->esc($this->nom)}, ref = {$cnx->esc($this->ref)},prix = {$this->prix},stock = {$this->stock} WHERE id_produit = {$this->id_produit}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO produit VALUES(DEFAULT, {$this->id_categorie}, {$this->id_taille},{$cnx->esc($this->nom)},{$cnx->esc($this->ref)}, {$this->prix}, {$this->stock})";
            $this->id_produit = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_produit) {
            return false;
        }
        $req = " DELETE FROM produit WHERE id_produit = {$this->id_produit}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {
        $req = "SELECT * FROM produit WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public function getCategorie() {
        return (new Categorie($this->id_categorie))->charger();
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function refExiste() {
        $cnx = Connexion::getInstance();
        $id_produit = $this->id_produit ? $this->id_produit : 0;
        $req = "SELECT * FROM produit WHERE ref = {$cnx->esc($this->ref)} AND id_produit != {$id_produit}"; //modifie et ajoute un produit
        return (bool) $cnx->xeq($req)->prem(__CLASS__);
    }

    public static function tous() {
        return Produit::tab(1, 'nom');
    }

}
