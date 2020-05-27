<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>STREETBALL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Site de réservation en ligne de terrains de basket et de stages pour enfants">
        <meta name="keywords" content="basket, stage stageKids">
        <meta name="author" content="Bocage Gregory, Sentenac Franck">
        <link rel="icon" href="img/logostreetball.png" type="image/x-icon">
        <!-- Fonts -->
        <link href='font-awesome/css/font-awesome.css' rel="stylesheet" type="text/css">
        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- CSS Perso-->
        <link rel="stylesheet" href="css/style_streetball.css" type="text/css" media="screen">
        <!-- owl Style -->
        <link rel="stylesheet" href="css/owl.carousel.css" />
        <link rel="stylesheet" href="css/owl.transitions.css" />
        <!-- fancy Style -->
        <link rel="stylesheet" type="text/css" href="js/product/jquery.fancybox.css?v=2.1.5" media="screen" />
    </head>
    <!-- Ouverture du corps du site, fermeture dans le footer -->
    <body>
        <!-- Début des deux barres de navigation haut de page -->
        <header>
            <div class="container-fluid" id="head">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 pt-2 pl-3">
                                <a href="index.php"><img src="https://fontmeme.com/permalink/180928/c4723d5b87ff78e62c5a8825d7d20990.png" alt="police-just-do-it" border="0"></a>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-1">
                                        <a href="https://www.google.com/maps?ll=43.632135,1.41237&z=15&t=m&hl=fr-FR&gl=FR&mapclient=embed&q=2+Rue+de+l%27Egalite+31200+Toulouse"><img class="img-responsive pt-3" src="img/ico/maps.png"/></a>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 pt-1">
                                        <p style="font-size: 18px; color: white">2 rue de l'Egalité<br> 31200 TOULOUSE</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-1">
                                        <img class="img-responsive pt-4" src="img/ico/phone.png"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 pt-1">
                                        <p style="font-size: 18px; color: white">Telephone :<br>05 67 33 93 06</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-4 d-flex justify-content-center">

                        <img class="img-responsive pt-2" src="img/logostreetball4.png" style="position: absolute"/>

                    </div>
                    <div class="col-xs-1 col-sm-4 nav">
                        <?php
                        if (Cfg::$user) {
                            ?>
                            <div class="col-sm-4 pt-4">
                                <h3 style="color: white"><?= Cfg::$user->nom ?> <?= Cfg::$user->prenom ?>&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                            </div>
                            <div class="col-sm-4 pt-5">
                                <a href="logout.php" role="button" class="nav-link btn btn-primary">LOGOUT</a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-4 pt-5">
                                <a href="login.php" role="button" class="nav-link btn btn-primary">LOGIN</a>
                            </div>
                            <div class="col-sm-4 pt-5">
                                <a href="register.php" role="button" class="nav-link btn btn-primary">INSCRIPTION</a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-sm-4 pt-5">
                            <a href="#" role="button" class="nav-link btn btn-primary">PANIER</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-1" id="subhead">
                <div class="row justify-content-around">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-4">
                                <a class="nav-link btn btn-primary" href="index.php">ACCUEIL</a>
                            </div>
                            <div class="col-4">
                                <a class="nav-link btn btn-primary" href="actualites.php">ACTUALITES</a>
                            </div>
                            <div class="col-4">
                                <a class="nav-link btn btn-primary" href="playground.php">PLAYGROUND</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-4">
                                <a class="nav-link btn btn-primary" href="reservation.php">RESERVATION</a>
                            </div>
                            <div class="col-4">
                                <a class="nav-link btn btn-primary" href="stageKids.php">STAGE KIDS</a>
                            </div>
                            <div class="col-4">
                                <a class="nav-link btn btn-primary" href="store.php">STORE</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- Fin des deux barres de navigation haut de page -->

        <div class="container-fluid py-5">
            <!-- Ouverture de la div class="container" de chacune des vues du site, fermeture dans le footer -->