<?php
echo '


<form class="formulaire" action="" method="post">


<div>
<label for="role">Role</label></br>
<select name="role" id="role" value="' . $user["role"] . '" required>';
if($user["role"]=="client") echo "<option value='client' selected='true'> Client </option>";
else echo "<option value='client'> Client </option>";
if($user["role"]=="technicien") echo "<option value='technicien' selected='true'> technicien </option>";
else echo "<option value='technicien'> technicien </option>";
if($user["role"]=="admin1") echo "<option value='admin1' selected='true'> Admin grade 1 </option>";
else echo "<option value='admin1'> Admin grade 1 </option>";
if($user["role"]=="admin2") echo "<option value='admin2' selected='true'> Admin grade 2 </option>";
else echo "<option value='admin2'> Admin grade 2 </option>";
if($user["role"]=="admin3") echo "<option value='admin3' selected='true'> Admin grade 3 </option>";
else echo "<option value='admin3'> Admin grade 3 </option>";
echo '</select></div>';

echo '<div>
    <input type="text" id="nom" name="nom" value="'.$user["nom"].'" class="peer" placeholder=" " required>
    <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom </label>
</div>
<div>
    <input type="text" id="prenom" name="prenom" value="'.$user["prenom"].'" class="peer" placeholder=" " required>
    <label for="prenom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Prénom </label>
</div>
<div>
    <input type="email" id="email" name="email" value="'.$user["email"].'" class="peer" placeholder=" " required>
    <label for="email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail
    </label>
</div>
<div>
    <input type="text" id="telephone" name="telephone" value="'.$user["telephone"].'" class="peer" placeholder=" " required>
    <label for="telephone" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Numéro de
        téléphone </label>
</div>
<div>
    <input type="text" id="codePostal" name="codePostal" value="'.$user["code_postal"].'" class="peer" placeholder=" " required>
    <label for="codePostal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal
    </label>
</div>
<div>
    <input type="text" id="adresse" name="adresse" value="'.$user["adresse"].'" class="peer" placeholder=" " required>
    <label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse </label>
</div>
<div>
    <input type="hidden" id="id_utilisateur" name="id_utilisateur" value="'.$user["id_utilisateur"].'" class="peer" placeholder=" " required>
</div>
<div>
    <button type="submit" id="Modifier" name="Modifier">Modifier</button>
</div>
</form>';