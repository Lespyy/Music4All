<div class="container my-5">
    <h1 class="text-center mb-4">Homepage</h1>

    <!-- Barra di ricerca -->
    <div class="row justify-content-center mb-5">
      <div class="col-md-6">
        <form method="GET" action="./php/cerca.php">
          <div class="input-group">
            <input type="text" name="titolo" id="titolo" class="form-control text-center" placeholder="Cerca album">
            <button class="btn btn-primary" type="submit">Cerca</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Card album -->
    <?php
$cambio_riga = 0;

foreach($rows as $row){
  // Apri riga ogni 3 card
  if ($cambio_riga % 3 == 0) {
    echo '<div class="row g-4 mb-5">';
  }

  echo '<div class="col-md-4">
    <div class="card bg-secondary text-white h-100">
      <img src="' . $row['path_img'] . '" class="card-img-top" alt="' . $row['titolo'] . '">
      <div class="card-body d-flex flex-column align-items-center">
        <h5 class="card-title text-center">' . $row["titolo"] . ' ' . $row["annoP"] . '</h5>
        <a href="ascolta.php?type=album&amp;id=' . $row['id'] . '" class="btn btn-primary mt-3">Ascolta</a>
        <a href="dettagli_album.php?id=' . $row['id'] . '" class="btn btn-info mt-2">Dettagli</a>
      </div>
    </div>
  </div>';


  $cambio_riga++;

  // Chiudi riga ogni 3 card o all'ultimo elemento
  if ($cambio_riga % 3 == 0) {
    echo '</div>';
  }
}
?>
  </div>
</body>