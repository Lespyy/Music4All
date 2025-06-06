<?php
include("./templates/header.php");
include("./conf/db_config.php");

if (!isset($_GET['id'])) {
    echo "ID album non fornito.";
    exit;
}

$album_id = (int) $_GET['id'];

$query = "
    SELECT 
        ar.nick AS nickname_artista,
        ar.bio AS bio_artista,
        cd.nome AS casa_discografica,
        g.nome AS genere
    FROM album a
    JOIN artisti ar ON a.id_artista = ar.id
    LEFT JOIN case_discografiche cd ON ar.id_casa_d = cd.id
    LEFT JOIN generi g ON a.id_genere = g.id
    WHERE a.id = ?
";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Errore nella query: " . $conn->error);
}

$stmt->bind_param("i", $album_id);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$info) {
    echo "Album non trovato.";
    exit;
}

include("./templates/dettagli_album.php");
?>
