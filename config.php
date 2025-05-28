<?php
// config.php – Connessione al database remoto
$servername = "sql7.freesqldatabase.com";
$username = "sql7779833";
$password = "nWl1xCKsH7";
$dbname = "sql7779833";
$port = 3306;

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>
