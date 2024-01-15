<?php
require("../../Model/checkSession/checkSession.php");
checkMailAdmin();
ob_start();
require_once '../../Model/Admin/ManageValidation.php';
include "../../Controller/BarreMenu/BarreMenu.php";
getUsersNonValidate();
require_once '../../View/Admin/ManageValidation.php';


if ($_SESSION["usersNonValidate"] == null) {
    echo '<h1>Il n\'y a pas d\'utilisateur à valider</h1>';
}

if (isset($_POST["Valider"])){
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
            window.location.href = '../../Controller/Admin/ManageValidation.php';
        }
    });
</script>
<?php
    setValidation($_POST["email"]);
    setDateValidation();
}

if (isset($_POST["Refuser"])){
    ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Nouvel utilisateur caché',
        text: 'Le nouvel utilisateur a bien été caché !'
    }).then((result) => {
        // Vérifier si le bouton "OK" a été cliqué
        if (result.value) {
            // Redirection côté client
            window.location.href = '../../Controller/Admin/ManageValidation.php';
        }
    });
</script>
<?php
    setRefus($_POST["email"]);
}
