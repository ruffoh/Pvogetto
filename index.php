<?php
<<<<<<< HEAD
$utente_loggato = isset($_COOKIE["utente_loggato"]) ? base64_decode($_COOKIE["utente_loggato"]) : null;

=======
$utente_loggato = $_COOKIE["utente_loggato"] ?? null;
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
// Connessione al database
$conn = mysqli_connect('sql7.freesqldatabase.com', 'sql7779833', 'nWl1xCKsH7', 'sql7779833')
    or die("Errore di connessione DB: " . mysqli_connect_error());

// Carica i campi
$campi = [];
$res = mysqli_query($conn, "SELECT id_campo, nome FROM campi WHERE attivo = 1");
while ($row = mysqli_fetch_assoc($res)) {
    $campi[] = $row;
}

// Carica le fasce orarie
$fasce = [];
$res = mysqli_query($conn, "SELECT id_fascia, id_campo, orario_inizio, orario_fine FROM fasce_orarie");
while ($row = mysqli_fetch_assoc($res)) {
    $fasce[] = $row;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Calcio Saponato</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    function showTab(id) {
      document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
      document.getElementById(id).classList.add('active');
      document.querySelectorAll('.tab-button').forEach(b => b.classList.remove('active'));
      document.querySelector(`[data-tab="${id}"]`).classList.add('active');
    }
    window.onload = () => showTab('home');
    function showAuthForm(which) {
      document.getElementById('form-register').style.display = which === 'register' ? 'block' : 'none';
      document.getElementById('form-login').style.display = which === 'login' ? 'block' : 'none';
    }
    function filterFasce(campoId) {
      const options = document.querySelectorAll('#fascia-select option[data-campo]');
      options.forEach(opt => {
        opt.style.display = (campoId && opt.getAttribute('data-campo') === campoId) ? '' : 'none';
      });
      document.getElementById('fascia-select').value = '';
    }
  </script>
</head>
<body>
  <header>
    <h1>Calcio Saponato</h1>
    <?php if ($utente_loggato): ?>
      <p style="color:white; font-size: 0.9em;">👋 Benvenuto, <?= htmlspecialchars($utente_loggato) ?>!</p>
    <?php endif; ?>
  </header>

<<<<<<< HEAD
<div class="tabs">
=======
  <div class="tabs">
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
    <button class="tab-button" data-tab="home" onclick="showTab('home')">Home</button>
    <button class="tab-button" data-tab="prenota" onclick="showTab('prenota')">Prenota</button>
    <button class="tab-button" data-tab="eventi" onclick="showTab('eventi')">Eventi</button>
    <button class="tab-button" data-tab="chi-siamo" onclick="showTab('chi-siamo')">Chi Siamo</button>
    <button class="tab-button" data-tab="contatti" onclick="showTab('contatti')">Contatti</button>
    <button class="tab-button" data-tab="auth" onclick="showTab('auth')"><?= $utente_loggato ? "Logout" : "Login" ?></button>
<<<<<<< HEAD
    <a href="mie_prenotazioni.php" class="button-link">
        <button class="tab-button">I miei campi prenotati</button>
    </a>
</div>


  <main class="container">
    <!-- HOME -->
<section id="home" class="tab-content">
  <h2>Benvenuti su Calcio Saponato!</h2>
  <p>Divertiti con partite scivolose e uniche sul nostro campo saponato. Preparati a un'esperienza indimenticabile!</p>
  
  <div class="image-gallery">
    <div class="image-carousel">
      <img src="img/calcio1.jpg" alt="Partita su campo saponato">
      <img src="img/calcio2.jpg" alt="Giocatori in azione">
      <img src="img/calcio3.jpg" alt="Vittoria scivolosa">
    </div>
  </div>

  <div class="info-cards">
    <div class="info-card">
      <h3>Le Regole del Gioco</h3>
      <p>Scopri le regole divertenti e uniche del nostro campo saponato.</p>
    </div>
    <div class="info-card">
      <h3>Eventi Speciali</h3>
      <p>Partecipa a tornei e eventi esclusivi per i nostri giocatori.</p>
    </div>
    <div class="info-card">
      <h3>Perché il Calcio Saponato?</h3>
      <p>Un gioco che unisce divertimento e competizione in un'unica esperienza indimenticabile.</p>
    </div>
  </div>
</section>


    
=======
    <a href="mie_prenotazioni.php"><button>I miei campi prenotati</button></a>
  </div>

  <main class="container">
    <!-- HOME -->
    <section id="home" class="tab-content">
      <h2>Benvenuti su Calcio Saponato!</h2>
      <p>Divertiti con partite scivolose e uniche sul nostro campo saponato.</p>
      <div class="image-gallery">
        <img src="img/calcio1.jpg" alt="Partita su campo saponato">
        <img src="img/calcio2.jpg" alt="Giocatori in azione">
        <img src="img/calcio3.jpg" alt="Vittoria scivolosa">
      </div>
    </section>

>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
    <!-- PRENOTA -->
    <section id="prenota" class="tab-content">
      <h2>Prenota la tua partita</h2>
      <?php if (!$utente_loggato): ?>
        <p>Devi <a href="#" onclick="showTab('auth')">effettuare il login</a> per prenotare.</p>
      <?php else: ?>
        <form method="POST" action="backend.php">
          <input type="hidden" name="action" value="book">
          <label class="box">Campo:
            <select name="campo" required onchange="filterFasce(this.value)">
              <option value="">-- Seleziona --</option>
              <?php foreach($campi as $c): ?>
                <option value="<?= $c['id_campo'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <label class="box">Fascia oraria:
            <select name="fascia" id="fascia-select" required>
              <option value="">-- Prima seleziona il campo --</option>
              <?php foreach($fasce as $f): ?>
                <option data-campo="<?= $f['id_campo'] ?>" value="<?= $f['id_fascia'] ?>" style="display:none;">
                  <?= substr($f['orario_inizio'], 0, 5) ?> – <?= substr($f['orario_fine'], 0, 5) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </label>
          <label class="box">Data:
            <input type="date" name="data_gioco" required>
          </label>
          <button type="submit">Prenota ora</button>
        </form>
      <?php endif; ?>
    </section>

    <!-- EVENTI -->
    <section id="eventi" class="tab-content">
      <h2>Eventi e Partite in Arrivo</h2>
      <p>Partecipa ai nostri tornei, campionati e eventi speciali!</p>
      <div class="events-grid">
        <article class="event-card">
          <img src="img/evento-torneo.png" alt="Torneo Amatoriale" class="event-image">
          <div class="event-info">
            <h3>Torneo Amatoriale</h3>
            <time datetime="2025-06-20">20 Giugno 2025</time>
            <p>Registra la tua squadra e partecipa al torneo più divertente dell'estate!</p>
          </div>
        </article>
      </div>
    </section>

<<<<<<< HEAD
<!-- CHI SIAMO -->
<section id="chi-siamo" class="tab-content">
  <h2>Chi Siamo</h2>
  <p>Siamo un team di appassionati di sport e divertimento, con anni di esperienza nell'organizzazione di eventi all'aperto. Il nostro obiettivo è offrire un'esperienza unica, sicura e divertente sul campo saponato, in un ambiente professionale e accogliente.</p>
  
  <!-- Team -->
  <div class="team">
    <div class="team-member">
      <img src="img/membro-3.png" alt="Foto di Mario Rossi" class="team-photo">
      <h3>Marco Nadalon</h3>
      <p class="role">Fondatore</p>
      <p>Marco è il fondatore del progetto e un grande appassionato di sport. Con la sua visione, ha creato un ambiente unico per il divertimento e la competizione.</p>
    </div>
    <div class="team-member">
      <img src="img/membro-3.png" alt="Foto di Anna Bianchi" class="team-photo">
      <h3>Giacomo Ruffoni</h3>
      <p class="role">Coordinatrice Eventi</p>
      <p>Giacomo si occupa di organizzare e coordinare tutti gli eventi, assicurandosi che ogni dettaglio sia perfetto per i partecipanti.</p>
    </div>
    <div class="team-member">
      <img src="img/ologu1.jpeg" alt="Foto di Luca Verdi" class="team-photo">
      <h3>Cristian Ologu</h3>
      <p class="role">Stagista</p>
      <p>Cristian garantisce che tutte le attività si svolgano in totale sicurezza, offrendo un'esperienza senza preoccupazioni per tutti e pulendo il pavimento alla fine di ogni partita.</p>
    </div>
  </div>
</section>

<!-- CONTATTI -->
<section id="contatti" class="tab-content">
  <h2>Contattaci</h2>
  <p>Per informazioni, richieste o assistenza, non esitare a contattarci:</p>
  
  <div class="contact-methods">
    <ul>
      <li>
        <i class="fas fa-envelope"></i> 
        Email: <a href="mailto:info@calciosaponato.it">info@calciosaponato.it</a>
      </li>
      <li>
        <i class="fas fa-phone-alt"></i> 
        Telefono: <a href="tel:+390123456789">+39 012 345 6789</a>
      </li>
      <li>
        <i class="fas fa-map-marker-alt"></i> 
        Indirizzo: Via Sportiva, 10, 00100 Roma
      </li>
    </ul>
  </div>

  <div class="contact-form">
    <h3>Invia un messaggio</h3>
    <form action="contatti_successo.php" method="post">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="messaggio">Messaggio:</label>
      <textarea id="messaggio" name="messaggio" rows="4" required></textarea>

      <button type="submit">Invia</button>
    </form>
  </div>
</section>
=======
    <!-- CHI SIAMO -->
    <section id="chi-siamo" class="tab-content">
      <h2>Chi Siamo</h2>
      <p>Siamo un team di appassionati di sport e divertimento, con anni di esperienza nell'organizzazione di eventi all'aperto. Il nostro obiettivo è offrire un'esperienza unica, sicura e divertente sul campo saponato, in un ambiente professionale e accogliente.</p>
    </section>

    <!-- CONTATTI -->
    <section id="contatti" class="tab-content">
      <h2>Contattaci</h2>
      <p>Per informazioni, richieste o assistenza, contattaci:</p>
      <ul>
        <li>Email: <a href="mailto:info@calciosaponato.it">info@calciosaponato.it</a></li>
        <li>Telefono: <a href="tel:+390123456789">+39 012 345 6789</a></li>
        <li>Indirizzo: Via Sportiva, 10, 00100 Roma</li>
      </ul>
    </section>
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e

    <!-- LOGIN / LOGOUT -->
    <section id="auth" class="tab-content">
      <?php if ($utente_loggato): ?>
        <p>Sei attualmente loggato come <strong><?= htmlspecialchars($utente_loggato) ?></strong>.</p>
        <p><a href="logout.php"><button>Logout</button></a></p>
      <?php else: ?>
        <div class="auth-buttons">
          <a href="register.php" class="auth-link"><button type="button">Registrati</button></a>
          <a href="login.php" class="auth-link"><button type="button">Accedi</button></a>
        </div>
        <p>Scegli se vuoi registrarti o accedere.</p>
      <?php endif; ?>
    </section>
  </main>

<<<<<<< HEAD
  <footer class=foota>
    <p>&copy; 2025 Nadaloner&Ruffo&OloguG. Tutti i diritti riservati.</p>
=======
  <footer>
    <p>&copy; 2025 Nadaloner&Ruffoh. Tutti i diritti riservati.</p>
    <p style="font-size:7px;">Ologu</p>
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
  </footer>
</body>
</html>
