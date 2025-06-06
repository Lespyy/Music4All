<?php
include('./templates/header.php');
require('./conf/db_config.php');


$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prendo i dati dal form
    $nome = trim($_POST['nome']); //trim è usato per togliere eventuali spazi indesiderati
    $desc = trim($_POST['desc']);
    $id_utente = $_SESSION['utente']['id'];

    if (empty($nome)) {
        $error = "Il nome della playlist è obbligatorio.";
    } else {
        // Inserisci la playlist nel db
        $stmt = $conn->prepare("INSERT INTO `playlist`(`nome`, `desc`, `id_utente`) VALUES (?,?,?)");
        $stmt->bind_param("sss", $nome, $desc, $id_utente);

        if ($stmt->execute()) {
            // Recupera l'id appena inserito (opzionale)
            $last_id = $conn->insert_id;
            // Reindirizza a pagina playlist_utente.php o simile
            header("Location: modifica_playlist.php?id=" . $last_id);
            exit();
        } else {
            $error = "Errore durante la creazione della playlist: " . $stmt->error;
        }

        $stmt->close();
    }
}

include("./templates/crea_playlist_temp.php");
?>