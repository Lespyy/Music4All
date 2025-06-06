<?php
include("./templates/header.php");
require_once("./conf/db_config.php");

$idPlaylist = $_GET['id'] ?? null;
if (!$idPlaylist) {
    echo "<div class='container'><p>Playlist non specificata.</p></div>";
    exit();
}

$search = $_GET['search'] ?? '';
$search_sql = $conn->real_escape_string($search);

// Cerca solo per titolo canzone
$sql = "SELECT id, titolo FROM Canzoni WHERE titolo LIKE '%$search_sql%'";
$canzoni = $conn->query($sql);

// Canzoni già presenti nella playlist
$sqlPresenti = "SELECT id_canzone FROM Contiene WHERE id_playlist = $idPlaylist";
$presenti = $conn->query($sqlPresenti);
$presenti_ids = [];
while ($row = $presenti->fetch_assoc()) {
    $presenti_ids[] = $row['id_canzone'];
}

include("./templates/modifica_playlist_temp.php")
?>

