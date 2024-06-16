<?php
echo "<br>";
if (count($interventions) > 0) {
    echo "<table class='tableau' border-collapse='collapse' >

    <caption class='caption'>Listes de mes interventions</caption>
    <thead>
        <tr>
            <th>Materiel</th>
            <th>Technicien</th>
            <th>Date</th>
            <th>Statut de l'intervention</th>
            <th>Description</th><th>Actions</th>";
    echo "</tr>
    </thead>
    <tbody>";
    foreach ($interventions as $intervention) {
        $materiel = $materielController->selectMaterielById($intervention['id_materiel']);
        if ($intervention['id_technicien'] == null) {
            $technicien = null;
        } else {
            $technicien = $userController->selectUserById($intervention['id_technicien']);
        }

        echo "<tr>
          <td>" . $materiel['nom'] . "</td>
          <td>";
        if ($technicien !== null) {
            echo $technicien['nom'] . " " . $technicien['prenom'];
        } else {
            echo "Non assigner ";
        }
        echo "</td>";
        echo "<td>" . $intervention['date_inter'] . "</td>
          <td>" . $intervention['status'] . "</td>
          <td>" . $intervention['description'] . "</td><td class='actions'>";

        if ($_SESSION["role"] !== "client") {
            echo "
            <button><a href='index.php?action=edit&id=" . $intervention['id_intervention'] . "'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                <path d='M17.263 2.177a1.75 1.75 0 0 1 2.474 0l2.586 2.586a1.75 1.75 0 0 1 0 2.474L19.53 10.03l-.012.013L8.69 20.378a1.753 1.753 0 0 1-.699.409l-5.523 1.68a.748.748 0 0 1-.747-.188.748.748 0 0 1-.188-.747l1.673-5.5a1.75 1.75 0 0 1 .466-.756L14.476 4.963ZM4.708 16.361a.26.26 0 0 0-.067.108l-1.264 4.154 4.177-1.271a.253.253 0 0 0 .1-.059l10.273-9.806-2.94-2.939-10.279 9.813ZM19 8.44l2.263-2.262a.25.25 0 0 0 0-.354l-2.586-2.586a.25.25 0 0 0-.354 0L16.061 5.5Z'></path>
                            </svg></a>";
        }
        if($_SESSION["role"] == "admin" || $_SESSION["role"] == "client"){
            echo "</button><button class='delete'><a href='index.php?action=delete&id=" . $intervention['id_intervention'] . "'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                    <path d='M16 1.75V3h5.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75Zm-6.5 0V3h5V1.75a.25.25 0 0 0-.25-.25h-4.5a.25.25 0 0 0-.25.25ZM4.997 6.178a.75.75 0 1 0-1.493.144L4.916 20.92a1.75 1.75 0 0 0 1.742 1.58h10.684a1.75 1.75 0 0 0 1.742-1.581l1.413-14.597a.75.75 0 0 0-1.494-.144l-1.412 14.596a.25.25 0 0 1-.249.226H6.658a.25.25 0 0 1-.249-.226L4.997 6.178Z'></path>
                                    <path d='M9.206 7.501a.75.75 0 0 1 .793.705l.5 8.5A.75.75 0 1 1 9 16.794l-.5-8.5a.75.75 0 0 1 .705-.793Zm6.293.793A.75.75 0 1 0 14 8.206l-.5 8.5a.75.75 0 0 0 1.498.088l.5-8.5Z'></path>
                                </svg></a></button></td>
                                </tr>";
        }
    }
    echo "</tbody>
            </table><br><br>";
} else {
    echo "<p class='caption'>Listes de mes interventions</p><br><br><h2>Vous n'avez pas d'intervention</h2><br><br>";
}

if ($_SESSION["role"] == "technicien") {
    if (count($unAssignedInterventions) > 0) {
        echo "<br><table class='tableau' border-collapse='collapse' >

        <caption class='caption'>Listes des interventions non assigner</caption>
        <thead>
            <tr>
                <th>Materiel</th>
                <th>Technicien</th>
                <th>Date</th>
                <th>Statut de l'intervention</th>
                <th>Description</th><th>Actions</th>";
        echo "</tr>
        </thead>
        <tbody>";

        foreach ($unAssignedInterventions as $unAssignedIntervention) {
            $materiel = $materielController->selectMaterielById($unAssignedIntervention['id_materiel']);
            if ($unAssignedIntervention['id_technicien'] == null) {
                $technicien = null;
            } else {
                $technicien = $userController->selectUserById($unAssignedIntervention['id_technicien']);
            }

            echo "<tr>
              <td>" . $materiel['nom'] . "</td>
              <td>";
            if ($technicien !== null) {
                echo $technicien['nom'] . " " . $technicien['prenom'];
            } else {
                echo "Non assigner ";
            }
            echo "</td>";
            echo "<td>" . $unAssignedIntervention['date_inter'] . "</td>
              <td>" . $unAssignedIntervention['status'] . "</td>
              <td>" . $unAssignedIntervention['description'] . "</td><td class='actions'>";

            if ($_SESSION["role"] !== "client") {
                echo "
                <button><a href='index.php?action=edit&id=" . $unAssignedIntervention['id_intervention'] . "'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                    <path d='M17.263 2.177a1.75 1.75 0 0 1 2.474 0l2.586 2.586a1.75 1.75 0 0 1 0 2.474L19.53 10.03l-.012.013L8.69 20.378a1.753 1.753 0 0 1-.699.409l-5.523 1.68a.748.748 0 0 1-.747-.188.748.748 0 0 1-.188-.747l1.673-5.5a1.75 1.75 0 0 1 .466-.756L14.476 4.963ZM4.708 16.361a.26.26 0 0 0-.067.108l-1.264 4.154 4.177-1.271a.253.253 0 0 0 .1-.059l10.273-9.806-2.94-2.939-10.279 9.813ZM19 8.44l2.263-2.262a.25.25 0 0 0 0-.354l-2.586-2.586a.25.25 0 0 0-.354 0L16.061 5.5Z'></path>
                                </svg></a>";
            }
            if($_SESSION["role"] == "admin" || $_SESSION["role"] == "client"){
            echo "</button><button class='delete'><a href='index.php?action=delete&id=" . $unAssignedIntervention['id_intervention'] . "'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                    <path d='M16 1.75V3h5.25a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1 0-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75Zm-6.5 0V3h5V1.75a.25.25 0 0 0-.25-.25h-4.5a.25.25 0 0 0-.25.25ZM4.997 6.178a.75.75 0 1 0-1.493.144L4.916 20.92a1.75 1.75 0 0 0 1.742 1.58h10.684a1.75 1.75 0 0 0 1.742-1.581l1.413-14.597a.75.75 0 0 0-1.494-.144l-1.412 14.596a.25.25 0 0 1-.249.226H6.658a.25.25 0 0 1-.249-.226L4.997 6.178Z'></path>
                                    <path d='M9.206 7.501a.75.75 0 0 1 .793.705l.5 8.5A.75.75 0 1 1 9 16.794l-.5-8.5a.75.75 0 0 1 .705-.793Zm6.293.793A.75.75 0 1 0 14 8.206l-.5 8.5a.75.75 0 0 0 1.498.088l.5-8.5Z'></path>
                                </svg></a></button></td>
                                </tr>";
            }
        }
        echo "</tbody>
        </table>";
    } else {
        echo "<p class='caption'>Listes des interventions non assigner</p><br><br><h2>Il n'y a pas d'intervention non assigner</h2><br><br>";
    }
}
