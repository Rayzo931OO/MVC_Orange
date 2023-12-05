<details class="inscription" open>
    <summary class="inscription_summary">Crée votre compte
        <svg xmlns="http://www.w3.org/2000/svg" width="23.616" height="13.503" viewBox="0 0 23.616 13.503">
            <path id="Icon_ionic-ios-arrow-forward" data-name="Icon ionic-ios-arrow-forward" d="M20.679,18,11.742,9.07a1.681,1.681,0,0,1,0-2.384,1.7,1.7,0,0,1,2.391,0L24.258,16.8a1.685,1.685,0,0,1,.049,2.327L14.14,29.32a1.688,1.688,0,0,1-2.391-2.384Z" transform="translate(29.813 -11.246) rotate(90)" fill="#ff8000" />
        </svg>
    </summary>
    <form action="index.php" method="post">
        <div>
            <input type="email" class="peer" name="email" id="email" placeholder=" " required />
            <label for="email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail</label>
        </div>
        <div>
            <input type="text" role="number" class="peer" name="tel" id="tel" placeholder=" " required />
            <label for="tel" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">N° de mobile Orange</label>
        </div>
        <div>
            <input type="password" class="peer" name="password" placeholder=" " id="password" required />
            <label for="password" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Mot de passe</label>
        </div>
        <div>
            <input type="password" class="peer" name="passwordConfirm" placeholder=" " id="passwordConfirm" required />
            <label for="passwordConfirm" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Confirmation du mot de passe</label>
        </div>
        <div>
            <input type="text" class="peer" name="nom" id="nom" placeholder=" " required />
            <label for="nom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Nom</label>
        </div>
        <div>
            <input type="text" class="peer" name="prenom" id="prenom" placeholder=" " required />
            <label for="prenom" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Prénom</label>
        </div>
        <div>
            <input type="text" class="peer" name="adresse" id="adresse" placeholder=" " required />
            <label for="adresse" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse</label>
        </div>
        <div>
            <input type="number" class="peer" name="codePostal" id="codePostal" placeholder=" " required />
            <label for="codePostal" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Code Postal</label>
        </div>
        <div>
            <button type="submit" name="sInscrire" value="S'inscrire" />
            S'inscrire
            </button>
        </div>
    </form>
</details>
<details class="connection">
    <summary class="connection_summary">Compte déjà existant
        <svg xmlns="http://www.w3.org/2000/svg" width="23.616" height="13.503" viewBox="0 0 23.616 13.503">
            <path id="Icon_ionic-ios-arrow-forward" data-name="Icon ionic-ios-arrow-forward" d="M20.679,18,11.742,9.07a1.681,1.681,0,0,1,0-2.384,1.7,1.7,0,0,1,2.391,0L24.258,16.8a1.685,1.685,0,0,1,.049,2.327L14.14,29.32a1.688,1.688,0,0,1-2.391-2.384Z" transform="translate(29.813 -11.246) rotate(90)" fill="#ff8000" />
        </svg>

    </summary>
    <form action="index.php" method="post">
        <div>
            <input type="email" class="peer" name="email" id="connection_email" placeholder=" " required />
            <label for="connection_email" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Adresse e-mail ou n° de mobile Orange</label>
        </div>
        <div>
            <input type="password" class="peer" name="password" placeholder=" " id="connection_password" required />
            <label for="connection_password" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">Mot de passe</label>
        </div>
        <div>
            <button type="submit" name="seConnecter" value="Se connecter">Se connecter</button>
        </div>
    </form>
</details>
<script src="/orange/templates/formConnexion/index.js"></script>