<?php
echo "<form class='formulaire' action='index.php' method='post'>
        <div>
        <label for='role'>Role</label></br>
        <select name='role' id='role' required>
            <option value='' disabled selected hidden>le role est:</option>
            <option value='client'>Client</option>
            <option value='technicien'>Technicien</option>
        </select>
    </div>
        <div>
            <input type='email' role='email' class='peer' name='email' id='email' placeholder=' ' required />
            <label for='email' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Adresse e-mail</label>
        </div>
        <div>
            <input type='text' role='telephone' class='peer' name='telephone' id='tel' placeholder=' ' required />
            <label for='telephone' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>N° de mobile Orange</label>
        </div>
        <div>
            <input type='password' role='password' class='peer' name='password' placeholder=' ' id='password' required />
            <label for='password' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Mot de passe</label>
        </div>
        <div>
            <input type='password' role='password' class='peer' name='passwordConfirm' placeholder=' ' id='passwordConfirm' required />
            <label for='passwordConfirm' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Confirmation du mot de passe</label>
        </div>
        <div>
            <input type='text' role='nom' class='peer' name='nom' id='nom' placeholder=' ' required />
            <label for='nom' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Nom</label>
        </div>
        <div>
            <input type='text' role='prenom' class='peer' name='prenom' id='prenom' placeholder=' ' required />
            <label for='prenom' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Prénom</label>
        </div>
        <div>
            <input type='text' class='peer' name='adresse' id='adresse' placeholder=' ' required />
            <label for='adresse' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Adresse</label>
        </div>
        <div>
            <input type='number' role='Poste' class='peer' name='codePostal' id='codePostal' placeholder=' ' required />
            <label for='codePostal' class='peer-placeholder-shown:scale-100 peer-focus:-translate-y-6'>Code Postal</label>
        </div>
        <div>
            <button type='submit' name='ajouterUtilisateur' value='ajouterUtilisateur' />
            Ajouter
            </button>
        </div>
    </form>";