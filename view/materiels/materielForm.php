<?php
echo '
<form class="formulaire" action="index.php" method="post">
'.$tableau.'
<div>
<input type="text" class="peer" name="nom" placeholder=" " id="nom" required />
<label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
</div>
<div>
<input type="textarea" class="peer" name="description" placeholder="Décrivez se produit" id="description" required />
</div>
<div>
<label for="categorie">Catégorie</label></br>
<select name="categorie" id="categorie" required>
    <option value="" disabled selected hidden>Catégorie du materiel :</option>
    <option value="box" name="box">box</option>
    <option value="fibre" name="fibre">fibre</option>
    <option value="sim" name="sim">sim</option>
    <option value="ligne" name="ligne">ligne téléphonique</option>
    <option value="usb 4g" name="usb 4g">usb 4g</option>
</select>
</div>
<div>
<button type="submit" class="'.$IsDisabled.'" id="Ajoutez" name="Ajoutez" value="Ajoutez" ' . $IsDisabled . ' >Ajoutez</button>
</div>
</form>';