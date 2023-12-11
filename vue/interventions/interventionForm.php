<?php
$today = getdate();
$type_interventions = $typeInterventionController->allTypeIntervention();
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
echo'<form class="formulaire" action="index.php" method="post">
'.$tableau;

echo '
<div>
    <label for="id_materiel">Les materiels :</label></br>
    <select name="id_materiel" id="id_materiel" required>';
            foreach ($materielController->allMateriel() as $materiel) {
                echo '<option value="' . $materiel["id_materiel"] . '">' . $materiel["nom"] . '</option>';
            }
            echo '</select>
</div>';
echo '
<div>
    <label for="id_logiciel">Les materiels :</label></br>
    <select name="id_logiciel" id="id_logiciel" required>';
            foreach ($logicielController->allLogiciel() as $logiciel) {
                echo '<option value="' . $logiciel["id_logiciel"] . '">' . $logiciel["nom"] . '</option>';
            }
            echo '</select>
</div>';
if($_SESSION["role"] == "technicien"){
    echo '<div>
    <input type="hidden" name="technicien_id" id="technicien_id" value="' . $userController ->selectTechnicienById($_SESSION["id"]) . '" placeholder=" " required />
    </div>';
}
echo '
<div>
    <label for="id_type_intervention">Types d\'intervention :</label></br>
    <select name="id_type_intervention" id="id_type_intervention" required>';
            foreach ($type_interventions as $typeIntervention) {
                echo '<option value="' . $typeIntervention["type_intervention_id"] . '">' . $typeIntervention["type_intervention_nom"] . '</option>';
            }
            echo '</select>
</div>';
echo '
<div>
    <input type="datetime-local" min="'.$minDate.'" class="peer" id="date_debut" name="date_debut" placeholder=" " required>
    <label for="date_debut" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Debut
    </label>
</div>
<div>
<input type="datetime-local" min="'.$minDate.'" class="peer" id="date_fin" name="date_fin" placeholder=" ">
<label for="date_fin" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    Fin
</label>
</div>';
// echo '
// <div>
//     <label for="status">Statut de l\'intervention</label></br>
//     <select name="status" id="status" required>
//         <option value="" disabled selected hidden>le Statut est:</option>
//         <option value="En cours">En cours</option>
//         <option value="Terminer">Terminer</option>
//     </select>
// </div>';

echo '<div>
    <label for="description">Description</label></br>
    <textarea id="description" name="description" placeholder="Problème de.... identifier..." required></textarea>
</div>
<div>
    <input type="hidden" id="status" name="status" value="En cours" required></input>
</div>
<button type="submit" class="'.$IsDisabled.'" id="Ajoutez" name="Ajoutez" value="Ajoutez" ' . $IsDisabled . ' >Ajoutez</button>
</form>';