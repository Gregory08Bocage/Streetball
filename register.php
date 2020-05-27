<?php
require_once 'class/Cfg.php';
$user = new User();
$tabErreur = [];

if (filter_input(INPUT_POST, 'submit')) {
    $user->log = filter_input(INPUT_POST, 'log', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $user->date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    if (!$user->log) {
        $tabErreur[] = I18n::get('FORM_ERR_LOG');
    }
    if (!$user->mdp) {
        $tabErreur[] = I18n::get('FORM_ERR_MDP');
    }
    if (!$user->nom) {
        $tabErreur[] = "Nom absent ou invalide";
    }
    if (!$user->prenom) {
        $tabErreur[] = "Prenom absent ou invalide";
    }
    if (!$user->email) {
        $tabErreur[] = "Email absent ou invalide";
    }
    if (!$user->tel) {
        $tabErreur[] = "Telephone absent ou invalide";
    }
    if (!$user->date_naissance) {
        $tabErreur[] = "Date de naissance absente ou invalide";
    }
    if (!$tabErreur) {
        $user->sauver();
        $user->login();
        header("Location:index.php");
        exit;
    }
}

require_once 'inc/header.php';
?>
<div class="row">
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 login-form-group py-3 text-light" >
                <h3 style="color: #EC5C2A;">NOUVEAU CLIENT ?</h3>
                <form name="form1" action="register_ss_captcha.php" method="post" enctype="multipart/form-data">
                    <div class = "form-row has-success">
                        <div class = "form-group col-md-6 mb-3">
                            <label for = "inputlog">Pseudo</label>
                            <input type="text" class = "form-control is-valid" id = "inputlog" name="log" placeholder = "Saisissez un pseudo" required>
                            <div class = "valid-feedback"></div>
                        </div>
                        <div class = "form-group col-md-6 mb-3">
                            <label for = "inputPassword">Mot de passe</label>
                            <input type="password" class = "form-control is-valid" id = "inputPassword" name="mdp" placeholder = "Saisissez un mot de passe" required>
                            <div class = "valid-feedback"></div>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "form-group col-md-6">
                            <label for = "inputName">Nom</label>
                            <input type="text" class = "form-control" id = "inputName" name="nom" placeholder = "Saisissez votre nom" required>
                        </div>
                        <div class = "form-group col-md-6">
                            <label for = "inputFirstName">Prénom</label>
                            <input type="text" class = "form-control" id = "inputFirstName" name="prenom" placeholder = "Saisissez votre prénom" required>
                        </div>
                    </div>
                    <div class = "form-row">
                        <div class = "form-group col-md-4">
                            <label for = "email">Mail</label>
                            <input type="email" class = "form-control" id = "email" name="email" placeholder = "Saisissez votre email" required>
                        </div>
                        <div class = "form-group col-md-4">
                            <label for = "inputPhone">Tel</label>
                            <input type="tel" class = "form-control" id = "inputPhone" name="tel" placeholder = "Saisissez votre téléphone" required>
                        </div>
                        <div class = "form-group col-md-4">
                            <label for = "firstname">Date de naissance</label>
                            <input type="date" class = "form-control" id = "firstname" name="date_naissance" placeholder = "Saisissez votre date de naissance" required>
                        </div>
                    </div>
                    <button type ="submit" name="submit" value="submit" class = "btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'inc/footer.php';
?>
