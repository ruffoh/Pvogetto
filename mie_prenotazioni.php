<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connessione al DB
$conn = mysqli_connect('sql7.freesqldatabase.com', 'sql7779833', 'nWl1xCKsH7', 'sql7779833')
    or die("❌ Connessione fallita: " . mysqli_connect_error());

// Controllo cookie
<<<<<<< HEAD
$utente_loggato = isset($_COOKIE["utente_loggato"]) ? base64_decode($_COOKIE["utente_loggato"]) : null;

if (!$utente_loggato) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Accesso richiesto</title>
        <style>
            body {
                background: radial-gradient(circle at top, #0f2027, #203a43, #2c5364);
                color: white;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .login-alert {
                background: rgba(255, 255, 255, 0.05);
                padding: 30px 40px;
                border-radius: 12px;
                box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
                text-align: center;
                max-width: 500px;
                animation: fadeIn 1.5s ease-in-out;
            }

            .login-alert h1 {
                font-size: 2em;
                margin-bottom: 15px;
                color: #00ffe7;
            }

            .login-alert p {
                font-size: 1.2em;
                margin-bottom: 20px;
            }

            .login-alert a {
                color: #00ffe7;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 10px 20px;
                border-radius: 8px;
                text-decoration: none;
                transition: background 0.3s ease;
            }

            .login-alert a:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body>
        <div class="login-alert">
            <h1>🚀 Accesso richiesto!</h1>
            <p>Per vedere le tue prenotazioni devi prima autenticarti nel sistema galattico di Calcio Saponato.</p>
            <a href="login.php">✨ Vai al login</a>
        </div>
    </body>
    </html>
    HTML;
    exit;
}


// Prendi l’ID utente
$stmt = $conn->prepare("SELECT id_utente FROM utenti WHERE nome = ?");
$stmt->bind_param("s", $utente_loggato);
=======
$utente = $_COOKIE["utente_loggato"] ?? null;
if (!$utente) {
    die("❌ Devi effettuare il login per vedere le tue prenotazioni. <a href='login.php'>Accedi</a>");
}

// Prendi l’ID utente
$stmt = $conn->prepare("SELECT id_utente FROM utenti WHERE nome = ?");
$stmt->bind_param("s", $utente);
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
$stmt->execute();
$stmt->bind_result($id_utente);
$stmt->fetch();
$stmt->close();

if (!$id_utente) die("❌ Utente non trovato.");

// Query prenotazioni con JOIN
$sql = "
SELECT
    p.data_gioco,
    p.data_creazione,
    p.stato,
    c.nome AS nome_campo,
    f.orario_inizio,
    f.orario_fine
FROM prenotazioni p
JOIN campi c ON p.id_campo = c.id_campo
JOIN fasce_orarie f ON p.id_fascia = f.id_fascia
WHERE p.id_utente = ?
ORDER BY p.data_gioco DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_utente);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Le tue prenotazioni</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f0f0;
      padding: 40px;
      text-align: center;
    }

    h2 {
      color: #009879;
      margin-bottom: 20px;
    }

    table {
      width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    thead {
      background-color: #009879;
      color: white;
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
    }

    tbody tr:nth-child(even) {
      background-color: #f3f3f3;
    }

    tbody tr:hover {
      background-color: #e0f7f4;
    }

    .no-prenotazioni {
      color: #555;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<h2>Le tue prenotazioni</h2>

<?php
if ($result->num_rows === 0) {
    echo "<p class='no-prenotazioni'>⛔ Nessuna prenotazione trovata.</p>";
} else {
    echo "<table class='tabella-prenotazioni'>
        <thead>
            <tr>
                <th>Campo</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Stato</th>
                <th>Data creazione</th>
            </tr>
        </thead>
        <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . htmlspecialchars($row["nome_campo"]) . "</td>
            <td>" . $row["data_gioco"] . "</td>
            <td>" . substr($row["orario_inizio"], 0, 5) . " - " . substr($row["orario_fine"], 0, 5) . "</td>
            <td>" . $row["stato"] . "</td>
            <td>" . $row["data_creazione"] . "</td>
        </tr>";
    }
    echo "</tbody></table>";
}

$stmt->close();
$conn->close();
?>

</body>
</html>
