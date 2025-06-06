<?php

#### server per rimuovere una canzone da una playlist ####

require_once("../conf/db_config.php");

$idPlaylist = $_POST['id_playlist'];
$idCanzone = $_POST['id_canzone'];

$sql = "DELETE FROM Contiene WHERE id_playlist = $idPlaylist AND id_canzone = $idCanzone";
$conn->query($sql);

header("Location: ../modifica_playlist.php?id=" . $idPlaylist);
exit();