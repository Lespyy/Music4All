
  <div class="container my-5">
    <h1 class="text-center mb-4">Le tue Playlist</h1>

    <!-- Tabella dinamica playlist -->
    <div class="table-responsive">
      <table class="table table-dark table-hover table-striped text-center align-middle">
        <thead class="table-primary text-dark">
          <tr>
            <th>Nome Playlist</th>
            <th>Descrizione</th>
            <th># Canzoni</th>
            <th>Azioni</th>
          </tr>
        </thead>
        <tbody>
          <tr>
                <td>PLAYLIST GENERATA IN AUTOMATICO</td>
                <td>Playlist suggerita da Music4All sulla base delle valutazioni date alle canzoni</td>
                <td>Max. 10</td>
                <td>

                  <a href="ascolta.php?type=playlist&id=0" class="btn btn-primary btn-sm">Ascolta</a>
                </td>
              </tr>
          <?php if (empty($rows)): ?>
            <tr>
              <td colspan="4">Non hai ancora creato playlist.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($rows as $row): ?>
              <tr>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['desc'] ?></td>
                <td><?= (int)$row['num_canzoni'] ?></td>
                <td>

                  <a href="ascolta.php?type=playlist&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Ascolta</a>
                  <form method="POST" action="./php/elimina.php" class="d-inline ms-1">
                    <input type="hidden" name="id_playlist" value="<?= (int)$row['id'] ?>">
                    <button class="btn btn-outline-danger btn-sm" type="submit">Elimina</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>