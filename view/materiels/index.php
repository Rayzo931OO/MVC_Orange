<?php $title = "Materiels"; ?>
<?php $h1 = "Listes des materiels"; ?>
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
            $materiel = selectMaterielById($id);
            require_once('editMaterielForm.php');
            break;
        case 'delete':
            deleteMaterielById($id);
            header('Location: index.php');
            break;
        default:
            # code...
            break;
    }
} else {
    if (isset($_POST['formMateriel'])) {
        if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "technicien") {
            echo '
          <form class="formulaire" action="index.php" method="post">
              <div>
                  <input type="text" class="peer" name="search" placeholder=" " id="search" required />
                  <label for="search" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Chercher un utilisateur :</label>
              </div>
              <div>
                  <button type="submit" id="Recherchez" name="Recherchez" value="Recherchez">Recherchez</button>
              </div>
          </form>
          ';
        } else {
            $tableau = '<div>
          <input type="hidden" name="id" id="id" value="' . $_SESSION["id"] . '" placeholder=" " required />
          </div>';
          require_once('materielForm.php');
        }
    }
    if (isset($_POST["Recherchez"])) {
        $users = selectLikeUser($_POST["search"], "client");
        $tableau = "<br><table class='tableau' border-collapse='collapse'>
         <caption class='caption'>Un seul et unique client peut-être sélectionné</caption>
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
        foreach ($users as $user) {
            $tableau = $tableau . "<tr>
                     <td><input type='checkbox' value='" . $user['id'] . "' name='id' id='id' ></td>
                      <td>" . $user['nom'] . "</td>
                      <td>" . $user['prenom'] . "</td>
                      <td>" . $user['email'] . "</td>
                      <td>" . $user['telephone'] . "</td></tr>";
        }
        $tableau = $tableau . "</tbody></table>";
        require_once('materielForm.php');
    } else {
        $IsDisabled = "disabled";
    }
    if (!isset($_POST["formMateriel"]) && !isset($_POST["Recherchez"])) {
        echo "<form class='formulaire' action='index.php' method='post'>
        <div>
            <button type='submit' name='formMateriel' value='formMateriel' />
            Ajouter un materiel
            </button>
        </div>
        </form>";
        $materiels = selectAllMateriel();
        require_once('allMateriels.php');
    }
    if (isset($_POST["Ajoutez"])) {
        insertMateriel($_POST);
    }
}
if (isset($_POST['Modifier'])) {
    updateMateriel($_POST);
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>