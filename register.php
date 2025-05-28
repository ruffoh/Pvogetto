<?php
// Mostra errori a schermo per debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// register.php – Registrazione utente con hash MD5 e prepared statements

if (!isset($_POST["InviaRegistrazione"])) {
    // Mostro form di registrazione
    ?>
    <!doctype html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Registrazione Calcio Saponato</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Registrazione Utente</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Nome: <input type="text" name="nome"><br>
            Email: <input type="email" name="email"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" name="InviaRegistrazione" value="Registrati">
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Se arrivo qui, c'è POST: processo registrazione
$nome  = trim($_POST["nome"]    ?? '');
$email = trim($_POST["email"]   ?? '');
$pass  = $_POST["password"]     ?? '';

if ($nome === '' || $email === '' || $pass === '') {
    die("Tutti i campi sono obbligatori!");
}

// Hash MD5
$hash = md5($pass);

// Connessione DB
$conn = mysqli_connect(
    'sql7.freesqldatabase.com',
    'sql7779833',
    'nWl1xCKsH7',
    'sql7779833'
) or die("Connessione fallita: " . mysqli_connect_error());

// Controllo esistenza utente con stesso nome o email
$stmt = $conn->prepare("SELECT id_utente FROM utenti WHERE nome = ? OR email = ?");
$stmt->bind_param("ss", $nome, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    die("Nome o email già utilizzati!");
}
$stmt->close();

// Inserisco nuovo utente
$stmt = $conn->prepare("INSERT INTO utenti (nome, email, password_hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $hash);

if ($stmt->execute()) {
<<<<<<< HEAD
    echo "<!doctype html>
    <html lang=\"it\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Registrazione completata</title>
        <meta http-equiv=\"refresh\" content=\"4;url=login.php\">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                text-align: center;
                padding-top: 50px;
            }
            .msg {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                display: inline-block;
                padding: 20px;
                border-radius: 8px;
            }
        </style>
    </head>
    <body>
        <div class=\"msg\">
            ✅ Registrazione avvenuta con successo!<br>
            Verrai reindirizzato al login tra qualche secondo...
        </div>
    </body>
    </html>";
=======
    echo "✅ Registrazione avvenuta con successo!<br>";
    echo "<a href=\"login.php\">Vai al login</a>";
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
} else {
    die("Errore inserimento: " . htmlspecialchars($stmt->error));
}

<<<<<<< HEAD

=======
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
$stmt->close();
$conn->close();
?>
