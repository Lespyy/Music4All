<div class="container mt-5" style="max-width: 500px;">
  <h2 class="mb-4 text-primary">Crea un nuovo album</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <!-- titolo -->
    <div class="mb-3">
      <label for="titolo" class="form-label">titolo album <span class="text-danger">*</span></label>
      <input type="text" id="titolo" name="titolo" class="form-control" required maxlength="30"
             value="<?= isset($_POST['titolo']) ? $_POST['titolo'] : '' ?>" />
    </div>

    <div class="mb-3">
      <label for="path_image" class="form-label">path_image album <span class="text-danger">*</span></label>
      <input type="text" id="path_image" name="path_image" class="form-control" required maxlength="30"
             value="<?= isset($_POST['path_image']) ? $_POST['path_image'] : '' ?>" />
    </div>

    <!-- Anno -->
    <div class="mb-3">
      <label for="anno" class="form-label">Anno di pubblicazione</label>
      <input type="number" id="anno" name="anno" class="form-control"
             value="<?= isset($_POST['anno']) ? (int)$_POST['anno'] : '' ?>" />
    </div>

    <!-- Genere -->
    <div class="mb-3">
      <label for="id_genere" class="form-label">Genere</label>
      <select id="id_genere" name="id_genere" class="form-select">
        <option value="">-- Seleziona un genere --</option>
        <?php foreach ($generi as $g): ?>
          <option value="<?= $g['id'] ?>"
            <?= (isset($_POST['id_genere']) && $_POST['id_genere']==$g['id']) ? 'selected' : '' ?>>
            <?= $g['nome'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Artista -->
    <div class="mb-3">
      <label for="id_artista" class="form-label">Artista</label>
      <select id="id_artista" name="id_artista" class="form-select">
        <option value="">-- Seleziona un artista --</option>
        <?php foreach ($artisti as $a): ?>
          <option value="<?= $a['id'] ?>"
            <?= (isset($_POST['id_artista']) && $_POST['id_artista']==$a['id']) ? 'selected' : '' ?>>
            <?= $a['nick'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Crea Playlist</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>