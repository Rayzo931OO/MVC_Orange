<?php

/**************** Fonctions Users *******************/
function insertClient($tab) // $tab <=> $_POST (formulaire)
{
	$avatar = null;
	if($tab['avatar'] != null){
		$avatar = $tab['avatar'];
	}
	$requete = "insert into user values (null, '" . $tab['nom'] . "','"
		. $tab['prenom'] . "', '" . $tab['email'] . "', '" . $tab['codePostal'] . "', '" . $tab['adresse'] . "', '" . $tab['telephone'] . "', '" . $tab['password'] . "', 'client', '".$avatar."');";

	//connexion
	$con = connexion();

	//execution de la requete
	mysqli_query($con, $requete);
}
function insertTechnicien($tab) // $tab <=> $_POST (formulaire)
{
	$avatar = null;
	if(isset($tab['avatar']) && $tab['avatar'] != null){
		$avatar = $tab['avatar'];
	}
	$requete = "insert into user values (null, '" . $tab['nom'] . "','"
		. $tab['prenom'] . "', '" . $tab['email'] . "', '" . $tab['codePostal'] . "', '" . $tab['adresse'] . "', '" . $tab['telephone'] . "', '" . $tab['password'] . "', 'technicien', '".$avatar."');";

	//connexion
	$con = connexion();

	//execution de la requete
	mysqli_query($con, $requete);
}
function selectWhereUser($email, $password)
{
	//ecriture de la requete
	$requete = "select * from user where email='" . $email . "'  and password='" . $password . "' ;";
	//connexion
	$con = connexion();
	//execution de la requete et récupération du produit
	$leResultat = mysqli_query($con, $requete);
	$unUser = mysqli_fetch_assoc($leResultat); //tableau associatif
	//retour de user selectionné
	return $unUser;
}
function selectUserById($id)
{
	//ecriture de la requete
	$requete = "select * from user where id='" . $id . "';";
	//connexion
	$con = connexion();
	//execution de la requete et récupération du produit
	$leResultat = mysqli_query($con, $requete);
	$unUser = mysqli_fetch_assoc($leResultat); //tableau associatif
	//retour de user selectionné
	return $unUser;
}
function selectAllUser()
{
	//ecriture de la requete
	$requete = "select * from user;";

	//connexion
	$con = connexion();
	//execution de la requete et récupération du produit
	$leResultat = mysqli_query($con, $requete);
	// Check if any rows were returned
	if (mysqli_num_rows($leResultat) > 0) {
		// Array to store the clients
		$clients = array();

		// Fetch each row as an associative array and add it to the clients array
		while ($row = mysqli_fetch_assoc($leResultat)) {
			$clients[] = $row;
		}

		// Return the clients array
		return $clients;
	} else {

		// Return an empty array if no clients found
		return array();
	}
}

function selectLikeUser ($mot, $role) {
	$requete = "select * from user where role='".$role."' and (nom like '" . $mot . "' or prenom like '" . $mot . "' or  email like '" . $mot . "' or telephone like '" . $mot . "') ;";
	//connexion
	$con = connexion();

	//execution de la requete
	$users = mysqli_query($con, $requete);

	return $users;

}
function updateUser($user, $targetFile){
	//ecriture de la requete
	$requete = "update user set nom='" . $user['nom'] . "', prenom='" . $user['prenom'] . "', email='" . $user['email'] . "', codePostal='" . $user['codePostal'] . "', adresse='" . $user['adresse'] . "', telephone='" . $user['telephone'] . "', avatar='" . $targetFile . "' where id=" . $user['id'] . ";";
	//connexion
	$con = connexion();
	//execution de la requete
	mysqli_query($con, $requete);
}
function deleteUserById($id){
	//ecriture de la requete
	$requete = "delete from user where id=" . $id . ";";
	//connexion
	$con = connexion();
	//execution de la requete
	mysqli_query($con, $requete);
}


/**************** Fonctions materiels *******************/


// function insertMateriel($tab) // $tab <=> $_POST (formulaire)
// {
// 	$requete = "insert into materiel values (null, '" . $tab['nom'] . "','"
// 		. $tab['description'] . "' , " . $tab['id'] .", '".$tab['categorie']."') ; ";

// 	//connexion
// 	$con = connexion();

// 	//execution de la requete
// 	mysqli_query($con, $requete);

// 	//deconnexion
// 	deconnexion($con);
// 	header('Location: index.php');
// }
// function selectAllMateriel()
// {
// 	$requete = "select * from materiel;";
// 	//connexion
// 	$con = connexion();

// 	//execution de la requete
// 	$lesProduits = mysqli_query($con, $requete);

// 	//deconnexion
// 	deconnexion($con);

// 	return $lesProduits;
// }
// function selectMaterielById($id)
// {
// 	//ecriture de la requete
// 	$requete = "select * from materiel where id='" . $id . "';";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete et récupération du produit
// 	$leResultat = mysqli_query($con, $requete);
// 	$unMateriel = mysqli_fetch_assoc($leResultat); //tableau associatif
// 	//deconnexion
// 	deconnexion($con);
// 	//retour de user selectionné
// 	return $unMateriel;
// }
// function selectMaterielByClientId($id)
// {
// 	//ecriture de la requete
// 	$requete = "select * from materiel where client_id='" . $id . "';";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete et récupération du produit
// 	$LesMateriels = mysqli_query($con, $requete);
// 	//deconnexion
// 	deconnexion($con);
// 	//retour de user selectionné
// 	return $LesMateriels;
// }

