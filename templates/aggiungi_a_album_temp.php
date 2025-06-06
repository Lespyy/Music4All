<div class="container mt-5" style="max-width: 600px;">
  <h2 class="mb-4 text-primary">Aggiungi canzoni all'album #<?= $album_id ?></h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="hidden" name="album_id" value="<?= $album_id ?>" />

    <!-- Titolo canzone -->
    <div class="mb-3">
      <label for="titolo" class="form-label">Titolo canzone <span class="text-danger">*</span></label>
      <input type="text" id="titolo" name="titolo" class="form-control" required maxlength="100"
             value="<?= isset($_POST['titolo']) ? $_POST['titolo'] : '' ?>" />
    </div>

    <!-- Durata (TIME) -->
    <div class="mb-3">
      <label for="lunghezza" class="form-label">Durata (HH:MM:SS) <span class="text-danger">*</span></label>
      <input type="time" id="lunghezza" name="lunghezza" class="form-control" step="1"
             value="<?= isset($_POST['lunghezza']) ? $_POST['lunghezza'] : '' ?>" required />
    </div>

    <!-- Path del file -->
    <div class="mb-3">
      <label for="path_file" class="form-label">Path del file <span class="text-danger">*</span></label>
      <input type="text" id="path_file" name="path_file" class="form-control" required maxlength="255"
             value="<?= isset($_POST['path_file']) ? $_POST['path_file'] : '' ?>" />
    </div>

    <!-- Pulsanti -->
    <div class="d-flex justify-content-between">
      <button type="submit" name="stop" class="btn btn-secondary">aggiungi ultima</button>
      <button type="submit" class="btn btn-primary">Continua a inserire</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>