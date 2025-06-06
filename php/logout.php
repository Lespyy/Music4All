<?php

    #### serve per effettuare il logout ###à

    #chiamo azzzero e cancello la sessione
    session_start();
    session_unset();
    session_destroy();

    #ritorno al login
    header("location: ../index.php");

?>