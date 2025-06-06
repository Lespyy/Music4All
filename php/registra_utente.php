<?php
require('../conf/db_config.php');

//Recupero il tipo di dato dal form e lo trasformo in int per sicurezza
$tipo = (int) $_POST['tipo'];

// Preparazione e inserimento nel database
$stmt = $conn->prepare("INSERT INTO Utenti (nome, cognome, email, tipo, psw) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $_POST['nome'], $_POST['cognome'], $_POST['email'], $tipo, $_POST['psw']);

if ($stmt->execute()) {
    echo "<div style='padding: 20px;'>Registrazione completata con successo <a href='../index.php'>Vai al login</a></div>";
} else {
    echo "Errore durante la registrazione: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>