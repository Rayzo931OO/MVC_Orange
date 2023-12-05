<?php
echo '
<form class="formulaire" action="index.php" method="post">
<div>
          <input type="hidden" name="id" id="id" value="' . $materiel["id"] . '" placeholder=" " required />
          </div>
<div>
<div>
          <input type="hidden" name="client_id" id="client_id" value="' . $materiel["client_id"] . '" placeholder=" " required />
          </div>
<div>
<input type="text" class="peer" name="nom" value="' . $materiel["nom"] . '" placeholder=" " id="nom" required />
<label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
</div>
<div>
<input type="textarea" class="peer" name="description" value="' . $materiel["description"] . '" placeholder="Décrivez se produit" id="description" required />
</div>
<div>
<label for="categorie">Catégorie</label></br>';

echo '<select name="categorie" value="' . $materiel["categorie"] . '" required>';
if($materiel["categorie"]=="box") echo "<option selected='true'> box </option>";
else echo "<option> box </option>";
if($materiel["categorie"]=="fibre") echo "<option selected='true'> fibre </option>";
else echo "<option> fibre </option>";
if($materiel["categorie"]=="sim") echo "<option selected='true'> sim </option>";
else echo "<option> sim </option>";
if($materiel["categorie"]=="ligne") echo "<option selected='true'> ligne téléphonique </option>";
else echo "<option> ligne téléphonique </option>";
if($materiel["categorie"]=="usb 4g") echo "<option selected='true'> usb 4g </option>";
else echo "<option> usb 4g </option>";
echo '
</select>
</div>
<div>
<button type="submit" id="Modifier" name="Modifier" value="Modifiez" >Modifier</button>
</div>
</form>';