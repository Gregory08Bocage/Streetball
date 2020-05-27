<?php
require_once 'class/Cfg.php';
require_once 'phpFormulaire/formTerrain.php';
require_once 'inc/header.php';
?>

<div class="row justify-content-center">
    <div class="playground col-md-6 col-sm-6 col-xs-12">
        <form name="form1" method="post" enctype="multipart/form-data" action="reservation.php">

            <div class="form-group ">
                <input type="hidden" name="id_commande" value="<?= $lignecommande->id_commande ?>" />
                <input type="hidden" name="id_kid" value="<?= $lignecommande->id_kid ?>" />
                <input type="hidden" name="id_produit" value="<?= $lignecommande->id_produit ?>" />
                <input type="hidden" name="quantite" value="<?= $lignecommande->quantite ?>" />
                <input type="hidden" name="prix" value="<?= $lignecommande->prix ?>" />
                <label <?= I18n::get('FORM_LABEL_DATE') ?> class="control-label ">Date </label>
                <select name="reservation_date" id="txtHint" value="<?= $lignecommande->reservation_date ?>" class="form-control" onchange="showDate(this.value)" >
                    <option value="0">Choisissez...</option>
                    <?php
                    foreach ($tabJours as $jours) {
                        $formater = new IntlDateFormatter('fr_Fr', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                        $date = strtotime(" $jours->a-$jours->m-$jours->j");
                        ?>
                        <option value="<?= $jours->a ?>-<?= $jours->m ?>-<?= $jours->j ?>"><?= $formater->format($date) ?></option>
                        <?php
                    }
                    ?>
                </select>

            </div>

            <div class="form-group ">
                <label <?= I18n::get('FORM_LABEL_HOURS') ?> class="control-label ">Choix de l'heure </label>
                <select name="id_heure" value="<?= $lignecommande->id_heure ?>" class="form-control"required="required" >
                    <option value="0">Choisissez...</option>
                    <?php
                    foreach ($tabHeure as $heure) {
                        $selected = $heure->heure == $heure->id_heure ? 'selected="selected"' : '';
                        ?>
                        <option value="<?= $heure->id_heure ?>" <?= $selected ?>><?= $heure->heure ?></option>
                        <?php
                    }
                    ?></select>
            </div>
            <div class="form-group ">
                <label <?= I18n::get('FORM_LABEL_DURATION') ?> class="control-label ">Choix de la durée</label>
                <select name="reservation_duree" value="<?= $lignecommande->reservation_duree ?>"class="form-control" required="required">
                    <option value="1">1h</option>
                </select>
            </div>

            <div class="form-group">
                <label <?= I18n::get('FORM_LABEL_PLAYGROUND') ?> class="control-label " for="nom_terrain">Playground</label>
                <select name="id_terrain" class="form-control" required="required" >
                    <option value="0">Choisissez...</option>
                    <?php
                    foreach ($tabTerrain as $terrain) {
                        $selected = $terrain->nom_terrain == $terrain->id_terrain ? 'selected="selected"' : '';
                        ?>
                        <option value="<?= $terrain->id_terrain ?>" <?= $selected ?>><?= $terrain->nom_terrain ?></option>
                        <?php
                    }
                    ?>

                </select>
            </div>
            <div class="form-group">

                <input class="btn btn-primary bt2" type="submit" name="submit" value="<?= I18n::get('FORM_LABEL_SUBMIT') ?>">

            </div>

        </form>

        <div>
            <div id="reserv" ><b>Pour afficher les plages horaires et terrains disponibles, veuillez selectionner une date...</b></div>
        </div>

    </div>

</div>

<script src="js/ajaxDateReservation.js" type="text/javascript"></script>
<?php
require_once 'inc/footer.php';
?>