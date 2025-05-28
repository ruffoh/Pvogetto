<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["InviaLogin"])) {
    ?>
    <!doctype html>
    <link rel="stylesheet" href="styles.css">

    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Login Calcio Saponato</title>
    </head>
    <body>
        <h2>Login Utente</h2>
        <form method="POST" action="">
            Nome: <input type="text" name="nome"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" name="InviaLogin" value="Accedi">
        </form>
    </body>
    </html>
    <?php exit;
}

$nome = trim($_POST["nome"] ?? '');
$pass = $_POST["password"] ?? '';
if ($nome === '' || $pass === '') die("Tutti i campi sono obbligatori!");
$hash = md5($pass);

$conn = mysqli_connect('sql7.freesqldatabase.com','sql7779833','nWl1xCKsH7','sql7779833')
    or die("Connessione fallita");

$stmt = $conn->prepare("SELECT password_hash FROM utenti WHERE nome = ?");
$stmt->bind_param("s", $nome);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) die("Utente non trovato!");
$stmt->bind_result($dbHash);
$stmt->fetch();
$stmt->close();

if ($hash === $dbHash) {
<<<<<<< HEAD
    $nome_codificato = base64_encode($nome);
    setcookie("utente_loggato", $nome_codificato, time() + 3600, "/");

=======
    setcookie("utente_loggato", $nome, time() + 3600, "/");
>>>>>>> 5589578da49fc5c8935f14a2bb78549836a0300e
    header("Location: index.php"); // redirect automatico
    exit;
} else {
    die("Password errata");
}
?>
