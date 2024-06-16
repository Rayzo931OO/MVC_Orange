<?php
echo '


<form class="formulaire" action="" method="post">


<div>
<label for="role">Role</label></br>
<select name="role" id="role" value="' . $user["role"] . '" required>';
if ($user["role"] == "client") echo "<option value='client' selected='true'> Client </option>";
else echo "<option value='client'> Client </option>";
if ($user["role"] == "technicien") echo "<option value='technicien' selected='true'> Technicien </option>";
else echo "<option value='technicien'> Technicien </option>";
if ($user["role"] == "admin") echo "<option value='admin' selected='true'> Admin </option>";
else echo "<option value='admin'> Admin </option>";
echo '</select></div>';

echo '<div>
    <input type="text" id="nom" name="nom" value="' . $user["nom"] . '" class="peer" placeholder=" " required>
    <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom </label>
</div>
<div>
    <input type="text" id="prenom" name="prenom" value="' . $user["prenom"] . '" class="peer" placeholder=" " required>
    <label for="prenom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Prénom </label>
</div>
<div>
    <input type="email" id="email" name="email" value="' . $user["email"] . '" class="peer" placeholder=" " required>
    <label for="email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail
    </label>
</div>
<div>
<input type="tel" id="telephone" name="telephone" class="peer" placeholder=" " value="' . $user["telephone"] . '" pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$" required>
    <label for="telephone" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Numéro de
        téléphone </label>
</div>
<div>
    <input type="text" id="code_postal" name="code_postal" value="' . $user["code_postal"] . '" class="peer" placeholder=" " pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$" required>
    <label for="code_postal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal
    </label>
</div>
<div>
    <input type="text" id="adresse" name="adresse" value="' . $user["adresse"] . '" class="peer" placeholder=" " required>
    <label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse </label>
</div>
<div>
    <input type="hidden" id="id" name="id" value="' . $user["id_utilisateur"] . '" class="peer" placeholder=" " required>
</div>
<div>
    <button type="submit" id="Modifier" name="Modifier">Modifier</button>
</div>
</form>';
