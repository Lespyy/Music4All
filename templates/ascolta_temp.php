<br><br><br><br><br><br><br><br><br><br>
  <div class="container text-center">
    <h2 class="mb-4">Brano attuale: <span id="currentTitle" class="text-info">Nessun brano</span></h2>

    <audio id="player" controls class="w-100 mb-4"></audio>

    <div class="d-flex justify-content-center gap-3">
      <button onclick="prev()" class="btn btn-outline-light">⏮ Indietro</button>
      <button id="stopBtn" onclick="stop()" class="btn btn-warning">⏹ Stop</button>
      <button id="playBtn" onclick="play()" class="btn btn-success" style="display: none;">▶️ Play</button>
      <button onclick="next()" class="btn btn-outline-light">⏭ Avanti</button>

       <!-- Valutazioni !-->
      <form action="./templates/valuta.php" method="POST" class="my-4">
        <input type="hidden" name="id_utente" value="<?php echo $_SESSION['utente']['id']; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">
        <input type="hidden" id="id_canzone" name="id_canzone" value=""> <!-- Si andrà a modificare con la funzione "updateSongIdInform" !-->
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Per tornare al punto di prima della canzone che stavo ascoltando dopo il reindirizzamento da valuta.php !-->
        <input type="hidden" id="current_index" name="current_index" value=""> <!-- Stessa cosa !-->

        <label for="valutazione" class="form-label">Valuta la canzone (1-5):</label>
        <select name="valutazione" id="valutazione" class="form-select w-auto mx-auto">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Invia Valutazione</button>
      </form>
    </div>
  </div>
  <script>
  const isFreeUser = <?php echo $is_free; ?>;
  // non posso associare un oggetto php a un oggetto js allora lo rendo json
  let songs = <?php echo json_encode($songs); ?>;
  let adAudio = new Audio("audio/advertising.mp3");
  let adInterval;
  let elapsedSeconds = 0;
  let audio = null;
  let current = 0; //Posizione della canzone nell'array di playlist/album
  let audio_stopped = 0;

  <?php if (isset($_GET['index'])): ?> //Usato per tornare da valutazioni
    current = <?php echo (int) $_GET['index']; ?>;
  <?php endif; ?>

  console.log(isFreeUser);

  // Aggiorna dinamicamente l'id della canzone corrente nel form (Per valutazioni)
  function updateSongIdInForm(index) {
    const songId = songs[index].id;
    document.getElementById("id_canzone").value = songId;
    document.getElementById("current_index").value = index;
  }

  //Per pubblicità
  function startAdTimer() {
    if (!isFreeUser) return;
    elapsedSeconds = 0;

    if (adInterval) clearInterval(adInterval);
    
    adInterval = setInterval(() => {
      elapsedSeconds++;
      console.log("Secondi trascorsi:", elapsedSeconds);

      // Ogni 120 secondi (2 minuti)
      if (elapsedSeconds >= 60) {
        elapsedSeconds = 0; //Resetta il contatore

        if (!audio || audio.paused) return;

        console.log("Avvio pubblicità...");
        audio.pause();
        audio_stopped = audio.currentTime;

        adAudio.play();
        adAudio.onended = () => {
          audio.currentTime = audio_stopped;
          audio.play();
        };
      }
    }, 1000); // Ogni secondo aggiorna il contatore
  }

  function stopAdTimer() {
    if (adInterval) clearInterval(adInterval);
  }

function loadSong(index) {
  audio = document.getElementById("player");
  const songId = songs[index].id;
  const src = "audio/" + songId + ".mp3";
  document.getElementById("currentTitle").innerText = songs[index].titolo;
  
  // Registra l'ascolto nel database 
  registerListen(songId);
  
  audio.src = src;
  audio.play();
  toggleButtons(true);
  stopAdTimer();
  startAdTimer();// parte il timer (non si azzera ad ogni secondo!)
  updateSongIdInForm(index);// Aggiorna l'id canzone per il form
}

function registerListen(songId) {
  fetch("./php/registra_ascolti.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "song_id=" + encodeURIComponent(songId)
  })
  .then(res => res.text())  // usa .text() per vedere la risposta grezza
  .then(data => console.log("Risposta dal server:", data))
  .catch(error => console.error("Errore fetch:", error));
}


  function toggleButtons(isPlaying) {
    const playBtn = document.getElementById("playBtn");
    const stopBtn = document.getElementById("stopBtn");
    playBtn.style.display = isPlaying ? "none" : "inline-block";
    stopBtn.style.display = isPlaying ? "inline-block" : "none";
  }

  function next() {
    current = (current + 1) % songs.length;
    loadSong(current);
  }

  function prev() {
    current = (current - 1 + songs.length) % songs.length;
    loadSong(current);
  }

  function stop() {
    audio.pause();
    audio_stopped = audio.currentTime;
    toggleButtons(false);
  }

  function play() {
    audio.currentTime = audio_stopped || 0;
    audio.play();
    toggleButtons(true);
  }

  window.onload = function () {
    if (songs.length > 0) {
      loadSong(current);
    }
  };
</script>

</body>
</html>