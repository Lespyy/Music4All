<?php
include("./templates/header.php");
include("./conf/db_config.php");

// Se non abbiamo già in sessione le playlist trovate, le carichiamo dal DB
    // QUERY: recupera ogni playlist dell'utente e conta le canzoni in essa
    $stmt = $conn->prepare("SELECT p.id, p.nome, p.desc, COUNT(*) AS num_canzoni FROM playlist AS p LEFT JOIN contiene AS c ON c.id_playlist = p.id WHERE p.id_utente = ? GROUP BY p.id, p.nome, p.desc ORDER BY p.nome ");
    $stmt->bind_param("s", $_SESSION['utente']['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Salvo in sessione per pagine successive
    $_SESSION['playlist_trovate'] = $rows;

    include("./templates/tue_playlist_temp.php");
?>

