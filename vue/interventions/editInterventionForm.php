<?php
$today = getdate();
$currentMateriel = $materielController->selectMaterielById($intervention['id_materiel']);
$currentLogiciel = $logicielController->selectLogicielById($intervention['id_logiciel']);
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];

$dateTimeDebut = new DateTime($intervention["date_debut"]);
$formattedDateTimeDebut = $dateTimeDebut->format("Y-m-d\TH:i:s");

$dateTimeFin = new DateTime($intervention["date_fin"]);
$formattedDateTimeFin = $dateTimeFin->format("Y-m-d\TH:i:s");

echo'<form class="formulaire" action="" method="post">
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
    if($currentMateriel["id_materiel"] == $materiel["id_materiel"]){
        echo 'selected="true">';
    }else {
        echo '>';
    }
    echo $materiel["nom"] . '</option>';
}
echo '</select></div>';
}else{
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
        if($currentLogiciel["id_logiciel"] == $logiciel["id_logiciel"]){
            echo 'selected="true">';
        }else {
            echo '>';
        }
        echo $logiciel["nom"] . '</option>';
    }
    echo '</select></div>';
}else{
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
    <input type="datetime-local" min="'.$minDate.'" class="peer" value="' . $formattedDateTimeDebut . '" id="date_debut" name="date_debut" placeholder=" " required>
    <label for="date_debut" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Debut
    </label>
</div>
<div>
<input type="datetime-local" min="'.$minDate.'" class="peer" value="' . $formattedDateTimeFin. '" id="date_fin" name="date_fin" placeholder=" " required>
<label for="date_fin" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    Fin
</label>
</div>';
echo '<div><label for="status">Statut de l\'intervention</label></br><select name="status" id="status" value="' . $intervention["status"] . '" required>';
if($intervention["status"]=="En cours") echo "<option selected='true'> En cours </option>";
else echo "<option> En cours </option>";
if($intervention["status"]=="Terminer") echo "<option selected='true'> Terminer </option>";
else echo "<option> Terminer </option>";
echo '</div>';

echo '<div>
    <label for="description">Description</label></br>
    <textarea id="description" name="description" value="' . $intervention["description"] . '" placeholder="Problème de.... identifier..." required>' . $intervention["description"] . '</textarea>
</div>
<br>
<button type="submit" id="Modifier" name="Modifier" value="Modifier" >Modifier</button>
</form>'
?>