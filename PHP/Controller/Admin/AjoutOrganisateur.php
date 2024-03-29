<?php
require("../../Model/checkSession/checkSession.php");
checkMailAdmin();

ob_start();
require_once("../../Model/Admin/AjoutOrganisateur.php");
recupUsersNonOrga();
include "../../Controller/BarreMenu/BarreMenu.php";
require_once("../../View/Admin/AjoutOrganisateur.php");

if ($_SESSION["users"] == null) {
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

if (isset($_POST["submit"])) {
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Nouvel organisateur ajouté',
            text: 'Le nouvel organisateur a bien été ajouté !'
        }).then((result) => {
            // Vérifier si le bouton "OK" a été cliqué
            if (result.value) {
                // Redirection côté client
                window.location.href = '../../Controller/Admin/AjoutOrganisateur.php';
            }
        });
    </script>
<?php
    UpdateStatutAdd($_POST["test"]);
}

