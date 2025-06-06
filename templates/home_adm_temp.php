<div class="container my-5">
    <h1 class="text-center mb-4">Homepage Admin</h1>

    <?php if ($error): ?>
      <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="alert alert-success text-center"><?= $success ?></div>
    <?php endif; ?>

    <!-- Barra di ricerca -->
    <div class="row justify-content-center mb-5">
      <div class="col-md-6">
        <form method="GET" action="./php/cerca.php">
          <div class="input-group">
            <input type="text" name="titolo" class="form-control text-center" placeholder="Cerca album">
            <button class="btn btn-primary" type="submit">Cerca</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Card album -->
    <?php $c = 0; foreach ($rows as $row):
      if ($c % 3 === 0) echo '<div class="row g-4 mb-5">'; ?>
      <div class="col-md-4">
        <div class="card bg-secondary text-white h-100">
          <img src="<?= $row['path_img'] ?>" class="card-img-top" alt="<?= $row['titolo'] ?>">
          <div class="card-body d-flex flex-column align-items-center">
            <h5 class="card-title text-center"><?= $row['titolo'] ?> (<?= $row['annoP'] ?>)</h5>
            <div class="mt-auto w-100 d-flex justify-content-between">
              <a href="ascolta.php?type=album&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Ascolta</a>               
              <form action="home_adm.php" method="GET" onsubmit="return confirm('Eliminare album e dati correlati?');"> 
                <input type="hidden" name="delete_album" value="<?= $row['id'] ?>">
                <button class="btn btn-danger btn-sm">Elimina</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php $c++; if ($c % 3 === 0) echo '</div>'; endforeach;
    if ($c % 3 !== 0) echo '</div>'; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
