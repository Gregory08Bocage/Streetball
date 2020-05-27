<?php

if (!Cfg::$user) {
  header('location:login.php');
  exit;
}

$cnx = Connexion::getInstance();
$tabJours = LigneCommande::jours();
$tabErreur = [];
$lignecommande = new LigneCommande();
$opt = ['options' => ['min_range' => 1]];
$lignecommande->id_lignecommande = filter_input(INPUT_GET, 'id_lignecommande', FILTER_VALIDATE_INT, $opt);

if (filter_input(INPUT_POST, 'submit')) {
  $lignecommande->id_lignecommande = filter_input(INPUT_POST, 'id_lignecommande', FILTER_VALIDATE_INT, $opt);
  $lignecommande->reservation_date = filter_input(INPUT_POST, 'reservation_date', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $lignecommande->id_heure = filter_input(INPUT_POST, 'id_heure', FILTER_VALIDATE_INT, $opt);
  $lignecommande->reservation_duree = filter_input(INPUT_POST, 'reservation_duree', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $lignecommande->id_terrain = filter_input(INPUT_POST, 'id_terrain', FILTER_VALIDATE_INT, $opt);
  $tabDateReservation = date_parse_from_format('Y-m-d', $lignecommande->reservation_date);


  if ($tabDateReservation['errors']) {
    $tabErreur[] = I18n::get('FORM_ERR_DATE');
  } else {
    $annee = $tabDateReservation['year'];
    $mois = $tabDateReservation['month'];
    $jour = $tabDateReservation['day'];
    if (!$lignecommande->reservation_date || !checkdate($mois, $jour, $annee))
    $tabErreur[] = I18n::get('FORM_ERR_DATE');
  }
  if (!$lignecommande->id_heure) {
    $tabErreur[] = I18n::get('FORM_ERR_HOURS');
  }

  if (!$lignecommande->reservation_duree) {
    $tabErreur[] = I18n::get('FORM_ERR_DURATION');
  }

  if (!$lignecommande->id_terrain) {
    $tabErreur[] = I18n::get('FORM_ERR_PLAYGROUND');
  }
  if (!$tabErreur && $lignecommande->sauverReservation()) {
    $tabErreur[] = I18n::get('FORM_ERR_ALLREADY_BOOKED');
    header("Location:actualites.php");
    exit;
  }
}

$tabTerrain = Terrain::tous();
$tabHeure = Heure::tous();
$tabAllReservation = LigneCommande::tous();
