<!-- <h1>Bienvenue chez Orange</h1> -->
<?php
$title = "Bienvenue chez Orange";
$h1 = "Bienvenue chez Orange";
ob_start();
session_start();
?>
    <section>
        <h2>À propos de nous</h2>
        <p>Orange est un fournisseur leader de services de télécommunication...</p>
    </section>
    <section>
        <h2>Nos services</h2>
        <div>
            <h3>Services mobiles</h3>
            <p>Orange offre une large gamme de services mobiles, y compris...</p>
        </div>
        <div>
            <h3>Services Internet</h3>
            <p>Nos services Internet comprennent...</p>
        </div>
        <div>
            <h3>Service client</h3>
            <p>Nous fournissons un support client 24/7...</p>
        </div>
    </section>
    <section>
        <h2>Contactez-nous</h2>
        <p>Pour toute question ou support, contactez-nous à...</p>
    </section>p

    <?php $content = ob_get_clean(); ?>
<!-- importation du composent de "model de vue" qui agence tout les autre elements -->
<?php require_once '../../templates/layout.php' ?>