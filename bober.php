<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calcio_saponato";

// Creazione connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Funzione per registrare un utente
function r...
