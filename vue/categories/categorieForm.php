<?php
echo '
<form class="formulaire" action="" method="post">
'.$tableau.'
<div>
<input type="text" class="peer" name="nom" placeholder=" " id="nom" required />
<label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
</div>
<div>
<input type="text" class="peer" name="version" placeholder=" " id="version" required />
<label for="version" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Version</label>
</div>
<div>
<input type="textarea" class="peer" name="description" placeholder="Décrivez se produit" id="description" required />
</div>
<button type="submit" class="'.$IsDisabled.'" id="Ajoutez" name="Ajoutez" value="Ajoutez" ' . $IsDisabled . ' >Ajoutez</button>
</div>
</form>';