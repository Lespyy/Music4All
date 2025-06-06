<?php
#### serve per registrare all'interno di ascolta che canzone ha ascoltato l'utente e quando  una sorta di log ####

require("../conf/db_config.php");
session_start();


if(isset($_POST['song_id']) && isset($_SESSION['utente']['id'])) {
    $song_id = (int)$_POST['song_id'];
    $user_id = $_SESSION['utente']['id'];

    $stmt = $conn->prepare("INSERT INTO ascolta (id_utente, id_canzone, data) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $song_id);
    $result = $stmt->execute();

    if ($result) {
        echo "OK";
    } else {
        echo "Errore SQL: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Dati mancanti: " . json_encode($_POST) . " - Sessione: " . json_encode($_SESSION);
}

$conn->close();
?>
