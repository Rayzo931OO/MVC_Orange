<?php
$today = getdate();
$materiel = selectMaterielById($intervention['materiel_id']);
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
echo'<form class="formulaire" action="index.php" method="post">
<div>
          <input type="hidden" name="id" id="id" value="' . $intervention["id"] . '" placeholder=" " required />
          </div>
<div>
<div>
          <input type="hidden" name="materiel_id" id="materiel_id" value="' . $intervention["materiel_id"] . '" placeholder=" " required />
          </div>
<div>
<div>
          <input type="hidden" name="technicien_id" id="technicien_id" value="' . $intervention["technicien_id"] . '" placeholder=" " required />
          </div>
<div>
<div>
    <input type="text" class="peer" id="nom" name="Materiel" value="' . $materiel["nom"] . '" placeholder=" " required>
    <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    ' . $materiel["nom"] . '
    </label>
</div>
<div>
    <input type="text" class="peer" id="fournisseur" name="fournisseur" value="' . $intervention["fournisseur"] . '" placeholder=" " required>
    <label for="fournisseur" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Le fournisseur
    </label>
</div>
<div>
    <input type="date" min="'.$minDate.'" class="peer" value="' . substr($intervention["date_debut"],0,10) . '" id="date_debut" name="date_debut" placeholder=" " required>
    <label for="date_debut" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Debut
    </label>
</div>
<div>
<input type="date" min="'.$minDate.'" class="peer" value="' . substr($intervention["date_fin"],0,10) . '" id="date_fin" name="date_fin" placeholder=" " required>
<label for="date_fin" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    Fin
</label>
</div>
<div>
<label for="status">Statut de l\'intervention</label></br>';
echo '<select name="status" id="status" value="' . $intervention["status"] . '" required>';
if($intervention["status"]=="En cours") echo "<option selected='true'> En cours </option>";
else echo "<option> En cours </option>";
if($intervention["status"]=="Terminer") echo "<option selected='true'> Terminer </option>";
else echo "<option> Terminer </option>";
echo '
</div>
<div>
    <label for="description">Description</label></br>
    <textarea id="description" name="description" value="' . $intervention["description"] . '" placeholder="Problème de.... identifier..." required>' . $intervention["description"] . '</textarea>
</div>
<br>
<button type="submit" id="Modifier" name="Modifier" value="Modifier" >Modifier</button>
</form>'
?>