<?php
// Assuming you have autoloaders or require statements for your controllers
$today = getdate();
$currentMateriel = $materielController->selectMaterielById($intervention['id_materiel']);
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];

$dateTimeDebut = new DateTime($intervention["date_inter"]);
$formattedDateTimeDebut = $dateTimeDebut->format("Y-m-d\TH:i:s");

$assigned = false;
$isAdmin = false;
if (substr($_SESSION["role"], 0, 5) == "admin" || $_SESSION["role"] == "superviseur") {
    $isAdmin = true;
}
if ($_SESSION["role"] == "technicien") {
    $isAdmin = false;
    $currentTechnicien = $userController->selectTechnicienById($_SESSION["id"]);
    if ($currentTechnicien["id_utilisateur"] == $intervention["id_technicien"]) {
        $assigned = true;
    }
}

$formEnabled = $isAdmin || $assigned;

echo '<form class="formulaire" action="" method="post">
<div>
    <input type="hidden" name="id_intervention" id="id_intervention" value="' . $intervention["id_intervention"] . '" required />
</div>
<div>
    <input type="hidden" name="id_technicien" id="id_technicien" value="' . $intervention["id_technicien"] . '" required />
</div>';

function generateSelectOptions($items, $currentItem, $idField, $nameField) {
    $options = '';
    foreach ($items as $item) {
        $selected = $item[$idField] == $currentItem[$idField] ? 'selected="true"' : '';
        $options .= '<option value="' . $item[$idField] . '" ' . $selected . '>' . $item[$nameField] . '</option>';
    }
    return $options;
}

echo '<div>
<label for="id_materiel">Le materiel</label></br>
<select name="id_materiel" id="id_materiel" ' . ($formEnabled && ($_SESSION["role"] == "admin" || $_SESSION["role"] == "superviseur" || $_SESSION["role"] == "client") ? '' : 'disabled') . '>
' . generateSelectOptions($materielController->allMateriel(), $currentMateriel, 'id_materiel', 'nom') . '
</select>
</div>';

echo '<div>
    <input type="datetime-local" min="' . $minDate . '" class="peer" value="' . $formattedDateTimeDebut . '" id="date_inter" name="date_inter" ' . ($formEnabled ? 'required' : 'disabled') . '>
    <label for="date_inter" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Date
    </label>
</div>';

echo '<div>
<label for="status">Statut de l\'intervention</label></br>
<select name="status" id="status" ' . ($formEnabled ? 'required' : 'disabled') . '>
    <option value="En cours"' . ($intervention["status"] == "En cours" ? ' selected="true"' : '') . '> En cours </option>
    <option value="Terminer"' . ($intervention["status"] == "Terminer" ? ' selected="true"' : '') . '> Terminer </option>
</select>
</div>';

echo '<div>
<label for="description">Description</label></br>
<textarea id="description" name="description" placeholder="Problème de.... identifier..." ' . ($formEnabled && ($_SESSION["role"] == "admin" || $_SESSION["role"] == "superviseur" || $_SESSION["role"] == "client") ? 'required' : 'disabled') . '>' . $intervention["description"] . '</textarea>
</div>';

echo '<div>
<label for="status">Priorite de l\'intervention</label></br>
<select name="priorite" id="priorite" ' . ($formEnabled ? 'required' : 'disabled') . '>
    <option value="urgente"' . ($intervention["priorite"] == "Urgente" ? ' selected="true"' : '') . '> Urgente </option>
    <option value="mineur"' . ($intervention["priorite"] == "Mineur" ? ' selected="true"' : '') . '> Mineur </option>
</select>
</div>';

if ($formEnabled) {
    echo '<button type="submit" id="Modifier" name="Modifier" value="Modifier">Modifier</button>';
} else {
    echo '<button type="submit" id="Assigner" name="Assigner" value="Assigner">S\'assigner</button>';
}

echo '</form>';