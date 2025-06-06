<div class="container my-5">
  <h2 class="mb-4">Dettagli Album</h2>
  <div class="card bg-secondary text-white p-4">
    <?php
    echo
      "<p><strong>Nickname Artista:</strong>".  $info['nickname_artista']."</p>
      <p><strong>Bio Artista:</strong>". $info['bio_artista']."</p>
      <p><strong>Casa Discografica:</strong>". $info['casa_discografica']." </p>
      <p><strong>Genere:</strong>". $info['genere']." </p>
      <a href='home.php' class='btn btn-primary mt-3'>Torna alla Home</a>";
    ?>
    </div>
</div>
</body>
</html>