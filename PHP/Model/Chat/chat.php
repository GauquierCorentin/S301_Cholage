<?php


/**
 * @return void
 * Fonction pour envoyer un message (ajout dans bdd)
 * @author Corentin Gauquier
 */
function envoyerMess($bdd)
{
    /* ce if sert a permettre d'envoyer des messages*/
    if (isset($_POST['message'])) {
        $message = nl2br(htmlspecialchars($_POST['message']));
        $insertMsg = $bdd->prepare('INSERT INTO messages(email, fullname, message, date) VALUES(?, ?, ?, ?)');
        $insertMsg->execute(array($_SESSION['mail'],$_SESSION['fullname'],$message,date('Y-m-d H:i:s')));
        header('Location: chat.php');
    }
}

/**
 * @return void
 * Fonction pour recharger le chat (sans recharger la page, jquery)
 * @author Corentin Gauquier
 */
function loadChat(){
    ?>
    <section id="messages"></section>
    <script>
        setInterval('load_messages()',500);
        function load_messages() {
            console.log('Debug - Calling loadChat.php...');
            $('#messages').load('../../Controller/Chat/loadchat.php', function(response, status, xhr) {
                console.log('Debug - loadChat.php Response:', response);
                console.log('Debug - loadChat.php Status:', status);
                console.log('Debug - loadChat.php XHR:', xhr);
            });
        }
    </script>
    <?php
}

/**
 * @return void
 * Fonction pour supprimer les messages vieux de 1 jour
 * @author Corentin Gauquier
 */
function deleteOldMessages($pdo) {
    try {
        $currentDate = new DateTime();
        $currentDate->modify('-1 day');
        $formattedDate = $currentDate->format('Y-m-d H:i:s');
        $query = "DELETE FROM messages WHERE date < :formattedDate";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':formattedDate', $formattedDate, PDO::PARAM_STR);
        $statement->execute();

    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
}

?>