<?php
require_once 'class/Cfg.php';
$tabCategorie = Categorie::tous();
require_once 'inc/header.php';
?>

<?php
foreach ($tabCategorie as $categorie) {
    $tabProduit = $categorie->getTabProduit();
    ?>
    <div class="container-fluid">
        <div class="row prdct">
            <div class="col-lg-12 p-3">
                <?php
                if (Cfg::$user && Cfg::$user->id_niveau > 1) {
                    ?>
                    <img class="ico"
                         src="img/ico/ico_add.png"
                         alt="Ajouter un produit"
                         onclick="ajouterProduit(<?= $categorie->id_categorie ?>)"/>
                         <?php
                     }
                     ?>
                <h1 style="color: #EC5C2A;font-size: 45px;font-weight: bold;"><?= $categorie->nom ?></h1>
            </div>
            <?php
            foreach ($tabProduit as $produit) {
                $idimg = file_exists("img/produit/prod_{$produit->id_produit}_v.jpg") ? $produit->id_produit : 0;
                ?>
                <div class="col-md-3"
                  onclick="detailProduit(<?= $produit->id_produit ?>)">
                    <div class="productwrap">
                        <div class="pr-img">
                            <img src="img/produit/prod_<?= $idimg ?>_v.jpg?alea=<?= rand() ?>" alt=""/>
                            <div class="pricetag"><div class="inner"><?= $produit->prix ?> €</div>
                            </div>
                        </div>
                        <?php
                        if (Cfg::$user && Cfg::$user->id_niveau > 1) {
                            ?>
                            <img class="ico editer"
                                 src="img/ico/ico_edit.png"
                                 alt="Editer un produit"
                                 onclick="editerProduit(event, <?= $produit->id_produit ?>)"/>
                            <img class="ico supprimer"
                                 src="img/ico/ico_cancel.png"
                                 alt="Editer un produit"
                                 onclick="supprimerProduit(event, <?= $produit->id_produit ?>)"/>
                                 <?php
                                 if ($idimg) {
                                     ?>
                                <img class="ico supprimerImage"
                                     src="img/ico/ico_supImg.png"
                                     alt="Supprimer une image"
                                     onclick="supprimerImage(event, <?= $produit->id_produit ?>)"/>
                                     <?php
                                 }
                                 ?>
                                 <?php
                             }
                             ?>
                        <span class="smalltitle"><?= $produit->nom ?></span>
                        <span class="smalldesc">Ref : <?= $produit->ref ?></span>
                        &nbsp;<a class="add addPanier btn btn-primary bt2" role="button" href="panier.php?id_produit=<?= $produit->id_produit; ?>">PANIER</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<?php
require_once 'inc/footer.php';
?>