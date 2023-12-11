<?php
echo '
<form class="formulaire" action="" method="post">
<div>
          <input type="hidden" name="id_categorie" id="id_categorie" value="' . $categorie["id_categorie"] . '" placeholder=" " required />
          </div>
<div>
<input type="text" class="peer" name="nom" value="' . $categorie["nom"] . '" placeholder=" " id="nom" required />
<label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
</div>
<div>
<input type="textarea" class="peer" name="description" value="' . $categorie["description"] . '" placeholder="Décrivez se produit" id="description" required />
</div>
<div>
<button type="submit" id="Modifier" name="Modifier" value="Modifiez" >Modifier</button>
</div>
</form>';