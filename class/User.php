<?php

class User implements Databasable {

    public $id_user;
    public $id_niveau;
    public $log;
    public $mdp;
    public $nom;
    public $prenom;
    public $email;
    public $date_naissance;

    public function __construct($id_user = null, $id_niveau = null, $log = null, $mdp = null, $nom = null, $prenom = null, $email = null, $date_naissance = null) {
        $this->id_user = $id_user;
        $this->id_niveau = $id_niveau;
        $this->log = $log;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->date_naissance = $date_naissance;
    }

    public function charger() {
        if (!$this->id_user) {
            return false;
        }
        $req = "SELECT * FROM user WHERE id_user={$this->id_user}";
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_user) {
            $req = "UPDATE user SET log = {$cnx->esc($this->log)}, mdp = {$cnx->esc($this->mdp)}, nom = {$cnx->esc($this->nom)}, prenom = {$cnx->esc($this->prenom)}, tel = {$cnx->esc($this->tel)}, date_naissance = {$cnx->esc($this->date_naissance)}, email ={$cnx->esc($this->email)} WHERE id_user = {$this->id_user}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO user VALUES(DEFAULT,1, {$cnx->esc($this->log)}, {$cnx->esc($this->mdp)}, {$cnx->esc($this->nom)}, {$cnx->esc($this->prenom)}, {$cnx->esc($this->tel)}, {$cnx->esc($this->date_naissance)}, {$cnx->esc($this->email)})";
            $this->id_user = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_user)
            return false;
        $req = "DELETE FROM user WHERE id_user = {$this->id_user}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {
        $req = "SELECT * FROM user WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public function login() {
        $_SESSION['id_user'] = null;
        if (!($this->log || $this->mdp))
            return false;
        $mdp = $this->mdp;
        $cnx = Connexion::getInstance();
        $req = "SELECT * FROM user WHERE log={$cnx->esc($this->log)}";
        if (!$cnx->xeq($req)->ins($this))
            return false;
        //if (!password_verify($mdp, $this->mdp))
        //	return false;
        $_SESSION['id_user'] = $this->id_user;
        return true;
    }

    public static function getUserSession() {
        if (empty($_SESSION['id_user']))
            return null;
        $user = new User($_SESSION['id_user']);
        return $user->charger() ? $user : null;
    }

}
