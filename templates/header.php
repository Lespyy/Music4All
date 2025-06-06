<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary fw-bold" href="#">Music4All</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <?php
            session_start();
            if(!isset($_SESSION['login'])){
                header("location: ./index.php");
            }
            #modifica la navbar in base al tipo di utente
            if($_SESSION['utente']['tipo'] == 0){
                echo('
                    <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="./home_adm.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./crea_album.php">Aggiungi Album</a>
                    <li class="nav-item">
                    <a class="nav-link" href="./php/logout.php">Logout</a>
                    </li>
                    </ul>
                ');
            }else{
                echo('
                    <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="./home.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./crea_playlist.php">Crea Playlist</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./tue_playlist.php">Tue playlist</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./php/logout.php">Logout</a>
                    </li>
                ');
                if ($_SESSION['utente']['tipo'] == 1){
                    echo('
                    <li class="nav-item">
                    <a class="nav-link" href="./pagamento_base.php">Abbonati</a>
                    </li>
                    </ul>
                    ');
                }
            }

        ?>
        
        </div>
    </div>
    </nav>

