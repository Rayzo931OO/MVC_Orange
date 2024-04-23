<link href="/templates/sidebar/style.css" rel="stylesheet" />
<nav class="sidebar">
   <ul>
      <li>
         <a href="/vue/profil/">Profile</a>
      </li>
      <li>
         <a href="/vue/interventions">Interventions</a>
      </li>
      <?php
      if (substr($_SESSION["role"], 0, 5) == "admin") {
         echo '<li>
            <a href="/vue/utilisateurs">Utilisateurs</a>
         </li>';
      }
      ?>
      <?php
      if (substr($_SESSION["role"], 0, 5) == "admin" || $_SESSION["role"] == "technicien" ) {
         echo '<li>
         <a href="/vue/materiels">Materiels</a>
      </li>
      <li>
         <a href="/vue/logiciels">Logiciels</a>
      </li>
      <li>
         <a href="/vue/categories">Categories</a>
      </li>';
      }
      ?>
      <li>
         <a href="/templates/logout.php">Déconnexion</a>
      </li>
   </ul>
</nav>