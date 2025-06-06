<?php
include("./templates/header.php");
include("./conf/db_config.php");

$error = "";
$success = "";

// Gestione eliminazione album, canzoni collegate e record collegati in ascolta, contiene, valuta
if (isset($_GET['delete_album'])) {
    $del_id = (int) $_GET['delete_album'];

    // Inizio transazione per garantire coerenza
    $conn->begin_transaction();

    // 1. Elimina record di ascolto collegati alle canzoni dell'album
    $sqlListen = "DELETE a
                  FROM ascolta AS a
                  INNER JOIN canzoni AS c ON a.id_canzone = c.id
                  WHERE c.id_album = ?";
    $stmt = $conn->prepare($sqlListen);
    $stmt->bind_param("i", $del_id);
    $ok1 = $stmt->execute();
    $stmt->close();

    // 2. Elimina record nella tabella contiene collegati alle canzoni dell'album
    $sqlContain = "DELETE ct
                   FROM contiene AS ct
                   INNER JOIN canzoni AS c ON ct.id_canzone = c.id
                   WHERE c.id_album = ?";
    $stmt = $conn->prepare($sqlContain);
    $stmt->bind_param("i", $del_id);
    $ok2 = $stmt->execute();
    $stmt->close();

    // 3. Elimina record nella tabella valuta collegati alle canzoni dell'album
    $sqlValuta = "DELETE v
                  FROM valuta AS v
                  INNER JOIN canzoni AS c ON v.id_canzone = c.id
                  WHERE c.id_album = ?";
    $stmt = $conn->prepare($sqlValuta);
    $stmt->bind_param("i", $del_id);
    $ok3 = $stmt->execute();
    $stmt->close();

    // 4. Elimina canzoni collegate all'album
    $sqlSongs = "DELETE FROM canzoni WHERE id_album = ?";
    $stmt = $conn->prepare($sqlSongs);
    $stmt->bind_param("i", $del_id);
    $ok4 = $stmt->execute();
    $stmt->close();

    // 5. Elimina l'album
    $sqlAlbum = "DELETE FROM album WHERE id = ?";
    $stmt = $conn->prepare($sqlAlbum);
    $stmt->bind_param("i", $del_id);
    $ok5 = $stmt->execute();
    $stmt->close();

    if ($ok1 && $ok2 && $ok3 && $ok4 && $ok5) {
        $conn->commit();
        $success = "Album e dati correlati eliminati con successo.";
        unset($_SESSION['album_trovati']);
        header('Location: home_adm.php?success=' . urlencode($success));
        exit;
    } else {
        $conn->rollback();
        $error = "Errore durante eliminazione: " . $conn->error;
    }
}

// Recupero eventuale messaggio di successo
if (isset($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']);
}

// Recupero lista album
if (!isset($_SESSION['album_trovati'])) {
    $stmt = $conn->prepare("SELECT * FROM album ORDER BY id DESC");
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $rows = $_SESSION['album_trovati'];
}

include("./templates/home_adm_temp.php");

?>

