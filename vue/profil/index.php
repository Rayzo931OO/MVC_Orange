<?php
$title = "Profil";
$h1 = "Mon Profil";
$isSidebar = "isSidebar";
define('BASE_PATH', str_replace('\vue\profil', "\\", __DIR__));
ob_start();
session_start();
require_once("../../controller/User/userController.php");
require_once("../../controller/Connexion/connexionController.php");
$connexionController = new ControllerConnexion();
$userController = new ControllerUser($connexionController->getPDO());
?>
<?php
if (isset($_POST["Modifier"])) {
    var_dump($_POST);   
        $userController->updateUser($_POST, null);
    }
if (isset($_POST["Supprimer"])) {
    $userController->deleteUserById($_SESSION["id"]);
    $userController->userLogout();
    header('Location: ../../index.php');
}
require_once("userProfileForm.php");
if (substr($_SESSION["role"], 0, 5) !== "admin") {
    echo '<form class="formulaire" action="" method="post">
        <div>
            <button type="submit" id="Supprimer" name="Supprimer">Supprimer mon compte</button>
        </div>
    </form>';
}
?>
<script src="./index.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>