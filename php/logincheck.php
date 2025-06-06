<?php

#### è necessario per effettuare il login ####


//con il require riporto il codice di connessione ad DB
require("../conf/db_config.php");

//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
$stmt = $conn->prepare("SELECT * FROM utenti WHERE email = ? AND psw = ?");
$stmt->bind_param("ss", $_POST['email'], $_POST['psw']);
$stmt->execute();

//Salvo i dati della query: lavoro su una SINGOLA RIGA
$result = $stmt->get_result();
$row = $result->fetch_assoc();

//chiudo la connessione
$conn->close();

if (($_POST['email']==$row['email'])&&($_POST['psw']==$row['psw'])){
    /*se il login è corretto rimanda alla pagina HOME salvando nella SESSION i dati principali dell'utente*/
    session_start();
    
    $_SESSION['login']='ok';
    $_SESSION['utente'] = [ //Aggiunta sta parte
        'id' => $row['id'],
        'nome' => $row['nome'],
        'cognome' => $row['cognome'],
        'tipo' => $row['tipo'], //1 = free, 2 = premium, 0 = amministrator
        'email' => $row['email']
    ];
    if($_SESSION['utente']['tipo'] == 0){ //Aggiunto ['utente']
        header("location: ../home_adm.php");
    }else{
        header("location: ../home.php");
    }
    
}else{
    //rimando alla pagina del FORM di login una variabile "msg" che verrà letto in
    //$_GET[] per stampare l'errore nella index.php
    header("location: ../index.php?msg=ERR_ACCESSO");
}

?>