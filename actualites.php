<?php
require_once 'class/Cfg.php';
require_once 'inc/header.php';
?>

<div class="row justify-content-center mr-2">
    <?php
    $rss_link = "https://www.basketusa.com/feed/";
    $rss_load = simplexml_load_file($rss_link);
    foreach ($rss_load->channel->item as $item) {
        ?>


        <div class="card pl-0 m-2 ">
            <?= $item->title ?>
            <?= $item->description ?>
        </div>



        <?php
    }
    ?>
</div>

<?php
require_once 'inc/footer.php';
?>