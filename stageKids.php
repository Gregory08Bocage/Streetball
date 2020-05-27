<?php
require_once 'class/Cfg.php';
require_once 'phpFormulaire/formKids.php';
require_once 'inc/header.php';
?>
<div class="row">
    <div class="col-12 justify-content-center">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="sous-titre">STREETBALL CAMPS</h1>
                <h2 class="mt-3">StreetBall propose un stage pour les apprentis basketteuses et basketteurs de 7 à 14 ans ! </h2>

                <article class="playground">

                    <p  class="mt-3"><span style="color: #EC5C2A;">+</span> Des stages d'une semaine durant les vacances d'été : sur des journées complètes, les enfants peuvent continuer à apprendre en s'amusant de 10h à 17h30 !</p>
                    <p><span style="color: #EC5C2A;">+</span> Les jeunes basketteuses et basketteurs (de 7 à 14 ans) seront encadrés par notre équipe d'entraineurs diplômés d'Etat.</p>
                    <p><span style="color: #EC5C2A;">+</span> Ils pourront pleinement profiter de notre infrastructure exceptionnelle et de tout ce qui l'accompagne (machine à shoots, consoles de jeu...) </p>
                </article>
            </div>
            <div class="col-lg-6 playg justify-content-center">
                    <img src="img/stage/stage_Kids.jpg" class="img-fluid" alt="stage_kids">
            </div>
        </div>
    </div>
</div>
<?php
if (Cfg::$user) {
    ?>
    <div class="playground row pt-4 mt-5">
        <div class="ol-sm-12 col-md-6">
            <h2 class="sous-titre"> Stage Kids</h2><br>
            <form name="form1" method="post" enctype="multipart/form-data" action="stageKids.php">

                <div class="form-group">
                    <label for="Nom" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                        <input name="nom" type="text" id="Nom" placeholder="Nom" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Prenom" class="col-sm-3 control-label">Prénom</label>
                    <div class="col-sm-9">
                        <input name="prenom" type="text" id="Prenom" placeholder="Prénom" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_naissance" class="col-sm-3 control-label">Date naissance</label>
                    <div class="col-sm-9">
                        <input name="date_naissance" type="date" id="Age" placeholder="date_naissance" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group pt-3 pl-4">
                    <table class="table table-striped col-sm-8 ml-3">
                        <th scope="col">Dates</th>
                        <th scope="col">Places disponibles</th>
                        <?php
                        foreach ($tabLundi as $stage) {
                            $nb = Kid::dispos($stage->u);
                            ?>


                            <?php $formater = new IntlDateFormatter('fr_Fr', IntlDateFormatter::FULL, IntlDateFormatter::NONE); ?>
                            <?php $date = strtotime(" {$stage->a}-{$stage->m}-{$stage->j}"); ?>
                            <thead>

                            </thead>
                            <tbody>
                                <tr>

                                    <td><?php $stage->a ?><?php $stage->m ?><?php $stage->j ?><?= $formater->format($date) ?></td>
                                    <td><?= $nb ?></td>


                                </tr>
                                <tr>


                            </tbody>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="form-group pt-2">

                    <label for="Date" class="col-sm-3 control-label">Date stage</label>
                    <div class="col-sm-9">
                        <select id="form_need" name="date_stage" class="form-control" required="required" data-error="Merci de choisir une date de stage">
                            <option value="0">Choisissez...</option>
                            <option value="2020-07-01">2020-07-01</option>
                            <option value="2020-07-08">2020-07-08</option>
                            <option value="2020-07-15">2020-07-15</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Taille" class="col-sm-3 control-label">Taille équipement</label>
                    <div class="col-sm-9">
                        <select id="form_need" name="taille_tenue" class="form-control" required="required" data-error="Merci de choisir une taille">
                            <option value="0">Choisissez...</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="prix" class="col-sm-3 control-label">Tarif</label>
                    <div class="col-sm-9">
                        <select id="form_need" name="prix" class="form-control" required="required" data-error="Tarif">
                            <option value="190">190€</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-9">
                        <input class="btn btn-primary bt2" type="submit" name="submit" value="<?= I18n::get('FORM_LABEL_SUBMIT') ?>">
                    </div>
                </div>

            </form>
        </div>

    </div>


    <?php
} else {
    ?>
    <div class="col-12 justify-content-start ">

        <a href="login.php" class="btn btn-primary bt2 mr-5">LOGIN</a>
        <a href="register.php" class="btn btn-primary bt2">INSCRIPTION</a>

    </div>
    <?php
}

require_once 'inc/footer.php';
?>