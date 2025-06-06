<?php

include("./templates/header.php");

include("./conf/db_config.php");

  if(!isset($_SESSION['album_trovati'])){
    $stmt = $conn->prepare("SELECT * from album");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
  }
  else{
    $rows = $_SESSION['album_trovati'];
  }
  include("./templates/home_temp.php");
?>
