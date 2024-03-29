<?php
require("../../Model/checkSession/checkSession.php");
checkMailAdmin();
ob_start();
require_once '../../Model/Admin/ShowHiddenValidation.php';
getUsersHidden();
include "../../Controller/BarreMenu/BarreMenu.php";
require_once '../../View/Admin/ShowHiddenValidation.php';

if ($_SESSION["usersHidden"] == null) {
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

if (isset($_POST["Valider"])){
    updateHidden($_POST["email"]);
    setValidation($_POST["email"]);
    ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Nouvel utilisateur validé',
        text: 'Le nouvel utilisateur a bien été validé !'
    }).then((result) => {
        // Vérifier si le bouton "OK" a été cliqué
        if (result.value) {
            // Redirection côté client
            window.location.href = '../../Controller/Admin/ShowHiddenValidation.php';
        }
    });
</script>
<?php
}