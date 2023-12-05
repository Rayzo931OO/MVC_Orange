<?php $title = "Interventions"; ?>
<?php $h1 = "Listes des Interventions"; ?>
<?php $isSidebar = "isSidebar"; ?>
<?php require('../../fonctions.php'); ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<?php
$IsDisabled = "";
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
    switch ($action) {
        case 'edit':
            $intervention = selectInterventionById($id);
            require_once('editInterventionForm.php');
            break;
        case 'delete':
            deleteInterventionById($id);
            header('Location: index.php');
            break;
        default:
            # code...
            break;
    }
} else {
    if (isset($_POST['formIntervention'])) {
        if ($_SESSION["role"] == "admin") {
            echo '
          <form class="formulaire" action="index.php" method="post">
              <div>
                  <input type="text" class="peer" name="search1" placeholder=" " id="search1" required />
                  <label for="search1" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un materiel :</label>
              </div>
              <div>
                  <input type="text" class="peer" name="search2" placeholder=" " id="search2" required />
                  <label for="search2" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un technicien :</label>
              </div>
              <div>
                  <button type="submit" id="RecherchezAdmin" name="RecherchezAdmin" value="RecherchezAdmin">Recherchez</button>
              </div>
          </form>
          ';
        }else if($_SESSION["role"] == "technicien"){
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
        $materiels = selectLikeMateriel($_POST["search1"]);
        $techniciens = selectLikeUser($_POST["search2"], "technicien");
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
        foreach ($materiels as $materiel) {
            $client = selectUserById($materiel['client_id']);
            $tableau = $tableau . "<tr>
            <td><input type='checkbox' value='" . $materiel['id'] . "' name='materiel_id' id='materiel_id' ></td>
            <td>" . $client['email'] . "</td>
            <td>" . $materiel['nom'] . "</td>
            <td>" . $materiel['description'] . "</td>
            <td>" . $materiel['categorie'] . "</td>";
        }
        foreach ($techniciens as $technicien) {
            $tableau2 = $tableau2 . "<tr>
            <td><input type='checkbox' value='" . $technicien['id'] . "' name='technicien_id' id='technicien_id' ></td>
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
        $materiels = selectLikeMateriel($_POST["search1"]);
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
            $client = selectUserById($materiel['client_id']);
            $tableau = $tableau . "<tr>
            <td><input type='checkbox' value='" . $materiel['id'] . "' name='idmateriel_id' id='materiel_id' ></td>
            <td>" . $client['email'] . "</td>
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
        if ($_SESSION["role"] == "admin") {
            $interventions = selectAllIntervention();
        }else if ($_SESSION["role"] == "technicien") {
            $interventions = selectInterventionByTechnicien($_SESSION["id"]);
        }else if ($_SESSION["role"] == "client") {
            $interventions = selectInterventionByClient($_SESSION["id"]);
        }
        require_once('allInterventions.php');
    }
    if (isset($_POST["Ajoutez"])) {
        insertIntervention($_POST);
    }
}
if (isset($_POST['Modifier'])) {
    updateIntervention($_POST);
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>