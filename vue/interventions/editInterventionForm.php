<?php
$today = getdate();
$currentMateriel = $materielController->selectMaterielById($intervention['id_materiel']);
$currentLogiciel = $logicielController->selectLogicielById($intervention['id_logiciel']);
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];

$dateTimeDebut = new DateTime($intervention["date_inter"]);
$formattedDateTimeDebut = $dateTimeDebut->format("Y-m-d\TH:i:s");

$assigned = false;
$isAdmin = false;
if (substr($_SESSION["role"], 0, 5) == "admin") {
    $isAdmin = true;
}
if ($_SESSION["role"] == "technicien") {
    $isAdmin = false;
    $currentTechnicien = $userController->selectTechnicienById($_SESSION["id"]);
    if ($currentTechnicien["id_utilisateur"] == $intervention["id_utilisateur"]) {
        $assigned = true;
    }
}


if ($isAdmin) {
    $assigned = true;
    echo '<form class="formulaire" action="" method="post">
<div>
          <input type="hidden" name="id_intervention" id="id_intervention" value="' . $intervention["id_intervention"] . '" placeholder=" " required />
          </div>
<div>
<div>
          <input type="hidden" name="id_technicien" id="id_technicien" value="' . $intervention["id_technicien"] . '" placeholder=" " required />
          </div>
<div>';
    // echo '<div>
    //     <input type="text" class="peer" id="nom" name="id_materiel" value="' . $currentMateriel["id_materiel"] . '" placeholder=" " required>
    //     <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    //         Le materiel
    //     </label>
    // </div>';


    if ($currentMateriel != false) {
        echo '<div>
<label for="id_materiel">Le materiel</label></br>
<select name="id_materiel" id="id_materiel" value="' . $currentMateriel["id_materiel"] . '" >';
        foreach ($materielController->allMateriel() as $materiel) {
            echo '<option value="' . $materiel["id_materiel"] . '"';
            if ($currentMateriel["id_materiel"] == $materiel["id_materiel"]) {
                echo 'selected="true">';
            } else {
                echo '>';
            }
            echo $materiel["nom"] . '</option>';
        }
        echo '</select></div>';
    } else {
        echo '<div>
    <label for="id_materiel">Le materiel</label></br>
    <select name="id_materiel" id="id_materiel" value="" required>';
        foreach ($materielController->allMateriel() as $materiel) {
            echo '<option value="' . $materiel["id_materiel"] . '">' . $materiel["nom"] . '</option>';
        }
        echo '</select></div>';
    }

    if ($currentLogiciel != false) {
        # code...
        echo '<div>
    <label for="id_materiel">Le logiciel</label></br>
    <select name="id_logiciel" id="id_logiciel" value="' . $currentLogiciel["id_logiciel"] . '">';
        foreach ($logicielController->allLogiciel() as $logiciel) {
            echo '<option value="' . $materiel["id_logiciel"] . '"';
            if ($currentLogiciel["id_logiciel"] == $logiciel["id_logiciel"]) {
                echo 'selected="true">';
            } else {
                echo '>';
            }
            echo $logiciel["nom"] . '</option>';
        }
        echo '</select></div>';
    } else {
        echo '<div>
    <label for="id_materiel">Le logiciel</label></br>
    <select name="id_logiciel" id="id_logiciel" value="" required>';
        foreach ($logicielController->allLogiciel() as $logiciel) {
            echo '<option value="' . $logiciel["id_logiciel"] . '">' . $logiciel["nom"] . '</option>';
        }
        echo '</select></div>';
    }
    // echo '<div>
    //     <input type="text" class="peer" id="fournisseur" name="fournisseur" value="' . $intervention["fournisseur"] . '" placeholder=" " required>
    //     <label for="fournisseur" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    //         Le fournisseur
    //     </label>
    // </div>';
    echo '<div>
    <input type="datetime-local" min="' . $minDate . '" class="peer" value="' . $formattedDateTimeDebut . '" id="date_inter" name="date_inter" placeholder=" " required>
    <label for="date_inter" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Date
    </label>
</div>';
    echo '<div><label for="status">Statut de l\'intervention</label></br>
<select name="status" id="status" value="' . $intervention["status"] . '"';
    echo $assigned ? 'required' : 'disabled';
    echo '>';
    if ($intervention["status"] == "En cours") echo "<option selected='true'> En cours </option>";
    else echo "<option> En cours </option>";
    if ($intervention["status"] == "Terminer") echo "<option selected='true'> Terminer </option>";
    else echo "<option> Terminer </option>";
    echo '</div>';

    echo '<div>
    <label for="description">Description</label></br>
    <textarea id="description" name="description" value="' . $intervention["description"] . '" placeholder="Problème de.... identifier..." disabled >' . $intervention["description"] . '</textarea>
</div>
<br>';
    if ($assigned) {
        # code...
        echo '<button type="submit" id="Modifier" name="Modifier" value="Modifier" >Modifier</button>';
    } else {
        # code...
        echo '<button type="submit" id="Assigner" name="Assigner" value="Assigner" >S\'assigner</button>';
    }
    echo '</form>';
} else {
    echo '<form class="formulaire" action="" method="post">
<div>
          <input type="hidden" name="id_intervention" id="id_intervention" value="' . $intervention["id_intervention"] . '" placeholder=" " required />
          </div>
<div>
<div>
          <input type="hidden" name="id_technicien" id="id_technicien" value="' . $intervention["id_technicien"] . '" placeholder=" " required />
          </div>
<div>';
    // echo '<div>
    //     <input type="text" class="peer" id="nom" name="id_materiel" value="' . $currentMateriel["id_materiel"] . '" placeholder=" " required>
    //     <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    //         Le materiel
    //     </label>
    // </div>';


    if ($currentMateriel != false) {
        echo '<div>
<label for="id_materiel">Le materiel</label></br>
<select name="id_materiel" id="id_materiel" value="' . $currentMateriel["id_materiel"] . '" disabled >';
        foreach ($materielController->allMateriel() as $materiel) {
            echo '<option value="' . $materiel["id_materiel"] . '"';
            if ($currentMateriel["id_materiel"] == $materiel["id_materiel"]) {
                echo 'selected="true">';
            } else {
                echo '>';
            }
            echo $materiel["nom"] . '</option>';
        }
        echo '</select></div>';
    }else {
        echo '<div>
    <input type="hidden" name="id_materiel" id="id_materiel" value="">';
        echo '</input></div>';
    }

    if ($currentLogiciel != false) {
        # code...
        echo '<div>
    <label for="id_logiciel">Le logiciel</label></br>
    <select name="id_logiciel" id="id_logiciel" value="' . $currentLogiciel["id_logiciel"] . '"disabled>';
        foreach ($logicielController->allLogiciel() as $logiciel) {
            echo '<option value="' . $materiel["id_logiciel"] . '"';
            if ($currentLogiciel["id_logiciel"] == $logiciel["id_logiciel"]) {
                echo 'selected="true">';
            } else {
                echo '>';
            }
            echo $logiciel["nom"] . '</option>';
        }
        echo '</select></div>';
    }else {
        echo '<div>
    <input type="hidden" name="id_logiciel" id="id_logiciel" value="">';
        echo '</input></div>';
    }

    echo '<div>
    <input type="datetime-local" min="' . $minDate . '" class="peer" value="' . $formattedDateTimeDebut . '" id="date_inter" name="date_inter" placeholder=" "';
    echo $assigned ? 'required' : 'disabled';
    echo '>
    <label for="date_inter" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Date
    </label>
</div>
<div>';
    echo '<div><label for="status">Statut de l\'intervention</label></br>
<select name="status" id="status" value="' . $intervention["status"] . '"';
    echo $assigned ? 'required' : 'disabled';
    echo '>';
    if ($intervention["status"] == "En cours") echo "<option selected='true'> En cours </option>";
    else echo "<option> En cours </option>";
    if ($intervention["status"] == "Terminer") echo "<option selected='true'> Terminer </option>";
    else echo "<option> Terminer </option>";
    echo '</div>';

    echo '<div>
    <label for="description">Description</label></br>
    <textarea id="description" name="description" value="' . $intervention["description"] . '" placeholder="Problème de.... identifier..." required disabled >' . $intervention["description"] . '</textarea>
</div>
<br>';
    if ($assigned) {
        # code...
        echo '<button type="submit" id="Modifier" name="Modifier" value="Modifier" >Modifier</button>';
    } else {
        # code...
        echo '<button type="submit" id="Assigner" name="Assigner" value="Assigner" >S\'assigner</button>';
    }
    echo '</form>';
}
