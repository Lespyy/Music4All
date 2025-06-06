<div class="container mt-5" style="max-width: 500px;">
  <h2 class="mb-4 text-primary">Crea una nuova playlist</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" action="./crea_playlist.php">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome Playlist <span class="text-danger">*</span></label>
      <input type="text" id="nome" name="nome" class="form-control" required maxlength="30" value="<?= isset($_POST['nome']) ? $_POST['nome'] : '' ?>" />
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Descrizione</label>
      <textarea id="desc" name="desc" rows="3" class="form-control"><?= isset($_POST['desc']) ? $_POST['desc'] : '' ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Crea Playlist</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>