<?php

class Connexion {

    private static $instance;      //(instance unique)
    private static $DSN;           //(DSN)
    private static $log;           //(identifiant utilisateur)
    private static $mdp;           //(mot de passe)
    private static $opt = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];           //(options de connexion)
    private $db;       //(instance de PDO)
    private $jeu;      //(recordset (jeu d'enregistrement) après une requête SELECT)
    private $nb;       //(nombre de lignes affectées par la dernière requête)

    private function __construct() {
        if (!self::$DSN) {
            exit(I18n::get('DB_ERR_DSN_UNDEFINED'));
        }
        try {
            $this->db = new PDO(self::$DSN, self::$log, self::$mdp, self::$opt);
        } catch (PDOException $e) {
            echo I18n::get('DB_ERR_CONNECTION_FAILED');
            exit(" : {$e->getMessage()}");
        }
    }

    public static function getInstance() { // getinstance pour créer nouvelle instance
        if (!self::$instance) {  //self raccourci classe Connexion (dans la meme classe) = Connexion $instance
            self::$instance = new Connexion (); //si pas de new connexion on l'a créé car on est dans la classe Connexion
        }
        return self::$instance;           // si deja créé une instance on la retourne
    }

    public static function setDSN($dbName, $log, $mdp, $host = 'localhost') {  // DSN = Data Source Name
        if (self::$DSN) {
            exit(I18n::get('DB_ERR_DSN_ALREADY_SET'));
        }
        self::$DSN = "mysql:dbname={$dbName};host={$host};charset=utf8mb4";
        self::$log = $log;
        self::$mdp = $mdp;
    }

    public function esc($val) {  // encapsule methode quote PDO
        return $val === null ? 'NULL' : $this->db->quote($val);
    }

    public function xeq($req) {  // execute la requete
        try {
            if (mb_stripos(trim($req), 'SELECT') === 0) {  // trim supprime les espaces dans la requête avant SELECT
                $this->jeu = $this->db->query($req);
                $this->nb = $this->jeu->rowCount();  // rowcount compte les enregistrements
            } else {
                $this->jeu = null;
                $this->nb = $this->db->exec($req); // exec retourne le nombre de ligne affectées
            }
        } catch (PDOException $e) {
            echo I18n::get('DB_ERR_BAD_REQUEST');
            exit(" : {$req} ({$e->getMessage()})");
        }
        return $this;
    }

    public function nb() {  // retourne nbr de ligne affecté par derniere requête
        return $this->nb;
    }

    public function tab($classe = 'stdClass') {  // retourne un tableau d'enregistrements sous forme d'instance de CLASSE apres requete SELECT
        if (!$this->jeu) {
            return []; // si rien tableau vide []
        }
        $this->jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classe);
        return $this->jeu->fetchAll();
    }

    public function prem($classe = 'stdClass') { // retourne le 1er enregistrement
        if (!$this->jeu) {
            return null;
        }
        $this->jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classe);
        return $this->jeu->fetch();
    }

    public function ins($obj) {  // insert propriété dans obj avec fetch into
        if (!$this->jeu) {
            return false;
        }
        $this->jeu->setFetchMode(PDO::FETCH_INTO, $obj);
        return $this->jeu->fetch();
    }

    public function pk() {  // retourne derniere id en auto-incrémentation
        return $this->db->lastInsertId();
    }

    public function start() {  // demarre la transaction
        return $this->db->beginTransaction();
    }

    public function savepoint($label) {  // point de sauvegarde dans transaction, $label donne un nom à la sauvegarde
        $req = "SAVEPOINT {$label}";
        $this->xeq($req);
        return ($req);
    }

    public function rollback($label = null) {  // fait un retour arriere sur un point de sauvegarde ($label)
        if (!$label) {
            return $this->db->rollBack();
        }
        return $this->db->rollBackTo($label);  // OU return $label ?  $this->db->rollBackTo($label) : $this->db->rollBack();
    }

    public function commit() {  // valide la transaction
        return- $this->db->commit();
    }

}
