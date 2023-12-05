<?php $title = 'Utilisateurs'; ?>
<?php $h1 = 'Utilisateurs'; ?>
<?php $isSidebar = 'isSidebar'; ?>
<?php require('../../fonctions.php'); ?>
<?php
session_start();
?>
<?php ob_start(); ?>
<?php
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
}
if (isset($_POST['ajouterUtilisateur'])) {
    $newUser = $_POST;
    if ($newUser["role"] == 'client') {
        insertClient($newUser);
    } else if ($newUser["role"] == 'technicien') {
        insertTechnicien($newUser);
    }
}
if (isset($_POST['Modifier'])) {
    updateUser($_POST, $_POST['avatar']);
    header('Location: index.php');
}
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
    switch ($action) {
        case 'edit':
            $user = selectUserById($id);
            require_once('editUserForm.php');
            break;
        case 'delete':
            deleteUserById($id);
            header('Location: index.php');
            break;
        default:
            # code...
            break;
    }
} else {
    echo "<form class='formulaire' action='index.php' method='post'>
    <div>
        <button type='submit' name='formUtilisateur' value='formUtilisateur' />
        Ajouter un utilisateur
        </button>
    </div>
</form>";
    if (isset($_POST['formUtilisateur'])) {
        require_once('createUserForm.php');
    } else {
        $users = selectAllUser();
        require_once('allUsers.php');
    }
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>