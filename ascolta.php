<?php
require("./conf/db_config.php");
include_once("./templates/header.php");

$is_free = isset($_SESSION['utente']) && $_SESSION['utente']['tipo'] == 1 ? 'true' : 'false'; //Serve per la pubblicità, controlla se l'utente ha un account gratuito

//echo "Tipo utente: " . $_SESSION['utente']['tipo'];

$type = $_GET['type']; //Prendo il tipo dall'URL, "album" o "playlist"
$id = (int) $_GET['id']; //Id playlist/album

if ($type == "album") {
    // Titolo
    $stmt = $conn->prepare("SELECT titolo FROM Album WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title);
    $stmt->fetch();
    $stmt->close();

    // Canzoni
    $stmt = $conn->prepare("SELECT titolo, id FROM Canzoni WHERE id_album = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $songs = []; //Così resetto
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row; //Lo aggiungo all'array
        //echo $songs;
    }
    $stmt->close();
}
else if ($type === "playlist" && $id != 0) {
    // Titolo
    $stmt = $conn->prepare("SELECT nome FROM Playlist WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title);
    $stmt->fetch();
    $stmt->close();

    // Canzoni
    $stmt = $conn->prepare("
        SELECT c.titolo, c.id 
        FROM Canzoni c
        JOIN Contiene co ON c.id = co.id_canzone
        WHERE co.id_playlist = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $songs = []; //Così resetto
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
    $stmt->close();
}
else if($id === 0){
    $stmt = $conn->prepare("
        select titolo, id 
        from valuta, canzoni 
        where id_canzone = id 
        and id_utente = ? 
        order by valutazione desc 
        limit 10;
    ");
    $stmt->bind_param("i", $_SESSION["utente"]["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $songs = []; //Così resetto
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
    $stmt->close();
}

include("./templates/ascolta_temp.php")
?>

