<?php
$bdd;
try {
   $url = "mysql:host=localhost:3306;dbname=Orange;charset=utf8mb4";
   $user = "root";
   $mdp = "";
   $bdd = new PDO($url, $user, $mdp);
   if ($bdd == null) {
      echo "Erreur de connexion à la BDD.";
   }
} catch (Exception $e) {
   echo "" . $e->getMessage() . "";
   die();
}
