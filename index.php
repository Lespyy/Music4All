<?php
session_start();
session_unset();
session_destroy();

//require_once ("./conf/db_config.php");
?>

<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Music4All</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <!-- da lo stile dalla classe di bootstrap-->
  <div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4 text-primary">Music4All</h2>
        <h5 class="text-center mb-4">Accedi al tuo account</h5>
        <form action="./php/logincheck.php" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="nome@esempio.com" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="psw" name="psw" placeholder="••••••••" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
          <small>Non hai un account? <a href="./registra.php" class="text-decoration-none text-primary">Registrati</a></small>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
?>


