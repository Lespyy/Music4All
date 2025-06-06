<?php

#### server per fare la barra di ricerca all'interno dei menu ####

session_start();

include("../conf/db_config.php");

#permette di cercare quali album hanno quel nome con il like
$stmt = $conn->prepare("SELECT * from album where titolo like ?");
$titolo = "%" . $_GET["titolo"] . "%"; #mettimao le percentuali
$stmt->bind_param("s", $titolo);
$stmt->execute();
$result = $stmt->get_result();

$albums = $result->fetch_all(MYSQLI_ASSOC);

#la salvo in session per poi stamparli nella home 
$_SESSION['album_trovati'] = $albums;

header("location: ../home.php");

?>