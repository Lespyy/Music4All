<?php
#INseriamo le credenziali per accedere al db mysqli
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_4_all";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
#nel caso di errore lo si riporta
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
