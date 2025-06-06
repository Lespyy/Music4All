<?php
include_once("./header.php");
require("../conf/db_config.php");

//Prendo i dati dal form di ascolta.php
$id_utente = $_POST['id_utente'];
$id_canzone = $_POST['id_canzone'];
$valutazione = $_POST['valutazione'];
$index = $_POST['current_index'];
$type = $_POST['type'];
$id = $_POST['id'];

$data = date('Y-m-d'); //Mi salvo la data attuale

if (empty($id_utente) || empty($id_canzone) || empty($valutazione)) {
        die("Errore: campi mancanti.");
}
echo "UTENTE: $id_utente, CANZONE: $id_canzone, VAL: $valutazione, DATA: $data";

//Controlla se esiste già una valutazione
$check = $conn->prepare("SELECT valutazione FROM Valuta WHERE id_utente = ? AND id_canzone = ?");
$check->bind_param("ii", $id_utente, $id_canzone);
$check->execute();
$result = $check->get_result();

if ($result && $result->num_rows > 0) {
    //C'è già una valutazione, per cui aggiorno valutazione esistente
    $update = $conn->prepare("UPDATE Valuta SET valutazione = ?, data = ? WHERE id_utente = ? AND id_canzone = ?");
    $update->bind_param("isii", $valutazione, $data, $id_utente, $id_canzone);
    $update->execute();
    $update->close();
} else {
    //Inserisce una nuova valutazione
    $stmt = $conn->prepare("INSERT INTO Valuta (id_utente, id_canzone, valutazione, data) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $id_utente, $id_canzone, $valutazione, $data);
    //$stmt->execute();
    if ($stmt->execute()) {
        echo "Inserimento riuscito!";
    } else {
        echo "Errore nell'inserimento: " . $stmt->error;
    }

    $stmt->close();
}

$check->close();
$conn->close();

//Redirect alla pagina precedente
header("Location: ../ascolta.php?type=$type&id=$id&index=$index"); //Ritorno nella canzone di prima (Però parte dall'inizio)
exit;
?>
