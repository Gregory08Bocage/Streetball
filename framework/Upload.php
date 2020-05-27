<?php

class Upload {

    public $nomChamp;               // (Nom du champ INPUT)
    public $tabExt = [];            // (Extensions autorisées, ex : ['jpg','jpeg'])
    public $tabMIME = [];           // (types MIME autorisés, ex : ['image/jpeg'])
    public $nomClient;              // (Nom du fichier côté client)
    public $extension;              // (Extension du fichier sans le point)
    public $cheminServeur;          // (Chemin du fichier temporaire côté serveur)
    public $codeErreur;             // (Eventuel code d'erreur)
    public $octets;                 // (Nombre d'octets téléchargés)
    public $typeMIME;               // (Type MIME du fichier)
    public $tabErreur = [];         // (Complété si problème)

    public function __construct($nomChamp, $tabExt = [], $tabMINE = []) {   //[] valeur par default
        $this->nomChamp = $nomChamp;
        $this->tabExt = $tabExt;
        $this->tabMIME = $tabMINE;
        if (!isset($_FILES[$nomChamp])) {  // isset pour verifier que $nomChamp existe sinon return
            return;
        }
        $this->nomClient = $_FILES [$nomChamp]['name'];    // [$nomChamp] clé pour acceder au tableau et clé 2éme dimension name pour lire
        $this->cheminServeur = $_FILES[$nomChamp]['tmp_name'];  // tmp_name chemin temporaire du fichier sur le serveur
        $this->extension = (new SplFileInfo($this->nomClient))->getExtension();   // retrouve l'extension
        $this->codeErreur = $_FILES [$nomChamp]['error']; // error : code d'erreur éventuel
        $this->octets = $_FILES [$nomChamp]['size'];
        $this->typeMIME = $_FILES [$nomChamp]['type'];
        // si code erreur est null donc faux
        if ($this->codeErreur) {
            $this->tabErreur[] = I18n::get('UPLOAD_ERR_' . $this->codeErreur); // le . concatain
        }  
        if (!$this->octets) {
            $this->tabErreur[] = I18n::get('UPLOAD_ERR_EMPTY');
        }  // si fichier vide
        if ($tabExt && !in_array($this->extension, $tabExt)) {  //  in_array — Indique si une valeur appartient à un tableau
            $this->tabErreur[] = I18n::get('UPLOAD_ERR_EXTENSION');
        }// si extension n'est pas correct msg erreur
        if ($tabMINE && !in_array($this->typeMIME, $tabMINE)) {  //  in_array — Indique si une valeur appartient à un tableau
            $this->tabErreur[] = I18n::get('UPLOAD_ERR_MINE');
        }
    }

    public function sauver($chemin) {  // sauvegarder
        if (!move_uploaded_file($this->cheminServeur, $chemin)) {  // deplacer fichier sauvegarder, chemin = destination
            $this->tabErreur[] = I18n::get('UPLOAD_ERR_MOVE');
        }  // msg erreur si pas réussi
    }

    public static function maxFileSize($enOctets = true) {
        $kmg = ini_get('upload_max_filesize');
        if (!$enOctets) {
            return $kmg;
        }
        $strPoids = str_ireplace('G', '*1024**3+', str_ireplace('M', '*1024**2+', str_ireplace('K', '*1024+', $kmg))) . '0';
        eval("\$poids = {$strPoids};");
        return $poids;
    }

}


