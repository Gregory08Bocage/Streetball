<?php

class Session implements SessionHandlerInterface, Databasable {  // créer un cookie de session qui recolte des infos

    public $sid; //PHPSESSID
    public $data; // Données (sérialisé automatiquement par PHP)
    public $date_maj;  //  Date mise à jours (auto)
    private $timeout; // Timeout en seconde, aucun si null

    public function __construct($timeout = null) {
        $this->timeout = $timeout;
    }

    public function charger() {
        $cnx = Connexion::getInstance();
        // $this = session, methode esc de la class Connexion, TIMESTAMPDIFF methode SQL
        $req = "SELECT * FROM session WHERE sid = {$cnx->esc($this->sid)}" . ($this->timeout ?
                " AND TIMESTAMPDIFF(SECOND,date_maj,NOW()) < {$this->timeout}" : '');
        return $cnx->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        $req = "INSERT INTO session VALUES({$cnx->esc($this->sid)}, {$cnx->esc($this->data)}, DEFAULT) ON DUPLICATE KEY UPDATE data = {$cnx->esc($this->data)}, date_maj = DEFAULT";
        // DEFAULT = comportement par default
        $cnx->xeq($req);
        return $this;
    }

    public function supprimer() {
        $cnx = Connexion::getInstance();
        $req = "DELETE FROM session WHERE sid = {$cnx->esc($this->sid)}";
        return (bool) $cnx->xeq($req)->nb();  // execute la requete
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {
// inutile ici
        {
            return [];
        }
    }

    public function close() {  // ferme la session
        return true;
    }

    public function destroy($session_id) {  // detruit la session, session_id = sid
        $this->sid = $session_id;
        return $this->supprimer();  // return true ou false car methode supprimer le demande
    }

    public function gc($maxlifetime) {  // nettoie les vielles sessions
        if (!$this->timeout) {
            return true;
        }
        $req = "DELETE FROM session WHERE TIMESTAMPDIFF(SECOND,date_maj,NOW()) > {$this->timeout}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();  // nb retourne nbr de ligne affecté
    }

    public function open($save_path, $name) {  // ouvre un fichier (ouvre une session)
        {
            return true;
        }
    }

    public function read($session_id) {  // lit les données de la session
        $this->sid = $session_id;
        return $this->charger() ? $this->data : '';
    }

    public function write($session_id, $session_data) {  // écrit les données de la session
        $this->sid = $session_id;
        $this->data = $session_data;
        $this->sauver();
        return true;
    }

}
