<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Registrazione Utente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h2 class="mb-4">Registrazione Utente</h2>

  <form action="./php/registra_utente.php" method="POST">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" required>
    </div>
    <div class="mb-3">
      <label for="cognome" class="form-label">Cognome</label>
      <input type="text" class="form-control" name="cognome" id="cognome" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" required>
    </div>
    <div class="mb-3">
      <label for="psw" class="form-label">Password</label>
      <input type="password" class="form-control" name="psw" id="psw" required>
    </div>
    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo Utente</label>
      <select name="tipo" id="tipo" class="form-select" required>
        <option value="1">Gratuito</option>
        <option value="2">Premium</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Registrati</button>
  </form>
</div>

</body>
</html>