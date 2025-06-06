<?php
    require("../conf/db_config.php");
    session_start();
    //qui useremmo delle API di paypal o altre applicazioni per scambio di denaro digitale 

    $stmt = $conn->prepare('UPDATE utenti
                            SET tipo = 2
                            WHERE id = ?');
    $stmt->bind_param("s", $_SESSION['utente']['id']);
    $stmt->execute();
    $conn->close();

    header("location: ../index.php");
?>