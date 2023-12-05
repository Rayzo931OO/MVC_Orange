<?php
$today = getdate();
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
echo'<form class="formulaire" action="index.php" method="post">
'.$tableau.'
<div>
    <input type="text" class="peer" id="fournisseur" name="fournisseur" placeholder=" " required>
    <label for="fournisseur" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Le fournisseur
    </label>
</div>';
if($_SESSION["role"] == "technicien"){
    echo '<div>
    <input type="hidden" name="technicien_id" id="technicien_id" value="' . $_SESSION["id"] . '" placeholder=" " required />
    </div>';
}
echo '
<div>
    <input type="date" min="'.$minDate.'" class="peer" id="date_debut" name="date_debut" placeholder=" " required>
    <label for="date_debut" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
        Debut
    </label>
</div>
<div>
<input type="date" min="'.$minDate.'" class="peer" id="date_fin" name="date_fin" placeholder=" " required>
<label for="date_fin" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
    Fin
</label>
</div>
<div>
    <label for="status">Statut de l\'intervention</label></br>
    <select name="status" id="status" required>
        <option value="" disabled selected hidden>le Statut est:</option>
        <option value="En cours">En cours</option>
        <option value="Terminer">Terminer</option>
    </select>
</div>
<div>
    <label for="description">Description</label></br>
    <textarea id="description" name="description" placeholder="Problème de.... identifier..." required></textarea>
</div>
<button type="submit" class="'.$IsDisabled.'" id="Ajoutez" name="Ajoutez" value="Ajoutez" ' . $IsDisabled . ' >Ajoutez</button>
</form>';