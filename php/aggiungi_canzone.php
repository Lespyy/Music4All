<?php

#### serve per aggiungere una corrispondenza playlist canzone all'interno di contiene ####

require_once("../conf/db_config.php");

#facciamo la query in cui inseriamo in contiene playlist e canzone
$stmt = $conn->prepare("INSERT INTO Contiene (id_playlist, id_canzone) VALUES (?, ?)");
$stmt->bind_param("ss", $_POST['id_playlist'], $_POST['id_canzone']);
$stmt->execute();
$conn->close();

#torniamo a modifica_playlist
header("Location: ../modifica_playlist.php?id=" . $_POST['id_playlist']);
exit();
