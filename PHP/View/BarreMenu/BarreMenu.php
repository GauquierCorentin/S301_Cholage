<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../../View/Style/styleNavBar.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../Controller/Accueil/MainPage.php">
            <img src="../../View/Image/logo0.png" width=70 height=70 alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php
                    if($_SESSION['isadmin'] == true || $_SESSION['isorganisateur'] == true){
                        echo '<a class="nav-link"  href="" data-bs-toggle="modal" data-bs-target="#Activite">Activités/Tournois</a>';
                    } else {
                        echo '<a class="nav-link" href="../../Controller/Activite/Activite.php">Activités/Tournois</a>';
                    };
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../Controller/Chat/chat.php">Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../View/Accueil/Information.php">Informations</a>
                </li>
                <?php
                ob_start();
                    if ($_SESSION['isValidate']==true || $_SESSION['isadmin']==true){
                        echo('<li class="nav-item">
                        <a class="nav-link"  href="" data-bs-toggle="modal" data-bs-target="#Equipe">équipe</a>
                        </li>');
                    }
                    if($_SESSION['isadmin'] == true || $_SESSION['isorganisateur'] == true){
                        echo('<li class="nav-item">
                        <a class="nav-link"  href="" data-bs-toggle="modal" data-bs-target="#Validation">Validation</a>
                        </li>');
                        echo('<li class="nav-item" >

                        <a class="nav-link" href="../../Controller/Tournoi/AjouterQuestionnaire.php">Créer un questionnaire</a>
                        </li>');
                    }
                if($_SESSION['isadmin'] == true){
                    echo('<li class="nav-item">
                        <a class="nav-link"  href="" data-bs-toggle="modal" data-bs-target="#Organisateur">Gestion Organisateur</a>
                        </li>');
                }
                ?>
                <li class="nav-item disconnect">
                    <a class="logo nav-link" href="../../Controller/Accueil/Disconnect.php">
                        <img alt="se déconnecter" class="rounded float-left img-fluid img-disconnect" src="../../View/Image/logOffIcon.png">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Div afin de permettre le choix dans gestion organisateur -->
<div class="modal fade" id="Organisateur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Que voulez-vous faire ?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-secondary" onclick="window.location.href='../../Controller/Admin/AjoutOrganisateur.php';" value="Ajouter un organisateur">
                <input type="button" class="btn btn-primary" onclick="window.location.href='../../Controller/Admin/SupprOrganisateur.php';" value="Supprimer un organisateur">

            </div>
        </div>
    </div>
</div>


<!-- div permettant les choix entres les différentes pages liées aux équipes -->
<div class="modal fade" id="Equipe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Que voulez-vous faire ?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <?php
                if ($_SESSION["equipe"]!=null){
                    echo "<a href='../../Controller/Tournoi/GestionEquipe.php'><button type='button' class='btn btn-primary'>Gestion équipe</button></a>";
                }
                ?>
                <input type="button" class="btn btn-primary" onclick="window.location.href='../../Controller/Tournoi/afficherEquipe.php';" value="Voir toutes les équipes">
                <input type="button" class="btn btn-primary" onclick="window.location.href='../../Controller/Tournoi/CreerEquipe.php';" value="Créer une équipe">
            </div>
        </div>
    </div>
</div>


<!-- Div afin d'afficher deux bouton distinct pour la gestion de la validation -->
<div class="modal fade" id="Validation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Que voulez-vous faire ?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-secondary" onclick="window.location.href='../../Controller/Admin/ManageValidation.php';" value="Voir tout les Utilisateurs">
                <input type="button" class="btn btn-primary" onclick="window.location.href='../../Controller/Admin/ShowHiddenValidation.php';" value="Voir les utlisateurs caché"   >
            </div>
        </div>
    </div>
</div>

<!-- Div afin d'afficher deux bouton distinct pour les activites -->

<div class="modal fade" id="Activite" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Que voulez-vous faire ?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <a href="../../Controller/Activite/Activite.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voir Activités</button></a>
                <a href="../../Controller/Activite/creerActivite.php"><button type="button" class="btn btn-primary">Créer Activité</button></a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>function alert(){
    window.alert("sima")
    }</script>
</body>
</html>
