<?php
function connexion()
{
   $con = mysqli_connect("localhost:3306", "root", "", "Orange");
   if ($con == null) {
      echo "Erreur de connexion à la BDD.";
   }
   return $con;
}
// function deconnexion($con)
// {
// 	mysqli_close($con);
// }
try {
   $con = connexion();
   return $con;
} catch (Exception $e) {
   echo "" . $e->getMessage() . "";
   die();
}