// function deleteMaterielById($id)
// {
// 	//ecriture de la requete
// 	$requete = "delete from materiel where id = " . $id . ";";
// 	//on se connecte
// 	$con = connexion();
// 	//on execute la requete
// 	mysqli_query($con, $requete);
// 	//on se deconnecte
// 	deconnexion($con);
// }

// function updateMateriel($materiel)
// {
// 	//ecriture de la requete
// 	$requete = "update materiel set nom='" . $materiel['nom'] . "', description= '" . $materiel['description'] . "', client_id=" . $materiel['client_id'] . ", categorie='" . $materiel['categorie'] . "' where id=" . $materiel['id'] . ";";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete
// 	mysqli_query($con, $requete);
// 	//deconnexion
// 	deconnexion($con);
// 	header('Location: index.php');
// }

// function selectLikeMateriel($mot)
// {
// 	$requete = "select * from materiel where nom like '%" . $mot . "%'  or categorie like '%" . $mot . "%' ;";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete
// 	$lesMateriels = mysqli_query($con, $requete);
// 	//deconnexion
// 	deconnexion($con);
// 	return $lesMateriels;
// }

// /**************** Fonctions intervention *******************/
// function insertIntervention($tab) // $tab <=> $_POST (formulaire)
// {
// 	$requete = "insert into intervention values (null, '" . $tab['date_debut'] . "','" . $tab['date_fin'] . "','" . $tab['description'] . "'," . $tab['materiel_id'] . "," . $tab['technicien_id'] . ",'"
// 		. $tab['status'] . "', '".$tab['fournisseur']."') ; ";

// 	//connexion
// 	$con = connexion();

// 	//execution de la requete
// 	mysqli_query($con, $requete);

// 	//deconnexion
// 	deconnexion($con);
// 	header('Location: index.php');
// }
// function selectAllIntervention()
// {
// 	$requete = "select * from intervention;";
// 	//connexion
// 	$con = connexion();

// 	//execution de la requete
// 	$lesIntervention = mysqli_query($con, $requete);

// 	//deconnexion
// 	deconnexion($con);

// 	return $lesIntervention;
// }
// function selectInterventionById($id)
// {
// 	//ecriture de la requete
// 	$requete = "select * from intervention where id='" . $id . "';";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete et récupération du produit
// 	$leResultat = mysqli_query($con, $requete);
// 	$unIntervention = mysqli_fetch_assoc($leResultat); //tableau associatif
// 	//deconnexion
// 	deconnexion($con);
// 	//retour de user selectionné
// 	return $unIntervention;
// }

// function deleteInterventionById($id)
// {
// 	//ecriture de la requete
// 	$requete = "delete from intervention where id = " . $id . ";";
// 	//on se connecte
// 	$con = connexion();
// 	//on execute la requete
// 	mysqli_query($con, $requete);
// 	//on se deconnecte
// 	deconnexion($con);
// }

// function updateIntervention($intervention)
// {
// 	//ecriture de la requete
// 	$requete = "update intervention set date_debut='" . $intervention['date_debut'] . "',date_fin='" . $intervention['date_fin'] . "', description='" . $intervention['description'] . "',materiel_id=" . $intervention['materiel_id'] . ",technicien_id=" . $intervention['technicien_id'] . ",status='"
// 	. $intervention['status'] . "', fournisseur='".$intervention['fournisseur']."' where id=" . $intervention['id'] . ";";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete
// 	mysqli_query($con, $requete);
// 	//deconnexion
// 	deconnexion($con);
// 	header('Location: index.php');
// }

// function selectSearchIntervention($mot)
// {
// 	$requete = "select * from intervention where designation like '%" . $mot . "%'  or categorie like '%" . $mot . "%' ;";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete
// 	$lesIntervention = mysqli_query($con, $requete);
// 	//deconnexion
// 	deconnexion($con);
// 	return $lesIntervention;
// }

// function selectInterventionByTechnicien($id)
// {
// 	$requete = "select * from intervention where technicien_id = " . $id . ";";
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete
// 	$lesIntervention = mysqli_query($con, $requete);
// 	//deconnexion
// 	deconnexion($con);
// 	return $lesIntervention;
// }
// function selectInterventionByClient($id)
// {
// 	$lesIntervention = array();
// 	$materiel = selectMaterielByClientId($id);
// 	//connexion
// 	$con = connexion();
// 	//execution de la requete
// 	foreach ($materiel as $m) {
// 		$requete = "select * from intervention where materiel_id = " . $m['id'] . ";";
// 		$Result = mysqli_query($con, $requete);
// 		$Intervention = mysqli_fetch_assoc($Result);
// 		array_push($lesIntervention,$Intervention);
// 	}
// 	//deconnexion
// 	deconnexion($con);
// 	return $lesIntervention;
// }