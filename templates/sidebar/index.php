<link href="/MVC_Orange/templates/sidebar/style.css" rel="stylesheet" />
<nav class="sidebar">
   <ul>
      <li>
         <a href="/MVC_Orange/vue/profil/">Profile</a>
      </li>
      <li>
         <a href="/MVC_Orange/vue/interventions">Interventions</a>
      </li>
      <?php
      if (substr($_SESSION["role"], 0, 5) == "admin") {
         echo '<li>
            <a href="/MVC_Orange/vue/utilisateurs">Utilisateurs</a>
         </li>';
      }
      ?>
      <?php
      if (substr($_SESSION["role"], 0, 5) == "admin" || $_SESSION["role"] == "technicien" ) {
         echo '<li>
         <a href="/MVC_Orange/vue/materiels">Materiels</a>
      </li>
      <li>
         <a href="/MVC_Orange/vue/logiciels">Logiciels</a>
      </li>
      <li>
         <a href="/MVC_Orange/vue/categories">Categories</a>
      </li>';
      }
      ?>
      <li>
         <a href="/MVC_Orange/templates/logout.php">Déconnexion</a>
      </li>
   </ul>
</nav>