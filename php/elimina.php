<?php

    #### serve per cancellare una playlist ####

    require("../conf/db_config.php");
    session_start();
    //ID playlist
    #se è stata richiesta l'eliminazione di una playlist 
    if (isset($_POST['id_playlist'])) {
        $playlistId = (int) $_POST['id_playlist'];

        // Verifica che la playlist appartenga all'utente
        $checkStmt = $conn->prepare("SELECT id FROM playlist WHERE id = ? AND id_utente = ?");
        $checkStmt->bind_param("ss", $_POST['id_playlist'], $_SESSION["utente"]['id']);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows === 0) {
            die("Playlist non trovata o accesso negato.");
        }

        

        // Elimino associazioni in contiene
        $delAssoc = $conn->prepare("DELETE FROM contiene WHERE id_playlist = ?");
        $delAssoc->bind_param("s", $playlistId);
        $delAssoc->execute();

        // Elimino la playlist
        $delPlaylist = $conn->prepare("DELETE FROM playlist WHERE id = ?");
        $delPlaylist->bind_param("s", $playlistId);
        $delPlaylist->execute();

        

        // Aggiorno le playlist stampabili
        unset($_SESSION['playlist_trovate']);

        // Redirect a tue_playlist.php con messaggio
        header('Location: ../tue_playlist.php');
        exit;
    } else {
        die("Richiesta non valida.");
    }
?>
