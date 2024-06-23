<?php
$today = getdate();
$minDate = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
    echo '<form class="formulaire" action="index.php" method="post">
    ' . $tableau;


    // filtrer les interventions par type d'intervention avec onchange="showDropdown(this.value)"
    // echo '
    // <div>
    //     <label for="type">Choisissez un type :</label></br>
    //     <select name="type" id="type" onchange="showDropdown(this.value)" required>
    //         <option value="material">Matériel</option>
    //         <option value="software">Logiciel</option>
    //     </select>
    // </div>';
    echo '
    <div id="materialDropdown">
        <label for="id_materiel">Les materiels :</label></br>
        <select name="id_materiel" id="id_materiel" required>';
    foreach ($materielController->allMateriel() as $materiel) {
        echo '<option value="' . $materiel["id_materiel"] . '">' . $materiel["nom"] . '</option>';
    }
    echo '</select>
    </div>';
    if ($_SESSION["role"] == "technicien") {
        echo '<div>
        <input type="hidden" name="technicien_id" id="technicien_id" value="' . $userController->selectTechnicienById($_SESSION["id"])["id_technicien"] . '" placeholder=" " required />
        </div>';
    }


    if (substr($_SESSION["role"], 0, 5) == "admin" || $_SESSION["role"] == "superviseur") {
        echo '
    <div>
        <input type="datetime-local" min="' . $minDate . '" class="peer" id="date_inter" name="date_inter" placeholder=" ">
        <label for="date_inter" class="peer-placeholder-shown:scale-100 peer-focus:-translate-y-6">
            Date
        </label>
    </div>';

        echo '
    <div>
        <label for="status">Statut de l\'intervention</label></br>
        <select name="status" id="status" required>
            <option value="En cours">En cours</option>
            <option value="Terminer">Terminer</option>
        </select>
    </div>';

    echo '
    <div>
        <label for="priorite">Priorite de l\'intervention</label></br>
        <select name="priorite" id="priorite" required>
            <option value="Urgente">Urgente</option>
            <option value="Mineur">Mineur</option>
        </select>
    </div>';
    }

    echo '<div>
        <label for="description">Description</label></br>
        <textarea id="description" name="description" placeholder="Problème de.... identifier..." required></textarea>
    </div>
    <button type="submit" class="' . $IsDisabled . '" id="Ajoutez" name="Ajoutez" value="Ajoutez" ' . $IsDisabled . ' >Ajoutez</button>
    </form>';

    

    // filtrer les interventions par type d'intervention showDropdown(this.value)
    // echo '
    // <script>
    // function showDropdown(type) {
    //     var materialDropdown = document.getElementById("materialDropdown");
    //     var softwareDropdown = document.getElementById("softwareDropdown");
    //     var materialSelect = document.getElementById("id_materiel");
    //     var softwareSelect = document.getElementById("id_logiciel");

    //     if(type === "material"){
    //         materialDropdown.style.display = "block";
    //         materialSelect.required = true;
    //         softwareSelect.required = false;
    //     }else{
    //         materialDropdown.style.display = "none";
    //         materialSelect.required = false;
    //     }
    //     if(type === "software"){
    //         softwareDropdown.style.display = "block";
    //         softwareSelect.required = true;
    //         materialSelect.required = false;
    //     }else{
    //         softwareDropdown.style.display = "none";
    //         softwareSelect.required = false;
    //     }
    // }
    // </script>';
?>
