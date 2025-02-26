<?php

class Misc {

    private function __construct() {
        //100% statique, fourre-tout
    }

// Function pour crypter un ensemble de mdp dans une BDD
    public static function crypterMdp($table, $colPk, $colMdp) {
        $cnx = Connexion::getInstance();
        $req = "SELECT * FROM {$table} WHERE {$colMdp} IS NOT NULL";
        $tab = $cnx->xeq($req)->tab();
        foreach ($tab as $obj) {
            var_dump($obj);
            $req = "UPDATE {$table} SET {$colMdp}={$cnx->esc(password_hash($obj->$colMdp, PASSWORD_DEFAULT))} WHERE {$colPk}={$obj->$colPk}";
            $cnx->xeq($req);
        }
    }

}
