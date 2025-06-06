<?php
include('./templates/header.php');
require('./conf/db_config.php');

$error = "";
$success = "";

// 1. Carico in array generi e artisti
$generi = [];
$artisti = [];

$gRes = $conn->query("SELECT id, nome FROM generi ORDER BY nome");
if ($gRes) {
    while ($row = $gRes->fetch_assoc()) {
        $generi[] = $row;
    }
}

$aRes = $conn->query("SELECT id, nick FROM artisti ORDER BY nick");
if ($aRes) {
    while ($row = $aRes->fetch_assoc()) {
        $artisti[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pulizia input
    $titolo      = trim($conn->real_escape_string($_POST['titolo']));
    $path_image  = trim($conn->real_escape_string($_POST['path_image']));
    $anno      = (int) $_POST['anno'];
    $id_genere = (int) $_POST['id_genere'];
    $id_artista= (int) $_POST['id_artista'];

    if (empty($titolo)) {
        $error = "Il titolo della playlist è obbligatorio.";
    } else {
        // 2. Inserimento con tutti i campi
        $sql = "
          INSERT INTO Album 
            (titolo, annoP, id_genere, id_artista, path_img) 
          VALUES 
            ('$titolo', $anno, $id_genere, $id_artista, '$path_image')
        ";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            header("Location: aggiungi_a_album.php?id=" . $last_id);
            exit();
        } else {
            $error = "Errore durante la creazione della playlist: " . $conn->error;
        }
    }
}

include("./templates/crea_album_temp.php");
?>


