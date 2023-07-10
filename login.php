<?php
include_once('classes/StaticHTML.class.php');
include_once('classes/DB.class.php');

$page = new StaticHTML();
$dbc = new DB();
$db = $dbc->getDatabaseConnection();

if (isset($_POST["nutzer"])) {
    $nutzer = filter_input(INPUT_POST, 'nutzer', FILTER_SANITIZE_STRING);
    $passwort = filter_input(INPUT_POST, 'passwort', FILTER_SANITIZE_STRING);
    $stmt = "SELECT * FROM user WHERE username = '$nutzer' AND password = '$passwort'";
    $result = $db->query($stmt);
    if ($db->affected_rows > 0) {
        //COOKIE SETZEN
        session_start();
        $secret = md5(mt_rand(1,999999));
        $stmt = "UPDATE user SET cookie = '$secret', lastlogin = NOW() WHERE username = '$nutzer'";
        $db->query($stmt);
        $_SESSION['user'] = $secret;
        //WEITERLEITEN
        header('Location: index.php');
    } else {
        $error = true;
        session_destroy();
    }
}

print $page->head("Login");

print '<div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="expand: true">
<div class="uk-flex uk-flex-column uk-flex-middle uk-animation-slide-top">
    <h1 class="uk-heading-large">Forum</h1>';
 
if ($error) {
    print '<div class="uk-alert-danger" uk-alert>
        <p>Die von Dir eingegebenen Daten sind fehlerhaft. Bitte korrigiere sie.</p>
    </div>';
}
    print '
    <form action="login.php" method="POST">

        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input" type="text" name="nutzer" aria-label="Not clickable icon">
            </div>
        </div>
    
        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input" type="password" name="passwort" aria-label="Not clickable icon">
            </div>
        </div>
        <div class="uk-margin">
            <div class="uk-inline">
                <button class="uk-button uk-button-primary uk-width-1-1">Anmelden</button>
            </div>
        </div>

    </form>
</div>
</div>';


print $page->foot();
