<?php
$title = 'Utilisateurs';
$h1 = 'Utilisateurs';
$isSidebar = 'isSidebar';
ob_start();
session_start();
require_once("../../controller/User/userController.php");
require_once("../../controller/Connexion/connexionController.php");
$connexionController = new ControllerConnexion();
$userController = new ControllerUser($connexionController->getPDO());
?>
<?php
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
}
if (isset($_POST['ajouterUtilisateur'])) {
    $userController->ajouterUser($_POST);
}
if (isset($_POST['Modifier'])) {
    $userController->updateUser($_POST, null);
    // var_dump($result);
    header('Location: index.php');
}
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
    switch ($action) {
        case 'edit':
            $user = $userController->selectUserById($id);
            require_once('editUserForm.php');
            break;
        case 'delete':
            $userController->deleteUserById($id);
            header('Location: index.php');
            break;
        default:
            # code...
            break;
    }
} else {
    if (isset($_POST['formUtilisateur'])) {
        require_once('createUserForm.php');
    } else {
        echo "<form class='formulaire' action='index.php' method='post'>
        <div>
            <button type='submit' name='formUtilisateur' value='formUtilisateur' />
            Ajouter un utilisateur
            </button>
        </div>
    </form>";
        $users = $userController->allUsers();
        require_once('allUsers.php');
    }
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>