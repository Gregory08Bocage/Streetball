<?php

class I18n {

    private function __construct() {
// classe 100% statique donc pas possible de New I18n
    }

    public static function get($message) {
        $langues = filter_input(INPUT_SERVER, 'HTTP_ACCEPT_LANGUAGE', FILTER_SANITIZE_STRING);
        $langue = $langues ? mb_substr($langues, 0, 2) : 'en';  // recupere le 'fr' de la langue grace à substr et nb_ pour l'utf8(commence a zero et 2 premieres lettres) sinon 'en'
        if (isset(self::$msg[$langue][$message])) {   // si messsage existe langue prefere utilsateur
            return self::$msg[$langue][$message];
        } // on lui retourne en français
        if (isset(self::$msg['en'][$message])) {   // si messsage n'existe pas langue prefere utilsateur on lui retourne
            return self::$msg['en'][$message];
        } // sinon on lui retourne dans la 2eme lanque, l'anglais
        return null;  // sinon retourne null
    }

    private static $msg = [// tableau associatif en 2 dimension (voir shema)
        'fr' => ['FORM_ERR_CATEGORY' => "La catégorie est absente ou invalide",
            'FORM_ERR_NAME' => "Le nom est absent ou invalide",
            'FORM_ERR_REF' => "La ref est absente ou invalide",
            'FORM_ERR_PRICE' => "Le prix est absent ou invalide",
            'FORM_ERR_LOG' => "Login absent ou invalide",
            'FORM_ERR_LOGIN' => "Connexion impossible",
            'FORM_ERR_MDP' => "Mot de passe absent ou invalide",
            'FORM_LABEL_CATEGORY' => "Catégorie",
            'FORM_LABEL_NAME' => "Nom",
            'FORM_LABEL_FIRST_NAME' => "Prénom",
            'FORM_LABEL_REF' => "Référence",
            'FORM_LABEL_PRICE' => "Prix",
            'FORM_LABEL_CANCEL' => "Annuler",
            'FORM_LABEL_SUBMIT' => "Valider",
            'FORM_LABEL_LOG' => "Pseudo",
            'FORM_LABEL_MDP' => "Mot de passe",
            'FORM_LABEL_CONNECT' => "Connexion",
            'FORM_LABEL_IMMAT' => "Immatriculation",
            'FORM_LABEL_DUREE' => "Durée",
            'FORM_LABEL_DATE' => "Dâte",
            'UPLOAD_ERR' . UPLOAD_ERR_INI_SIZE => "taille dépasse maxi côté serveur",
            'UPLOAD_ERR' . UPLOAD_ERR_FORM_SIZE => "taille dépasse maxi côté client",
            'UPLOAD_ERR' . UPLOAD_ERR_PARTIAL => "fichier partiellement uploadé",
            'UPLOAD_ERR' . UPLOAD_ERR_NO_FILE => "aucun fichier uploadé",
            'UPLOAD_ERR' . UPLOAD_ERR_NO_TMP_DIR => "dossier temporaire absent",
            'UPLOAD_ERR' . UPLOAD_ERR_CANT_WRITE => "dossier temporaire inaccessible",
            'UPLOAD_ERR' . UPLOAD_ERR_EXTENSION => "une extension PHP a bloqué l'upload",
            'UPLOAD_ERR_EMPTY' => "fichier vide",
            'UPLOAD_ERR_EXTENSION' => "l'extension du fichier est invalide",
            'UPLOAD_ERR_MINE' => "le type mine du fichier est invalide",
            'UPLOAD_ERR_MOVE' => "erreur au déplacement",
            'IMG_ERR_UNAVAILABLE' => "image inutilisable",
            'IMG_ERR_TYPE' => "type image invalide",
            'IMG_ERR_CANT_WRITE' => "Ecriture image impossible",
            'IMG_ERR_OUT_OF_MEMORY' => "mémoire inssufisante",
            'DB_ERR_DSN_ALREADY_SET' => "Deja fait",
            'DB_ERR_CONNECTION_FAILED' => "Connexion impossible",
            'DB_ERR_DSN_UNDEFINED' => "DSN non defini",
            'DB_ERR_BAD_REQUEST' => "Requete incorrecte"],
        // language anglais
        'en' => ['FORM_ERR_CATEGORY' => "Category empty or invalid",
            'FORM_ERR_NAME' => "Name empty or wrong",
            'FORM_ERR_REF' => "Reference empty, invalid or already used",
            'FORM_ERR_PRICE' => "Price empty or invalid",
            'FORM_ERR_LOG' => "Login empty",
            'FORM_ERR_LOGIN' => "Connection failed",
            'FORM_ERR_MDP' => "Password empty",
            'FORM_LABEL_CATEGORY' => "Category",
            'FORM_LABEL_NAME' => "Name",
            'FORM_LABEL_REF' => "Reference",
            'FORM_LABEL_PRICE' => "Price",
            'FORM_LABEL_CANCEL' => "Cancel",
            'FORM_LABEL_SUBMIT' => "Submit",
            'FORM_LABEL_LOG' => "Login",
            'FORM_LABEL_MDP' => "Password",
            'FORM_LABEL_CONNECT' => "Connection",
            'UPLOAD_ERR' . UPLOAD_ERR_INI_SIZE => "size too much server side",
            'UPLOAD_ERR' . UPLOAD_ERR_FORM_SIZE => "size exceeds maxi client side",
            'UPLOAD_ERR' . UPLOAD_ERR_PARTIAL => "partially uploaded file",
            'UPLOAD_ERR' . UPLOAD_ERR_NO_FILE => "no uploaded file",
            'UPLOAD_ERR' . UPLOAD_ERR_NO_TMP_DIR => "Temporary folder not present",
            'UPLOAD_ERR' . UPLOAD_ERR_CANT_WRITE => "temporary folder inaccessible",
            'UPLOAD_ERR' . UPLOAD_ERR_EXTENSION => "a PHP extension prevents the upload from being completed",
            'UPLOAD_ERR_EMPTY' => "empty file",
            'UPLOAD_ERR_EXTENSION' => "wrong file extension",
            'UPLOAD_ERR_MINE' => "wrong MINE extension",
            'UPLOAD_ERR_MOVE' => "Can't save the file",
            'IMG_ERR_UNAVAILABLE' => "image unavailable",
            'IMG_ERR_TYPE' => "wrong image size",
            'IMG_ERR_CANT_WRITE' => "can't write the image",
            'IMG_ERR_OUT_OF_MEMORY' => "out of memory",
            'DB_ERR_DSN_ALREADY_SET' => "DSN already set",
            'DB_ERR_CONNECTION_FAILED' => "Connection failed",
            'DB_ERR_DSN_UNDEFINED' => "DSN undefined",
            'DB_ERR_BAD_REQUEST' => "Bad request"],
        // language malgache
        'mg' => ['FORM_ERR_CATEGORY' => "Sokajy tsy misy na diso",
            'FORM_ERR_NAME' => "Anaran tsy misy na diso",
            'FORM_ERR_REF' => "Sokajy tsy misy diso na efa misy",
            'FORM_ERR_PRICE' => "Vidiny tsy misy, diso na efa misy",
            'FORM_ERR_LOG' => "Mialà eo an-tsipelina na tsy manan-kery",
            'FORM_ERR_LOGIN' => "Tsy afaka mifandray",
            'FORM_ERR_MDP' => "Anarana tsy ampy na tsy manan-kery",
            'FORM_LABEL_CATEGORY' => "Sokajy",
            'FORM_LABEL_NAME' => "Anarana",
            'FORM_LABEL_REF' => "Reference",
            'FORM_LABEL_PRICE' => "Vidiny",
            'FORM_LABEL_CANCEL' => "hanafoana",
            'FORM_LABEL_SUBMIT' => "Alefa",
            'FORM_LABEL_LOG' => "anaram-bositra",
            'FORM_LABEL_MDP' => "tenimiafina",
            'FORM_LABEL_CONNECT' => "miditra amin'ny",
            'UPLOAD_ERR' . UPLOAD_ERR_INI_SIZE => "Lehibe mihoatra ny serivera",
            'UPLOAD_ERR' . UPLOAD_ERR_FORM_SIZE => "Maherin'ny mihoatra ny client client",
            'UPLOAD_ERR' . UPLOAD_ERR_PARTIAL => "partial uploaded file",
            'UPLOAD_ERR' . UPLOAD_ERR_NO_FILE => "tsy misy rakitra",
            'UPLOAD_ERR' . UPLOAD_ERR_NO_TMP_DIR => "Ordinatera tsy maharitra",
            'UPLOAD_ERR' . UPLOAD_ERR_CANT_WRITE => "tempolin'ny temporary tsy azo ampiasaina",
            'UPLOAD_ERR' . UPLOAD_ERR_EXTENSION => "Ny famoahana PHP dia nanakana ny famoahana",
            'UPLOAD_ERR_EMPTY' => "dingana tsy misy",
            'UPLOAD_ERR_EXTENSION' => "Fitaovana mavesatra loatra (serivisy servisy)",
            'UPLOAD_ERR_MINE' => "Tsy mety ny karazan-tsariko",
            'UPLOAD_ERR_MOVE' => "diso",
            'IMG_ERR_UNAVAILABLE' => "tsy maisy io sary io",
            'IMG_ERR_TYPE' => "tsy io karazany io",
            'IMG_ERR_CANT_WRITE' => "Tsy afaka manoratra sary",
            'IMG_ERR_OUT_OF_MEMORY' => "Tsy ampy fahatsiarovana",
            'DB_ERR_DSN_ALREADY_SET' => "Efa napetraka",
            'DB_ERR_CONNECTION_FAILED' => "Tsy nahomby ny fifandraisana",
            'DB_ERR_DSN_UNDEFINED' => "Fifandraisana tsy voafaritra",
            'DB_ERR_BAD_REQUEST' => "Fangatahana tsy mety"]
    ];

}
