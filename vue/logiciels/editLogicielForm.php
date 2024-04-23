<?php
echo '
<form class="formulaire" action="" method="post">
<div>
          <input type="hidden" name="id_logiciel" id="id_logiciel" value="' . $logiciel["id_logiciel"] . '" placeholder=" " required />
          </div>
<div>
<input type="text" class="peer" name="nom" value="' . $logiciel["nom"] . '" placeholder=" " id="nom" required />
<label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
</div>
<div>
<input type="text" class="peer" name="version" value="' . $logiciel["version"] . '" placeholder=" " id="version" required />
<label for="version" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Version</label>
</div>
<div>
<input type="textarea" class="peer" name="description" value="' . $logiciel["description"] . '" placeholder="Décrivez se produit" id="description" required />
</div>
<div>
<label for="id_categorie">Catégorie</label></br>';

echo '<div>
<label for="id_categorie">La categorie</label></br>
<select name="id_categorie" id="id_categorie" value="' . $logiciel["id_categorie"] . '" >';
foreach ($categorieController->allcategorie() as $categorie) {
    echo '<option value="' . $categorie["id_categorie"] . '"';
    if($logiciel["id_categorie"] == $categorie["id_categorie"]){
        echo 'selected="true">';
    }else {
        echo '>';
    }
    echo $categorie["nom"] . '</option>';
}
echo '</select></div>';

echo '
</select>
</div>
<div>
<button type="submit" id="Modifier" name="Modifier" value="Modifiez" >Modifier</button>
</div>
</form>';