<?php

class LigneCommande implements Databasable {

    public $id_lignecommande;
    public $id_commande;
    public $id_kid;
    public $id_produit;
    public $id_terrain;
    public $id_heure;
    public $quantite;
    public $prix;
    public $reservation_date;
    public $reservation_duree;

    //private $products;

    public function __construct($id_lignecommande = null, $id_commande = null, $id_kid = null, $id_produit = null, $id_terrain = null, $id_heure = null, $quantite = null, $prix = null, $reservation_date = null, $reservation_duree = null) {

        $this->id_lignecommande = $id_lignecommande;
        $this->id_commande = $id_commande;
        $this->id_kid = $id_kid;
        $this->id_produit = $id_produit;
        $this->id_terrain = $id_terrain;
        $this->id_heure = $id_heure;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->reservation_date = $reservation_date;
        $this->reservation_duree = $reservation_duree;
    }

    public function charger() {
        if (!$this->id_lignecommande)
            return false;
        $req = "SELECT * FROM lignecommande WHERE id_lignecommande={$this->id_lignecommande}";
        return Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_lignecommande) {
            $req = "UPDATE lignecommande SET id_commande = {$this->id_commande},id_kid = {$this->id_kid},id_produit = {$this->id_produit},id_terrain = {$this->id_terrain},id_heure = {$this->id_heure},quantite = {$this->quantite},prix = {$this->prix}, reservation_date = {$cnx->esc($this->reservation_date)},reservation_duree = {$cnx->esc($this->reservation_duree)}WHERE id_lignecommande = {$this->id_lignecommande}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO lignecommande VALUES(DEFAULT,{$this->id_commande},{$this->id_kid},{$this->id_produit},{$this->id_terrain},{$this->id_heure},{$this->quantite},{$this->prix},{$cnx->esc($this->reservation_date)},{$cnx->esc($this->reservation_duree)})";
            $this->id_lignecommande = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_lignecommande)
            return false;
        $req = "DELETE FROM lignecommande WHERE id_lignecommande = {$this->id_lignecommande}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();
    }

    public static function tab($where = 1, $orderBy = 1, $limit = null) {
        $req = "SELECT * FROM lignecommande WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public function sauverReservation() {
        $cnx = Connexion::getInstance();
        if ($this->id_lignecommande) {
            $req = "UPDATE lignecommande SET id_commande = {$this->id_commande},id_kid = {$this->id_kid},id_produit = {$this->id_produit},id_terrain = {$this->id_terrain},id_heure = {$this->id_heure},quantite = {$this->quantite},prix = {$this->prix}, reservation_date = {$cnx->esc($this->reservation_date)},reservation_duree = {$cnx->esc($this->reservation_duree)}WHERE id_lignecommande = {$this->id_lignecommande}";
            $cnx->xeq($req);
        } else {
            if ($this->reservation_date >= date('Y-m-d')) {
                for ($i = 0; $i < $this->reservation_duree; $i++) {
                    $req = "INSERT INTO lignecommande VALUES(DEFAULT,DEFAULT,DEFAULT,DEFAULT,{$this->id_terrain},{$this->id_heure},DEFAULT,80,{$cnx->esc($this->reservation_date)},1)";
                    $this->id_lignecommande = $cnx->xeq($req)->pk();
                }
            } else
                echo "Date invalide";
        }
        return $this;
    }

    public static function tous() {
        return LigneCommande::tab(1, 'id_lignecommande');
    }

    public function getReservation() {
        return (new Reservation($this->id_lignecommande))->charger();
    }

    public function getNomTerrain() {
        return (new Terrain($this->id_terrain))->charger();
    }

    public function getHeure() {
        return (new Heure($this->id_heure))->charger();
    }

    public function getKid() {
        return (new Kid($this->id_kid))->charger();
    }

    public function getProduit() {
        return (new Produit($this->id_produit))->charger();
    }

    public static function jours() {
        for ($i = 0; $i < 20; $i++) {
            $jours = new stdClass();
            $jours->u = strtotime("next day + {$i} day"); //La fonction strtotime() essaye de lire une date au format anglais fournie par le paramètre time, et de la transformer en timestamp Unix (le nombre de secondes depuis le 1er Janvier 1970 à 00:00:00 UTC), relativement au timestamp now, ou à la date courante si ce dernier est omis.
            $jours->a = date('Y', $jours->u);
            $jours->m = date('m', $jours->u);
            $jours->j = date('d', $jours->u);
            $tab[] = $jours;
        }
        return $tab;
    }

    public function derniereReservationTerrain() {
        $req = "SELECT reservation_date,reservation_duree, FROM lignecommande ={$this->id_lignecommande}  ORDER BY DESC LIMIT 1";
        return Connexion::getInstance()->xeq($req)->prem('LigneCommande');
    }

    public function panier() {
        $req = "SELECT lig FROM lignecommande ={$this->id_lignecommande}  ORDER BY DESC LIMIT 1";
        return Connexion::getInstance()->xeq($req)->prem('LigneCommande');
    }

    public static function getDate() {
        $q = str_replace('-', '', filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
        $con = Connexion::getInstance();
        $sql = "SELECT * FROM(SELECT heure.heure, terrain.nom_terrain FROM `heure`, `lignecommande`, `terrain` WHERE lignecommande.reservation_date='" . $q . "'" . "AND terrain.id_terrain=lignecommande.id_terrain AND heure.id_heure NOT IN(SELECT lignecommande.id_heure FROM `lignecommande` WHERE lignecommande.reservation_date='" . $q . "'" . "AND terrain.id_terrain=lignecommande.id_terrain) UNION SELECT heure.heure, terrain.nom_terrain FROM `terrain`, `heure` WHERE terrain.id_terrain NOT IN (SELECT  DISTINCT id_terrain FROM `lignecommande` WHERE lignecommande.reservation_date='" . $q . "'" . ")) AS tab ORDER BY tab.nom_terrain, tab.heure";
        $result = $con->xeq($sql)->tab();
        echo "<table>
<tr>
<th>Playground</th>
<th>Heure</th>
</tr>";
        for ($i = 0; $i < $con->nb(); $i++) {

            echo "<tr>";
            echo "<td>" . $result[$i]->nom_terrain . " </td>";
            echo "<td>" . $result[$i]->heure . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public static function fake() {
        $products = array_map(function ($prix) {
            return (new Produit())
                            ->setPrix($prix)
                            ->setNom('Produit qui coute ' . $prix);
        }, [39.00, 45.00, 40.00, 90.00]);
        return (new self())
                        ->setProduit($products);
    }

    /* public function getProducts() {
      return $this->products;
      }

      public function setProducts($products) {
      $this->products = $products;
      return $this;
      }
     */
}
