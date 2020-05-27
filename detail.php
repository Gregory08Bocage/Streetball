<?php
require_once 'class/Cfg.php';
require_once 'inc/header.php';
// require_once 'phpFormulaire/formProduit.php';
$cnx = Connexion::getInstance();
$tabErreur = [];

$opt = ['options' => ['min_range' => 1]];

$id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_VALIDATE_INT, $opt);
$produit = new Produit($id_produit);
$produit->charger();
$produit->id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_VALIDATE_INT, $opt);
if (filter_input(INPUT_POST, 'submit')) {
//$produit->id_commande = filter_input(INPUT_GET, 'id_commande', FILTER_VALIDATE_INT, $opt);
    $produit->id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_VALIDATE_INT, $opt);

    if (!$tabErreur && $produit->sauverProduit()) {
        $produit->sauverIdProduit();
        $tabErreur[] = I18n::get('FORM_ERR_ALLREADY_BOOKED');
        header("Location:actualites.php");
        exit;
    }
}
//$produit->id_commande = filter_input(INPUT_GET, 'id_commande', FILTER_VALIDATE_INT, $opt);
$idimg = file_exists("img/prod_{$produit->id_produit}_v.jpg") ? $produit->id_produit : 0;
$categorie = $produit->getCategorie();
$tabProduit = Produit::tous();
?>

<div class="row">
    <div class="col-lg-12 pb-5">
        <a href="store.php">Store ></a>
        <a href="javascript:history.go(-1)"><?= $categorie->nom ?></a> &gt; <?= $produit->nom ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="title-bg">
                    <div class="title">Détail</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="dt-img">
                            <div class="detpricetag"><div class="inner"><?= $produit->prix ?></div></div>
                            <a class="fancybox" href="img/produit/prod_<?= $idimg ?>_v.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="img/produit/prod_<?= $idimg ?>_v.jpg?alea=<?= rand() ?>"/></a>
                        </div>
                        <div class="thumb-img">
                            <a class="fancybox" href="images/dummy-1.png" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="img/produit/prod_<?= $idimg ?>_v.jpg?alea=<?= rand() ?>"/></a>
                        </div>
                        <div class="thumb-img">
                            <img src="img/produit/prod_<?= $idimg ?>_v.jpg?alea=<?= rand() ?>"/>
                        </div>
                        <div class="thumb-img">
                            <img src="img/produit/prod_<?= $idimg ?>_v.jpg?alea=<?= rand() ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6 det-desc">
                        <div class="productdata">
                            <div class="infospan">Nom <span><?= $produit->nom ?></span></div>
                            <div class="infospan">Référence<span><?= $produit->ref ?></span></div>
                        </div>

                        <form class="form-horizontal ava" role="form">	
                            <div class="form-group">
                                <label for="qty" class="col-sm-2 control-label">Qty</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="qty">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
              <!--  <label <?= I18n::get('FORM_LABEL_PLAYGROUND') ?> class="control-label" for="taille">LA taille</label> -->
                                    <input type="hidden" name="id_produit" value="<?= $produit->id_produit ?>" />
                                    <input type="hidden" name="id_categorie" value="<?= $produit->id_categorie ?>" />
                                    <input type="hidden" name="nom" value="<?= $produit->nom ?>" />
                                    <input type="hidden" name="ref" value="<?= $produit->ref ?>" />
                                    <input type="hidden" name="prix" value="<?= $produit->prix ?>" />
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="<?= I18n::get('FORM_LABEL_SUBMIT') ?>">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>












            <form name="form3" method="post" enctype="multipart/form-data" action="detail.php">

            </form>
        </div>
    </div>
</div>
</body>
</html>