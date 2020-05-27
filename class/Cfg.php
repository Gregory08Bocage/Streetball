<?php

Cfg::init();  // appel de la methode init en dehors de la classe pour generaliser pour l'appeler dans toutes les class

class Cfg {

    public static $user = null;
    private static $initDone = false;  // initDone = initilisation terminé

// Upload

    const TAB_EXT = [];
    const TAB_MIME = ['image/jpeg'];
// Image
    const IMG_V_LARGEUR = 300;
    const IMG_V_HAUTEUR = 300;
    const IMG_P_LARGEUR = 450;
    const IMG_P_HAUTEUR = 450;
// Session
    const SESSION_TIMEOUT = 600; // 5 minutes
//Stage
    const LUNDI = 3;
    const DISPO_MAX = 30;

    private function __construct() {
// classe 100% static
    }

    public static function init() {
        if (self::$initDone) {
            return false;
        }
// auto-chargement des class
        spl_autoload_register(function ($class) {
            @include "class/{$class}.php";  // @ supprime erreur
        });
        spl_autoload_register(function ($class) {
            @include "framework/{$class}.php";
        });
//DSN
        Connexion::setDSN('streetball', 'root', '');

//Session
        session_set_save_handler(new Session(self::SESSION_TIMEOUT));
        session_start();
        self::$user = User::getUserSession();

        // Initial Done
        return self::$initDone = true;
    }

}
