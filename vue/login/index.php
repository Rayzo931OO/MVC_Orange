<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$title = "Accueil Orange Tech";
$h1 = "Pour vous identifier";
define('BASE_PATH', str_replace('\vue\login', "\\", __DIR__));
ob_start();
session_start();
require_once("../../controller/User/userController.php");
require_once("../../controller/Connexion/connexionController.php");
$connexionController = new ControllerConnexion();
$userController = new ControllerUser($connexionController->getPDO());

if (!isset($_SESSION['email'])) {
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
            $_SESSION['email'] = $unUser['email'];
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['prenom'] = $unUser['prenom'];
            $_SESSION['role'] = $unUser['role'];
            $_SESSION["telephone"] = $unUser["telephone"];
            $_SESSION["adresse"] = $unUser["adresse"];
            $_SESSION["code_postal"] = $unUser["code_postal"];
            $_SESSION["id"] = $unUser["id_utilisateur"];
            // $_SESSION["avatar"] = $unUser["avatar"];
            //recharger la page
            header("Location: ../profil");
        }
    } else if (isset($_POST['sInscrire'])) {
        // var_dump($_POST);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['mot_de_passe'];
        $role= "client";

        $_POST['role'] = $role;

        // var_dump($_POST);
        try{
            $userController->ajouterUser($_POST);


        }catch(PDOException $exp){
            echo $exp;
        }
        $unUser = $connexionController->verifConnexion($email, $password);
        if ($unUser == null) {
            echo "<br/> Veuillez vérifier vos identifiants";
        } else {
            // echo "Bienvenue " . $unUser['nom'] . "  " . $unUser['prenom'];
            // sauvegarder les données dans la session
            $_SESSION['email'] =$unUser['email'];
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['prenom'] = $unUser['prenom'];
            $_SESSION['role'] = $unUser['role'];
            $_SESSION["telephone"] = $unUser["telephone"];
            $_SESSION["adresse"] = $unUser["adresse"];
            $_SESSION["code_postal"] = $unUser["code_postal"];
            $_SESSION["id"] = $unUser["id_utilisateur"];
            //recharger la page
            //recharger la page
            header("Location: ../profil");
        }
    }
} else {
    header("Location: ../profil");
    // echo "Bienvenue " . $_SESSION['nom'] . "  " . $_SESSION['prenom'];
}
?>

<details class="inscription" open>
    <summary class="inscription_summary">Crée votre compte
        <svg xmlns="http://www.w3.org/2000/svg" width="23.616" height="13.503" viewBox="0 0 23.616 13.503">
            <path id="Icon_ionic-ios-arrow-forward" data-name="Icon ionic-ios-arrow-forward" d="M20.679,18,11.742,9.07a1.681,1.681,0,0,1,0-2.384,1.7,1.7,0,0,1,2.391,0L24.258,16.8a1.685,1.685,0,0,1,.049,2.327L14.14,29.32a1.688,1.688,0,0,1-2.391-2.384Z" transform="translate(29.813 -11.246) rotate(90)" fill="#ff8000" />
        </svg>
    </summary>
    <form action="index.php" method="post">
        <div>
            <input type="email" class="peer" name="email" id="email" placeholder=" " required />
            <label for="email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail</label>
        </div>
        <!-- SELECT -->
        <!-- <div>
            <span for="sexe" class="">Sexe : </span>
            <select name="sexe" id="sexe" class="" required>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select>
        </div> -->
        <div>
            <input type="text" role="number" class="peer" name="telephone" id="telephone" placeholder=" " required />
            <label for="telephone" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">N° de mobile Orange</label>
        </div>
        <div>
            <input type="password" class="peer" name="mot_de_passe" placeholder=" " id="mot_de_passe" required />
            <label for="mot_de_passe" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Mot de passe</label>
        </div>
        <div>
            <input type="password" class="peer" name="passwordConfirm" placeholder=" " id="passwordConfirm" required />
            <label for="passwordConfirm" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Confirmation du mot de passe</label>
        </div>
        <div>
            <input type="text" class="peer" name="nom" id="nom" placeholder=" " required />
            <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
        </div>
        <div>
            <input type="text" class="peer" name="prenom" id="prenom" placeholder=" " required />
            <label for="prenom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Prénom</label>
        </div>
        <div>
            <input type="text" class="peer" name="adresse" id="adresse" placeholder=" " required />
            <label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse</label>
        </div>
        <div>
            <input type="number" class="peer" name="code_postal" id="code_postal" placeholder=" " required />
            <label for="code_postal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal</label>
        </div>
        <div>
            <button type="submit" name="sInscrire" value="S'inscrire" />
            S'inscrire
            </button>
        </div>
    </form>
</details>
<details class="connection">
    <summary class="connection_summary">Compte déjà existant
        <svg xmlns="http://www.w3.org/2000/svg" width="23.616" height="13.503" viewBox="0 0 23.616 13.503">
            <path id="Icon_ionic-ios-arrow-forward" data-name="Icon ionic-ios-arrow-forward" d="M20.679,18,11.742,9.07a1.681,1.681,0,0,1,0-2.384,1.7,1.7,0,0,1,2.391,0L24.258,16.8a1.685,1.685,0,0,1,.049,2.327L14.14,29.32a1.688,1.688,0,0,1-2.391-2.384Z" transform="translate(29.813 -11.246) rotate(90)" fill="#ff8000" />
        </svg>

    </summary>
    <form action="index.php" method="post">
        <div>
            <input type="email" class="peer" name="email" id="connection_email" placeholder=" " required />
            <label for="connection_email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail</label>
        </div>
        <div>
            <input type="password" class="peer" name="password" placeholder=" " id="connection_password" required />
            <label for="connection_password" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Mot de passe</label>
        </div>
        <div>
            <button type="submit" name="seConnecter" value="Se connecter">Se connecter</button>
        </div>
    </form>
</details>
<script src="/mvc_orange/templates/formConnexion/index.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>