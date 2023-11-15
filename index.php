<?php
$title = "Accueil Orange Tech";
$h1 = "Pour vous identifier";
ob_start();
session_start();
?>
<?php
if (!isset($_SESSION['email'])) {
    require_once("./templates/formConnexion/form_connexion.php");
    require_once("./fonctions.php");
    if (isset($_POST['seConnecter'])) {
        $email = $_POST['email'];
        $mdp = $_POST['password'];

        $unUser = selectWhereUser($email, $mdp);
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
            $_SESSION["codePostal"] = $unUser["codePostal"];
            $_SESSION["id"] = $unUser["id"];
            $_SESSION["avatar"] = $unUser["avatar"];
            //recharger la page
            header("Location: account/profil/");
        }
    } else if (isset($_POST['sInscrire'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        insertClient($_POST);
        $unUser = selectWhereUser($email, $password);
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
            header("Location: account/profil/");
        }
    }
} else {
    header("Location: account/profil/");
    // echo "Bienvenue " . $_SESSION['nom'] . "  " . $_SESSION['prenom'];
}
// if (isset($_POST['seConnecter'])) {
//     $email = $_POST['email'];
//     $mdp = $_POST['mdp'];

//     $unUser = selectWhereUser($email, $mdp);
//     if ($unUser == null) {
//         echo "<br/> Veuillez vérifier vos identifiants";
//     } else {
//         echo "Bienvenue " . $unUser['nom'] . "  " . $unUser['prenom'];
//         //sauvegarder les données dans la session
//         $_SESSION['email'] = $email;
//         $_SESSION['nom'] = $unUser['nom'];
//         $_SESSION['prenom'] = $unUser['prenom'];
//         $_SESSION['role'] = $unUser['role'];
//         //recharger la page
//         header("Location: index.php");
//     }
// }
// if (isset($_SESSION['email'])) {
//     echo '
// 				<a href="index.php?page=0"> Accueil
// 				<img src="images/logo.png" width="80" height="80"></a>
// 				<a href="index.php?page=1"> Produits
// 				<img src="images/produit.png" width="80" height="80"></a>
// 				<a href="index.php?page=2"> Fournisseurs
// 				<img src="images/fournisseur.jpeg" width="80" height="80"></a>
// 				<a href="index.php?page=3"> Livraisons
// 				<img src="images/livraison.png" width="80" height="80"></a>
// 				<a href="index.php?page=4"> Déconnexion
// 				<img src="images/deconnexion.jpeg" width="80" height="80"></a>
// 				';

//     if (isset($_GET['page'])) {
//         $page = $_GET['page'];
//     } else {
//         $page = 0;
//     }
//     switch ($page) {
//         case 0:
//             require_once("home.php");
//             break;
//         case 1:
//             require_once("gestion_produits.php");
//             break;
//         case 2:
//             require_once("gestion_fournisseurs.php");
//             break;
//         case 3:
//             require_once("gestion_livraisons.php");
//             break;
//         case 4: //retirer email de la session
//             unset($_SESSION['email']);
//             //detuire la session
//             session_destroy();
//             //recharge la page index
//             header("Location: index.php");
//             break;
//     }
// }
?>
<?php $content = ob_get_clean(); ?>
<?php require('./templates/layout.php') ?>