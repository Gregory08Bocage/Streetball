<?php
require_once 'class/Cfg.php';
require_once 'inc/header.php';
?>

<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="img/video/intronba.mp4" type="video/mp4">
</video>
<div id="accvideo"></div>
<div class="my-5" id="accoffre">
    <div class="row justify-content-center">

        <div class="col-sm-12">
            <h1 class="offre pt-4">OFFRES</h1>
        </div>
        <h2 class="offreh2">Découvrez et réservez vos créneaux et stages Streetball toute l'année !</h2>
    </div>
    <div class="row">

        <div class="col-sm-12">
            <div class="row d-flex justify-content-center">
                <div class="p-3">
                    <img src="img/stage/icone_index_playground.jpg" class="sepia" alt=""/>
                </div>

                <div class="p-3">
                    <img src="img/stage/index_stage.jpg" class="sepia" alt=""/>
                </div>

            </div>
            <div class="row d-flex justify-content-center">
                <div class="p-3"> <a class=" btn btn-primary bt2 mr-2" href="reservation.php">PLAYGROUND</a></div>
                <div class="p-3 ml-5"> <a class=" btn btn-primary bt2 mr-2" href="stageKids.php">STAGE KIDS</a></div>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid f-widget featpro pl-4" id="accstore">
    <div class="row">
        <div class="col-sm-12 pt-3 pl-4" id="title-widget-bg">
            <div class="row">
                <div class="title-widget" style="color: #EC5C2A;font-size: 25px;font-weight: bold;"><p>PRODUITS DU STORE</p></div>
                <div class="carousel-nav">
                    <a class="prev"><img class="img-responsive pt-2" src="img/ico/sleft.png"/></a>
                    <a class="next"><img class="img-responsive pt-2" src="img/ico/sright.png"/></a>
                </div>
            </div>
        </div>
        <div id="product-carousel" class="owl-carousel owl-theme">
            <div class="container">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_1_v.jpg" alt="" class="img-fluid"/>
                        <div class="pricetag orange"><div class="inner"><span>39 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Reverse</a></span>
                    <span class="smalldesc">Ref : RV2018-09</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_2_v.jpg" alt="" class="img-fluid"/>
                        <div class="pricetag orange"><div class="inner"><span>39 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Jumpman</a></span>
                    <span class="smalldesc">Ref : JP2018-09</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_5_v.jpg" alt="" class="img-fluid"/>
                        <div class="pricetag orange"><div class="inner"><span>90 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">TF150</a></span>
                    <span class="smalldesc">Ref : JM2018-23</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_6_v.jpg" alt="" class="img-fluid"/>
                        <div class="pricetag orange"><div class="inner"><span>90 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Highlight</a></span>
                    <span class="smalldesc">Ref : DK2018-32</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_10_v.jpg" alt="" class="img-fluid"/>
                        <div class="pricetag orange"><div class="inner"><span>45 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Breathe</a></span>
                    <span class="smalldesc">Ref : BT1998-09</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_11_v.jpg" alt="" class="img-responsive"/>
                        <div class="pricetag orange"><div class="inner"><span>45 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Elite</a></span>
                    <span class="smalldesc">Ref : EL2002-45</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_13_v.jpg" alt="" class="img-responsive"/>
                        <div class="pricetag orange"><div class="inner"><span>40 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Light</a></span>
                    <span class="smalldesc">UN2555-01</span>
                </div>
            </div>
            <div class="item">
                <div class="productwrap">
                    <div class="pr-img">
                        <img src="img/produit/prod_14_v.jpg" alt="" class="img-responsive"/>
                        <div class="pricetag orange"><div class="inner"><span>40 €</span></div></div>
                    </div>
                    <span class="smalltitle"><a href="store.php">Med</a></span>
                    <span class="smalldesc">Ref : SM3222-02</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'inc/footer.php';
?>