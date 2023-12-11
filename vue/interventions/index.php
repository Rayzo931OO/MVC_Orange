<?php
$title = "Interventions";
$h1 = "Listes des Interventions";
$isSidebar = "isSidebar";
define('BASE_PATH', str_replace('\vue\interventions', "\\", __DIR__));
ob_start();
session_start();
require_once("../../controller/User/userController.php");
require_once("../../controller/Connexion/connexionController.php");
require_once("../../controller/Intervention/interventionController.php");
require_once("../../controller/Intervention/typeInterventionController.php");
require_once("../../controller/Materiel/materielController.php");
require_once("../../controller/logiciel/logicielController.php");
require_once("../../controller/categorie/categorieController.php");
$connexionController = new ControllerConnexion();
$userController = new ControllerUser($connexionController->getPDO());
$interventionsController = new ControllerIntervention($connexionController->getPDO());
$materielController = new ControllerMateriel($connexionController->getPDO());
$logicielController = new ControllerLogiciel($connexionController->getPDO());
$categorieController = new ControllerCategorie($connexionController->getPDO());
$typeInterventionController = new ControllerTypeIntervention($connexionController->getPDO());

?>
<?php
$IsDisabled = "";
if (isset($_POST['Modifier'])) {
    // var_dump($_POST);
    $interventionsController->updateIntervention($_POST);
    header('Location: index.php');
}
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
    switch ($action) {
        case 'edit':
            $intervention = $interventionsController->selectInterventionById($id);
            require_once('editInterventionForm.php');
            break;
        case 'delete':
            $interventionsController->deleteInterventionById($id);
            header('Location: index.php');
            break;
        default:
            # code...
            break;
    }
} else {
    if (isset($_POST['formIntervention'])) {
        if (substr($_SESSION["role"], 0, 5) == "admin") {
            echo '
          <form class="formulaire" action="index.php" method="post">';
            //              echo ' <div>
            //                   <input type="text" class="peer" name="search1" placeholder=" " id="search1" required />
            //                   <label for="search1" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un materiel :</label>
            //               </div>
            // <div>';

            echo '<div>
                  <input type="text" class="peer" name="technicien" placeholder=" " id="technicien" required />
                  <label for="technicien" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un technicien :</label>
              </div>
              <div>
                  <button type="submit" id="RecherchezAdmin" name="RecherchezAdmin" value="RecherchezAdmin">Recherchez</button>
              </div>
          </form>
          ';
        } else if ($_SESSION["role"] == "technicien") {
            echo '
            <form class="formulaire" action="index.php" method="post">
                <div>
                    <input type="text" class="peer" name="search" placeholder=" " id="search" required />
                    <label for="search" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un materiel :</label>
                </div>
                <div>
                    <button type="submit" id="Recherchez" name="Recherchez" value="Recherchez">Recherchez</button>
                </div>
            </form>
            ';
        }
    }
    if (isset($_POST["RecherchezAdmin"])) {
        // $materiels = $materielController->selectLikeMateriel($_POST["search1"]);
        // $materiels = $materielController->selectMaterielById($_POST["materiel"]);
        $techniciens = $userController->selectLikeUser($_POST["technicien"], "technicien");
        $tableau = "";
        // $tableau = "<br><table class='tableau' border-collapse='collapse'>
        // <caption class='caption'>Un seul et unique materiel peut-être sélectionné</caption>
        // <thead>
        //     <tr>
        //         <th>Sélection</th>
        //         <th>Nom</th>
        //         <th>Description</th>
        //         <th>Catégorie</th>
        //     </tr>
        // </thead>
        // <tbody>";
        $tableau2 = "<br><table class='tableau' border-collapse='collapse'>
        <caption class='caption'>Un seul et unique technicien peut-être sélectionné</caption>
        <thead>
            <tr>
                <th>Sélection</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>";
        // $tableau = $tableau . "<tr>
        //     <td><input type='checkbox' value='" . $materiels['id_materiel'] . "' name='materiel_id' id='materiel_id' ></td>
        //     <td>" . $materiels['nom'] . "</td>
        //     <td>" . $materiels['description'] . "</td>
        //     <td>" . $categorieController->selectCategorieById($materiels['id_categorie'])["nom"] . "</td>";
        // foreach ($materiels as $materiel) {

        // $tableau = $tableau . "<tr>
        // <td><input type='checkbox' value='" . $materiel['id_materiel'] . "' name='materiel_id' id='materiel_id' ></td>
        // <td>" . $materiel['nom'] . "</td>
        // <td>" . $materiel['description'] . "</td>
        // <td>" . $materiel['categorie'] . "</td>";
        // }
        foreach ($techniciens as $technicien) {
            $tableau2 = $tableau2 . "<tr>
            <td><input type='checkbox' value='" . $userController->selectTechnicienById($technicien['id_utilisateur'])["id_technicien"] . "' name='id_technicien' id='id_technicien' ></td>
            <td>" . $technicien['nom'] . "</td>
            <td>" . $technicien['prenom'] . "</td>
            <td>" . $technicien['email'] . "</td>
            <td>" . $technicien['telephone'] . "</td>";
        }
        $tableau = $tableau . "</tbody></table>";
        $tableau2 = $tableau2 . "</tbody></table>";

        $tableau = $tableau . $tableau2;
        require_once('interventionForm.php');
    } else {
        $IsDisabled = "disabled";
    }
    if (isset($_POST["Recherchez"])) {
        $materiels = $materielController->selectMaterielById($_POST["materiel"]);
        $tableau = "<br><table class='tableau' border-collapse='collapse'>
        <caption class='caption'>Un seul et unique materiel peut-être sélectionné</caption>
        <thead>
            <tr>
                <th>Sélection</th>
                <th>Client</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($materiels as $materiel) {
            $tableau = $tableau . "<tr>
            <td><input type='checkbox' value='" . $materiel['id_materiel'] . "' name='id_materiel' id='id_materiel' ></td>
            <td>" . $materiel['nom'] . "</td>
            <td>" . $materiel['description'] . "</td>
            <td>" . $materiel['categorie'] . "</td>";
        }
        $tableau = $tableau . "</tbody></table>";
        require_once('interventionForm.php');
    } else {
        $IsDisabled = "disabled";
    }
    if (!isset($_POST["formIntervention"]) && !isset($_POST["Recherchez"]) && !isset($_POST["RecherchezAdmin"])) {
        echo "<form class='formulaire' action='index.php' method='post'>
        <div>
            <button type='submit' name='formIntervention' value='formIntervention' />
            Ajouter une Intervention
            </button>
        </div>
        </form>";

        // FILTRE DEBUT ------------------------------------


        // echo '
        // <div class="filters">
        // <form class="formulaire" action="index.php" method="post">
        // <div style="display:grid;grid-auto-flow: column;align-items: center;gap: 20px;">
        //     <div>
        //     <input type="date" class="peer" id="date_debut_filter" name="date_debut_filter" placeholder=" " required>
        //     <label for="date_debut_filter" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        //         Debut
        //     </label>
        //     </div>
        //     <button class="filter_btn" type="submit" name="filter" value="filter">
        //     ✅
        //     </button>
        // </div></form>';
        // echo '
        // <form class="formulaire" action="index.php" method="post">
        // <div style="display:grid;grid-auto-flow: column;align-items: center;gap: 20px;">
        // <div>
        //     <input type="date" class="peer" id="date_fin_filter" name="date_fin_filter" placeholder=" " required>
        //     <label for="date_fin_filter" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        //         Fin
        //     </label>
        //     </div>
        //     <button class="filter_btn" type="submit" name="filter" value="filter">
        //     ✅
        //     </button>
        // </div>
        // </form>';
        // echo '
        // <form class="formulaire" action="index.php" method="post">
        //     <div style="display:grid;grid-auto-flow: column;align-items: center;gap: 20px;">
        //     <div>
        //         <label for="status">Statut de l\'intervention</label></br>
        //         <select name="status_filter" id="status_filter" required>
        //             <option value="En cours"> En cours </option>
        //             <option value="Terminer"> Terminer </option>
        //         </select>
        //         </div>
        //         <button class="filter_btn" type="submit" name="filter" value="filter">
        //         ✅
        //         </button>
        //     </div>
        // </form></div>';


        // FILTRE FIN ------------------------------------

        switch(true){
            case isset($_POST["date_debut_filter"]):
                $interventions = $interventionsController->selectLikeInterventionDateDebut($_POST["date_debut_filter"]);
                break;
            case isset($_POST["date_fin_filter"]):
                $interventions = $interventionsController->selectLikeInterventionDateFin($_POST["date_fin_filter"]);
                break;
            case isset($_POST["status_filter"]):
                $interventions = $interventionsController->selectLikeInterventionStatus($_POST["status_filter"]);
                break;
            default:
            if (substr($_SESSION["role"], 0, 5) == "admin") {
                $interventions = $interventionsController->allIntervention();
            } else if ($_SESSION["role"] == "technicien") {
                $interventions = $interventionsController->selectInterventionByTechnicien($_SESSION["id"]);
            } else if ($_SESSION["role"] == "client") {
                $interventions = $interventionsController->selectInterventionByUserId($_SESSION["id"]);
            }
                break;
        }

        require_once('allInterventions.php');
    }
    if (isset($_POST["Ajoutez"])) {
        $interventionsController->ajouterIntervention($_POST);
        header('Location: index.php');
    }
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>