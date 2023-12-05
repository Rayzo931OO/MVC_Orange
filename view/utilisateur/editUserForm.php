<?php
echo '<picture>

    <div class="avatar" id="avatar">
        <img id="preview" src="'.$user["avatar"].'" alt="Aperçu de l\'image">
    </div>

</picture>

<form class="formulaire" action="" method="post">
<div>
<input type="hidden" value="'.$user["avatar"].'" name="avatar" id="avatar">
</div>
<div>
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
    <input type="text" id="codePostal" name="codePostal" value="'.$user["codePostal"].'" class="peer" placeholder=" " required>
    <label for="codePostal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal
    </label>
</div>
<div>
    <input type="text" id="adresse" name="adresse" value="'.$user["adresse"].'" class="peer" placeholder=" " required>
    <label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse </label>
</div>
<div>
    <input type="hidden" id="id" name="id" value="'.$user["id"].'" class="peer" placeholder=" " required>
</div>
<div>
    <button type="submit" id="Modifier" name="Modifier">Modifier</button>
</div>
</form>';