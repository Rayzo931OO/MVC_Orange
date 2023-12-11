<link href="/mvc_orange/templates/sidebar/style.css" rel="stylesheet" />
<nav class="sidebar">
   <ul>
      <li>
         <a href="/mvc_orange/vue/profil/">Profile</a>
      </li>
      <li>
         <a href="/mvc_orange/vue/interventions">Interventions</a>
      </li>
      <?php
      if (substr($_SESSION["role"], 0, 5) == "admin") {
         echo '<li>
            <a href="/mvc_orange/vue/utilisateurs">Utilisateurs</a>
         </li>';
      }
      ?>
      <?php
      if (substr($_SESSION["role"], 0, 5) == "admin" || $_SESSION["role"] == "technicien" ) {
         echo '<li>
         <a href="/mvc_orange/vue/materiels">Materiels</a>
      </li>
      <li>
         <a href="/mvc_orange/vue/logiciels">Logiciels</a>
      </li>
      <li>
         <a href="/mvc_orange/vue/categories">Categories</a>
      </li>';
      }
      ?>
      <li>
         <a href="/mvc_orange/templates/logout.php">Déconnections</a>
      </li>
   </ul>
</nav>