<?php
//  variables de la page d'accueil
$title = "Accueil Orange Tech";
$h1 = "Pour vous identifier";

// start du buffer qui va contenir les vues tell que le header,
// le footer, la page d'accueil, etc...
ob_start();
session_start();
define('BASE_PATH', str_replace('', "\\", __DIR__));
require_once("controller/User/userController.php");
require_once("controller/Connexion/connexionController.php");
$connexionController = new ControllerConnexion();
$userController = new ControllerUser($connexionController->getPDO());
?>
<?php
if (!isset($_SESSION['email'])) {
    require_once("vue/accueil/index.php");
    if (isset($_POST['seConnecter'])) {
        $email = $_POST['email'];
        $mdp = $_POST['password'];

        $unUser = $connexionController->verifConnexion($email, $mdp);
        echo '<pre>' . $unUser . '</pre>';
        if ($unUser == null) {
            echo "<br/> Veuillez vérifier vos identifiants";
        } else {
            echo "Bienvenue " . $unUser['nom'] . "  " . $unUser['prenom'];
            // sauvegarder les données dans la session
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['prenom'] = $unUser['prenom'];
            $_SESSION['role'] = $unUser['role'];
            $_SESSION["telephone"] = $unUser["telephone"];
            $_SESSION["adresse"] = $unUser["adresse"];
            $_SESSION["codePostal"] = $unUser["code_postal"];
            $_SESSION["id"] = $unUser["id_utilisateur"];
            $_SESSION["avatar"] = $unUser["avatar"];
            //recharger la page
            header("Location: vue/profil/");
        }
    } else if (isset($_POST['sInscrire'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userController->ajouterUser($_POST);
        $unUser = $connexionController->verifConnexion($email, $mdp);
        if ($unUser == null) {
            echo "<br/> Veuillez vérifier vos identifiants";
        } else {
            // echo "Bienvenue " . $unUser['nom'] . "  " . $unUser['prenom'];
            // sauvegarder les données dans la session
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['prenom'] = $unUser['prenom'];
            $_SESSION['role'] = $unUser['role'];
            //recharger la page
            //recharger la page
            header("Location: vue/profil/");
        }
    }
} else {
    header("Location: vue/profil/");
    // echo "Bienvenue " . $_SESSION['nom'] . "  " . $_SESSION['prenom'];
}
?>
<!--
    Fin du buffer qui va contenir les vues tell que le header,
// le footer, la page d'accueil, etc...
-->
<?php $content = ob_get_clean(); ?>
<!-- importation du composent de "model de vue" qui agence tout les autre elements -->
<?php require('./templates/layout.php') ?>