<?php $title = "Profil"; ?>
<?php $h1="Mon Profil"; ?>
<?php $isSidebar="isSidebar"; ?>
<?php require('../../fonctions.php'); ?>
<?php
session_start();
?>
<?php ob_start(); ?>
<?php
if (isset($_POST["Modifier"]) && isset($_FILES["avatar"])) {
    $targetDirectory = "../../src/images/";
    $targetFile = $targetDirectory . basename($_FILES["avatar"]["name"]);
    $uploadSuccess = move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
    if($uploadSuccess){
        $_SESSION["avatar"] = $targetFile;
    }else{
        echo "Erreur lors de l'upload";
        $targetFile= null;
    }
    if(isset($_POST['Modifier'])){
        updateUser($_POST, $targetFile);
    }
}else if(isset($_POST["Modifier"])){
    if(isset($_POST['Modifier'])){
        updateUser($_POST, null);
    }
}
// echo "<form class='formulaire' action='index.php' method='post'>
// <div>
//     <button type='submit' name='formUtilisateur' value='formUtilisateur' />
//     Ajouter un utilisateur
//     </button>
// </div>
// </form>";
require_once("userProfileForm.php");
?>
<?php
    if ($_SESSION['role'] != 'admin'){
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