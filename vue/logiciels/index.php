<?php $title = "Logiciels";
$h1 = "Listes des logiciels";
$isSidebar = "isSidebar";
session_start();
ob_start();
require_once("../../controller/Connexion/connexionController.php");
require_once("../../controller/Logiciel/logicielController.php");
require_once("../../controller/Categorie/categorieController.php");
$connexionController = new ControllerConnexion();
$logicielController = new ControllerLogiciel($connexionController->getPDO());
$categorieController = new ControllerCategorie($connexionController->getPDO());

?>
<?php
$IsDisabled = "";
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
    switch ($action) {
        case 'edit':
            $logiciel = $logicielController->selectLogicielById($id);
            require_once('editLogicielForm.php');
            break;
        case 'delete':
            $logicielController->deleteLogicielById($id);
            header('Location: index.php');
            break;
        default:
            # code...
            break;
    }
} else {
    if (isset($_POST['formLogiciel'])) {
        if (substr($_SESSION["role"], 0, 5) == "admin" || $_SESSION["role"] == "technicien") {
        //     echo '
        //   <form class="formulaire" action="index.php" method="post">
        //       <div>
        //           <input type="text" class="peer" name="search" placeholder=" " id="search" required />
        //           <label for="search" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un utilisateur :</label>
        //       </div>
        //       <div>
        //           <button type="submit" id="Recherchez" name="Recherchez" value="Recherchez">Recherchez</button>
        //       </div>
        //   </form>
        //   ';
        } else {
            $tableau = '<div>
          <input type="hidden" name="id" id="id" value="' . $_SESSION["id"] . '" placeholder=" " required />
          </div>';
          require_once('logicielForm.php');
        }
    }
    if (isset($_POST["Recherchez"])) {
        $tableau = "";
        // $users = selectLikeUser($_POST["search"], "client");
        // $tableau = "<br><table class='tableau' border-collapse='collapse'>
        //  <caption class='caption'>Un seul et unique client peut-être sélectionné</caption>
        //  <thead>
        //      <tr>
        //          <th>Sélection</th>
        //          <th>Nom</th>
        //          <th>Prénom</th>
        //          <th>Email</th>
        //          <th>Téléphone</th>
        //      </tr>
        //  </thead>
        //  <tbody>";
        // foreach ($users as $user) {
        //     $tableau = $tableau . "<tr>
        //              <td><input type='checkbox' value='" . $user['id'] . "' name='id' id='id' ></td>
        //               <td>" . $user['prenom'] . "</td>
        //               <td>" . $user['email'] . "</td>
        //               <td>" . $user['telephone'] . "</td></tr>";
        // }
        // $tableau = $tableau . "</tbody></table>";
        // require_once('logicielForm.php');
    } else {
        // $IsDisabled = "disabled";
    }
    if (!isset($_POST["formLogiciel"]) && !isset($_POST["Recherchez"])) {
        echo "<form class='formulaire' action='index.php' method='post'>
        <div>
            <button type='submit' name='formLogiciel' value='formLogiciel' />
            Ajouter un logiciel
            </button>
        </div>
        </form>";
        $logiciels = $logicielController->AllLogiciel();
        require_once('allLogiciels.php');
    }else {
        $tableau = "";
        require_once('logicielForm.php');
        $IsDisabled = "";
    }
    if (isset($_POST["Ajoutez"])) {
        $logicielController->ajouterLogiciel($_POST);
        header('Location: index.php');
    }
}
if (isset($_POST['Modifier'])) {
    $logicielController->updateLogiciel($_POST);
    header('Location: index.php');
}
?>
<?php $content = ob_get_clean(); ?>
<?php require_once '../../templates/layout.php' ?>