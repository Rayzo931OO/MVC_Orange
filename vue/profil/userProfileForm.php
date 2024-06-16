<?php
// var_dump($_SESSION);
echo '
<form class="formulaire" action="index.php" method="post" enctype="multipart/form-data">
<div>
<input type="text" id="nom" name="nom" value="'.$_SESSION["nom"].'" class="peer" placeholder=" " required>
<label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom </label>
</div>
<div>
<input type="text" id="prenom" name="prenom" value="'.$_SESSION["prenom"].'" class="peer" placeholder=" " required>
<label for="prenom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Prénom </label>
</div>
<div>
<input type="email" id="email" name="email" value="'.$_SESSION["email"].'" class="peer" placeholder=" " required>
<label for="email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail
</label>
</div>
<div>
<input type="tel" id="telephone" name="telephone" class="peer" placeholder=" " value="'.$_SESSION["telephone"].'" value="' . $user["telephone"] . '" pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$" required>
<label for="telephone" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Numéro de
    téléphone </label>
</div>
<div>
<input type="text" id="code_postal" name="code_postal" value="'.$_SESSION["code_postal"].'" class="peer" placeholder=" " required>
<label for="code_postal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal
</label>
</div>
<div>
<input type="text" id="adresse" name="adresse" value="'.$_SESSION["adresse"].'" class="peer" placeholder=" " required>
<label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse </label>
</div>
<div>
<input type="hidden" id="id" name="id" value="'.$_SESSION["id"].'" class="peer" placeholder=" " required>
</div>
<div>
<button type="submit" id="Modifier" name="Modifier" value="Modifier">Modifier</button>
</div>
</form>
';
// echo '
// <form class="formulaire" action="index.php" method="post" enctype="multipart/form-data">
// <picture>
// <div class="imageFormulaire">
//     <div class="avatar" id="avatar">
//         <img id="preview" src="'.$_SESSION["avatar"].'" alt="Aperçu de l\'image">
//     </div>
//     <div class="inputs">
//         <label for="image">Choisir une image :</label>
//         <input type="file" id="avatar" name="avatar">
//         <p>Ajoutez votre Photo de Profil</p>
//         <button type="button" id="delete" style="display:none;">Supprimer l\'image</button>
//     </div>
// </div>
// </picture>

// <div>
// <input type="text" id="nom" name="nom" value="'.$_SESSION["nom"].'" class="peer" placeholder=" " required>
// <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom </label>
// </div>
// <div>
// <input type="text" id="prenom" name="prenom" value="'.$_SESSION["prenom"].'" class="peer" placeholder=" " required>
// <label for="prenom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Prénom </label>
// </div>
// <div>
// <input type="email" id="email" name="email" value="'.$_SESSION["email"].'" class="peer" placeholder=" " required>
// <label for="email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail
// </label>
// </div>
// <div>
// <input type="text" id="telephone" name="telephone" value="'.$_SESSION["telephone"].'" class="peer" placeholder=" " required>
// <label for="telephone" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Numéro de
//     téléphone </label>
// </div>
// <div>
// <input type="text" id="codePostal" name="codePostal" value="'.$_SESSION["codePostal"].'" class="peer" placeholder=" " required>
// <label for="codePostal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal
// </label>
// </div>
// <div>
// <input type="text" id="adresse" name="adresse" value="'.$_SESSION["adresse"].'" class="peer" placeholder=" " required>
// <label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse </label>
// </div>
// <div style="display:none;">
// <input type="text" id="id" name="id" value="'.$_SESSION["id"].'" class="peer" placeholder=" " required>
// <label for="id" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse </label>
// </div>
// <div>
// <button type="submit" id="Modifier" name="Modifier" value="Modifier">Modifier</button>
// </div>
// </form>';