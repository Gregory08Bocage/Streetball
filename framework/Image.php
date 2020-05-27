<?php

require_once 'framework/I18n.php';

class Image {

    public $tabErreur = [];     //(renseigné si erreur)
    private $chemin;           //(chemin du fichier)
    private $largeur;         //(largeur en px)
    private $hauteur;         //(hauteur en px)
    private $type;            //(type PHP, ex : IMG_JPG)

    public function __construct($chemin) {
        $this->chemin = $chemin;
        list($this->largeur, $this->hauteur, $this->type) = getimagesize($chemin);
        if ($this->largeur === null) {
            $this->tabErreur[] = I18n::get('IMG_ERR_UNAVAILABLE');
            return;
        }
        if ($this->type !== IMAGETYPE_JPEG && $this->type !== IMAGETYPE_PNG) {
            $this->tabErreur[] = I18n::get('IMG_ERR_TYPE');
            return;
        }
    }

    public function copier($largeurCible, $hauteurCible, $cheminCible, $qualite = 60) {

        $ratioSource = $this->largeur / $this->hauteur;  // ratioSource = variable local
        $ratioCible = $largeurCible / $hauteurCible;  // ratioCible = variable local

        if ($this->largeur < $largeurCible && $this->hauteur < $hauteurCible) {
            if (!copy($this->chemin, $cheminCible)) {   // si copy false alors message d'erreur
                $this->tabErreur[] = I18n::get('IMG_ERR_CANT_WRITE');  // $this(Image) va vers tabErreur et donc class I18n avec methode get erreur
            }
            return;
        }
        if ($ratioSource > $ratioCible) {
            $largeurFinale = $largeurCible * $ratioSource;
            $hauteurFinale = $hauteurCible;
        } else {
            $largeurFinale = $largeurCible;
            $hauteurFinale = $hauteurCible / $ratioSource;
        }
        // Maintenant largeur et hauteur finale sont calculées
        // Nous pouvons faire le redimensionnement

        if ($this->type === IMAGETYPE_JPEG && !$source = imagecreatefromjpeg($this->chemin)) {
            $this->tabErreur[] = I18n::get('IMG_ERR_OUT_OF_MEMORY');
            return;
        }

        if ($this->type === IMAGETYPE_PNG && !$source = imagecreatefrompng($this->chemin)) {
            $this->tabErreur[] = I18n::get('IMG_ERR_OUT_OF_MEMORY');
            return;
        }

        if (!$finale = imagecreatetruecolor($largeurFinale, $hauteurFinale)) {
            $this->tabErreur[] = I18n::get('IMG_ERR_OUT_OF_MEMORY');
            return;
        }
        if (!imagecopyresampled($finale, $source, 0, 0, 0, 0, $largeurFinale, $hauteurFinale, $this->largeur, $this->hauteur)) {
            $this->tabErreur[] = I18n::get('IMG_ERR_OUT_OF_MEMORY');
            return;
        }
        imageDestroy($source);  // detruit la source pour garder la copie
        if (!($this->type === IMAGETYPE_JPEG ? imageJPEG($finale, $cheminCible, $qualite) : imagePNG($finale, $cheminCible))) {
            $this->tabErreur[] = I18n::get('IMG_ERR_CANT_WRITE');
            return;
        }
        imageDestroy($finale);  // detruit image final aprés création car stocké dans base de donnée
    }

}
