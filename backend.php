<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connessione DB
$conn = mysqli_connect('sql7.freesqldatabase.com', 'sql7779833', 'nWl1xCKsH7', 'sql7779833')
    or die("❌ Connessione fallita: " . mysqli_connect_error());

// Controlla se l’utente è loggato
<<<<<<< HEAD
$utente_loggato = isset($_COOKIE["utente_loggato"]) ? base64_decode($_COOKIE["utente_loggato"]) : null;

if (!$utente_loggato) {
=======
$utente_nome = $_COOKIE["utente_loggato"] ?? null;
if (!$utente_nome) {
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
    die("❌ Accesso non autorizzato. Effettua il login.");
}

// Verifica che l'action sia corretta
if ($_POST["action"] !== "book") {
    die("❌ Azione non valida.");
}

// Dati ricevuti dal form
$id_campo = $_POST["campo"] ?? null;
$id_fascia = $_POST["fascia"] ?? null;
$data_gioco = $_POST["data_gioco"] ?? null;

if (!$id_campo || !$id_fascia || !$data_gioco) {
    die("❌ Tutti i campi sono obbligatori.");
}

// Recupera l'ID utente dal nome
$stmt = $conn->prepare("SELECT id_utente FROM utenti WHERE nome = ?");
<<<<<<< HEAD
$stmt->bind_param("s", $utente_loggato);
=======
$stmt->bind_param("s", $utente_nome);
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
$stmt->execute();
$stmt->bind_result($id_utente);
$stmt->fetch();
$stmt->close();

if (!$id_utente) {
    die("❌ Utente non trovato.");
}

// Inserisce la prenotazione
$stmt = $conn->prepare("INSERT INTO prenotazioni (id_utente, id_campo, id_fascia, data_gioco) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $id_utente, $id_campo, $id_fascia, $data_gioco);

if ($stmt->execute()) {
<<<<<<< HEAD
    if ($stmt->execute()) {
    ?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
      <meta charset="UTF-8">
      <title>Prenotazione Confermata</title>
      <style>
        body {
          background: linear-gradient(135deg, #38ef7d, #11998e);
          font-family: 'Segoe UI', Tahoma, sans-serif;
          color: white;
          text-align: center;
          padding: 100px 20px;
        }

        .checkmark {
          font-size: 100px;
          color: #fff;
          animation: pop 0.4s ease;
        }

        h1 {
          font-size: 2.5em;
          margin-top: 20px;
        }

        p {
          font-size: 1.2em;
          margin: 20px 0;
        }

        .button {
          padding: 12px 25px;
          font-size: 1em;
          background-color: #ffffff;
          color: #11998e;
          border: none;
          border-radius: 8px;
          cursor: pointer;
          text-decoration: none;
          transition: background 0.3s;
        }

        .button:hover {
          background-color: #f0f0f0;
        }

        @keyframes pop {
          0% { transform: scale(0.3); opacity: 0; }
          100% { transform: scale(1); opacity: 1; }
        }
      </style>
    </head>
    <body>
      <div class="checkmark">✅</div>
      <h1>Prenotazione effettuata!</h1>
      <p>Hai riservato il campo con successo. Preparati a scivolare e divertirti 😎</p>
      <a href="mie_prenotazioni.php" class="button">📅 Vedi le mie prenotazioni</a>
      <br><br>
      <a href="index.php" class="button">🏠 Torna alla home</a>
    </body>
    </html>
    <?php
} else {
    echo "❌ Errore nella prenotazione: " . htmlspecialchars($stmt->error);
}

=======
    echo "✅ Prenotazione registrata con successo!<br>";
    echo "<a href='index.php'>Torna alla home</a>";
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
} else {
    echo "❌ Errore nella prenotazione: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
