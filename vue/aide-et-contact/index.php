<?php
$title = "Informations légales et contact";
$h1 = "Informations légales et contact";
ob_start();
session_start();
?>

<main>

        <div class="content">
            <div class="onTheSide">
                <div class="enoncer">

                    <h2>Mentions légales</h2>
                    <p>Raison sociale : Orange S.A.</p>
                    <p>Siège social : 78 rue Olivier de Serres, 75015 Paris, France</p>
                    <p>Numéro de téléphone : +33 1 44 44 22 22</p>
                    <p>Adresse e-mail : contact@orange.com</p>

                    <h2>Directeur de la publication</h2>
                    <p>Nom : Stéphane Richard</p>

                    <h2>Hébergement</h2>
                    <p>Nom de l'hébergeur : Amazon Web Services</p>
                    <p>Adresse : 410 Terry Ave N, Seattle, WA 98109, États-Unis</p>

                    <h2>Protection des données personnelles</h2>
                    <p>Orange s'engage à protéger la vie privée de ses utilisateurs conformément à la législation en vigueur sur la protection des données personnelles.</p>
                    <p>Pour plus d'informations, veuillez consulter notre politique de confidentialité.</p>

                    <h2>Droits d'auteur</h2>
                    <p>Tous droits réservés. Le contenu de ce site web est protégé par les lois sur le droit d'auteur et ne peut être reproduit, en tout ou en partie, sans l'autorisation écrite préalable d'Orange.</p>

                    <h2>Conditions d'utilisation</h2>
                    <p>L'utilisation de ce site web est soumise aux conditions d'utilisation. En accédant à ce site, vous acceptez ces conditions.</p>

                    <h2>Contact</h2>
                    <p>Pour toute question ou demande concernant les informations légales, veuillez nous contacter à l'adresse e-mail indiquée ci-dessus.</p>
                    <p><a href="mailto:support@orange.fr?subject=Sujet&body=Contenus">support@orange.fr</a></p>
                </div>
            </div>

            <div class="playground">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2689.191822325324!2d-122.33690519999999!3d47.622402400000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490154c299e3c63%3A0x3a3e5d752609ff7e!2s410%20Terry%20Ave%20N%2C%20Seattle%2C%20WA%2098109%2C%20USA!5e0!3m2!1sen!2sfr!4v1685885162600!5m2!1sen!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><br>
            </div>
        </div>
</main>
<?php $content = ob_get_clean(); ?>
<?php require('../../templates/layout.php') ?>