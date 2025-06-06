<div class="container my-5">
    <h2 class="text-center">Modifica la tua playlist</h2>

    <form method="GET" class="my-3">
        <input type="hidden" name="id" value="<?= $idPlaylist ?>">
        <input type="text" name="search" class="form-control" placeholder="Cerca canzoni" value="<?= $search ?>">
    </form>

    <div class="list-group">
        <?php while ($canzone = $canzoni->fetch_assoc()): ?>
            <div class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                <span><?= $canzone['titolo'] ?></span>
                <?php if (in_array($canzone['id'], $presenti_ids)): ?>
                    <form method="POST" action="./php/rimuovi_canzone.php" class="d-inline">
                        <input type="hidden" name="id_playlist" value="<?= $idPlaylist ?>">
                        <input type="hidden" name="id_canzone" value="<?= $canzone['id'] ?>">
                        <button class="btn btn-danger btn-sm">−</button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="./php/aggiungi_canzone.php" class="d-inline">
                        <input type="hidden" name="id_playlist" value="<?= $idPlaylist ?>">
                        <input type="hidden" name="id_canzone" value="<?= $canzone['id'] ?>">
                        <button class="btn btn-success btn-sm">+</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>

        <a href="home.php" class="btn btn-secondary mt-3">Torna alla Home</a>
    </div>
</div>
