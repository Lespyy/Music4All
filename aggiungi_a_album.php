<?php
include('./templates/header.php');
require('./conf/db_config.php');

$error = "";
$success = "";

// Recupero id album da GET o POST
$album_id = 0;
if (isset($_GET['id'])) {
    $album_id = (int) $_GET['id'];
} elseif (isset($_POST['album_id'])) {
    $album_id = (int) $_POST['album_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pulizia input
    $titolo    = trim($_POST['titolo']);
    $lunghezza = trim($_POST['lunghezza']); // formato HH:MM:SS
    $path_file = trim($_POST['path_file']);
    $btn_stop  = isset($_POST['stop']);

    // Validazioni
    if ($titolo === '') {
        $error = "Il titolo della canzone è obbligatorio.";
    } elseif ($lunghezza === '') {
        $error = "La durata della canzone è obbligatoria.";
    } elseif ($path_file === '') {
        $error = "Il path del file è obbligatorio.";
    }

    // Se non ci sono errori, procedo all'inserimento
    if ($error === '') {
        $stmt = $conn->prepare("
            INSERT INTO canzoni (titolo, lung, id_album)
            VALUES (?, ?, ?)
        ");

        if ($stmt) {
            $stmt->bind_param("ssi", $titolo, $lunghezza, $album_id);

            if ($stmt->execute()) {
                if ($btn_stop) {
                    $stmt->close();
                    $conn->close();
                    header("Location: home_adm.php");
                    exit();
                }
                $success = "Canzone inserita con successo. Puoi aggiungerne un'altra.";
                $_POST = []; // reset form
            } else {
                $error = "Errore durante l'inserimento: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Errore nella preparazione della query: " . $conn->error;
        }
    }
}

$conn->close();
include("./templates/aggiungi_a_album_temp.php");
?>
