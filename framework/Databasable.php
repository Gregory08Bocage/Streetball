<?php

interface Databasable {  // signature des 4 méthodes

    public function charger();

    public function sauver();

    public function supprimer();

    public static function tab($where = 1, $orderBy = 1, $limit = null);
}
