<?php
require_once 'class/Cfg.php';
$tabErreur = [];
$user = new User();

if (filter_input(INPUT_POST, 'submit')) {
    $user->log = filter_input(INPUT_POST, 'log', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    if (!$user->log) {
        $tabErreur[] = I18n::get('FORM_ERR_LOG');
    }
    if (!$user->mdp) {
        $tabErreur[] = I18n::get('FORM_ERR_MDP');
    }
    if (!$tabErreur && $user->login()) {
        header("Location:index.php");
        exit;
    }
    $tabErreur[] = I18n::get('FORM_ERR_LOGIN');
}
$user = null;
require_once 'inc/header.php';
?>

<div class="erreur"><?= implode('<br/>', $tabErreur) ?></div>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-4 login-form-group py-3 text-light" >
            <h3>CONNECTEZ-VOUS</h3>
            <form name="form1" action="login.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label><?= I18n::get('FORM_LABEL_LOG') ?></label>
                    <input type="text" class = "form-control is-valid" id = "inputlog" name="log" maxlength="20" required/>
                </div>
                <div class="form-group">
                    <label><?= I18n::get('FORM_LABEL_MDP') ?></label>
                    <input type="password" class = "form-control is-valid" id = "inputPassword" name="mdp" size="20" maxlength="20" required/>
                </div>


                <input type="submit"   name="submit" value="<?= I18n::get('FORM_LABEL_CONNECT') ?>"class = "btn btn-primary bt2"/>

            </form>
        </div>

    </div>
</div>

<?php
require_once 'inc/footer.php';
?>