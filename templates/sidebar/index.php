<link href="/orange/templates/sidebar/style.css" rel="stylesheet" />
<nav class="sidebar">
   <ul>
      <li>
         <a href="/orange/account/profil/">Profile</a>
      </li>
      <li>
         <a href="/orange/account/interventions">Interventions</a>
      </li>
      <?php
      if ($_SESSION['role'] == 'admin') {
         echo '<li>
            <a href="/orange/account/utilisateurs">Utilisateurs</a>
         </li>';
      }
      ?>

      <li>
         <a href="/orange/account/materiels">Materiels</a>
      </li>
      <li>
         <a href="/orange/templates/logout.php">Déconnections</a>
      </li>
   </ul>
</nav>