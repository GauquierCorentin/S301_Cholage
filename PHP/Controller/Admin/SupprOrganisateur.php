<?php
require("../../Model/checkSession/checkSession.php");
checkMailAdmin();
include ('../../View/BarreMenu/BarreMenu.php');
?>
<?php
ob_start();
require_once ("../../Model/Admin/SupprOrganisateur.php");
recupUsersOrga();
require_once ("../../View/Admin/SupprOrganisateur.php");
if ($_SESSION["users"] == null) {
    echo '<h1>Il n\'y a pas d\'organisateur</h1>';
}

if (isset($_POST["submit"])){
    UpdateStatut($_POST["test"]);

    ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Nouvel organisateur suppirmé',
        text: 'Le nouvel organisateur a bien été supirmé !'
    }).then((result) => {
        // Vérifier si le bouton "OK" a été cliqué
        if (result.value) {
            // Redirection côté client
            window.location.href = '../../Controller/Admin/SupprOrganisateur.php';
        }
    });
</script>
<?php
}
