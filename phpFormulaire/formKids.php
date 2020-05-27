<?php

$tabLundi = Kid::lundi();
$cnx = Connexion::getInstance();
$tabErreur = [];
$kid = new Kid();
$opt = ['options' => ['min_range' => 1]];
$kid->id_kid = filter_input(INPUT_GET, 'id_kid', FILTER_VALIDATE_INT, $opt);

if (filter_input(INPUT_POST, 'submit')) {
  $kid->id_kid = filter_input(INPUT_POST, 'id_kid', FILTER_VALIDATE_INT, $opt);
  $kid->nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $kid->prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $kid->date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $kid->date_stage = filter_input(INPUT_POST, 'date_stage', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $kid->taille_tenue = filter_input(INPUT_POST, 'taille_tenue', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $kid->prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $tabDateNaissance = date_parse_from_format('Y-m-d', $kid->date_naissance);
  if ($tabDateNaissance['errors']) {
    $tabErreur[] = I18n::get('FORM_ERR_DATE');
  } else {
    $annee = $tabDateNaissance['year'];
    $mois = $tabDateNaissance['month'];
    $jour = $tabDateNaissance['day'];
    if (!$kid->date_naissance || !checkdate($mois, $jour, $annee))
    $tabErreur[] = I18n::get('FORM_ERR_DATE');
  }
  if (!$kid->nom) {
    $tabErreur[] = I18n::get('FORM_ERR_NAME');
  }

  if (!$kid->prenom) {
    $tabErreur[] = I18n::get('FORM_ERR_FIRSTNAME');
  }

  if (!$kid->date_stage) {
    $tabErreur[] = I18n::get('FORM_ERR_DATE');
  }
  if (!$tabErreur && $kid->sauver()) {
    $kid->sauverIdKid();
    $tabErreur[] = I18n::get('FORM_ERR_ALLREADY_BOOKED');
    header("Location:actualites.php");
    exit;
  }


}
