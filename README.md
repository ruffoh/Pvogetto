# Sito “Calcio Saponato” – Descrizione del Progetto

---

## 🌐 URL del Sito
- **Sito Web:** [https://golbagnati.w3spaces.com/](https://golbagnati.w3spaces.com/)  
- **Database Remoto:** FreeSQLDatabase (`sql7.freesqldatabase.com`)

---

## 📂 Struttura del Progetto
- **index.php**  
  Pagina principale, suddivisa in sezioni “Home”, “Eventi”, “Contatti” e “Prenotazioni”.
- **backend.php**  
  Logica di gestione delle prenotazioni; accessibile solo agli utenti autenticati.
- **register.php**  
  Form per la registrazione di nuovi utenti.
- **login.php**  
  Form per il login degli utenti esistenti.
- **logout.php**  
  Script per terminare la sessione utente.
- **config.php**  
  Parametri di connessione al database remoto.
- **styles.css**  
  Foglio di stile responsivo per l’interfaccia utente.

---

## 📊 Configurazione del Database
```php
// config.php
<?php
$host = 'sql7.freesqldatabase.com';
$db   = 'sql7779833';
$user = 'TUO_USERNAME';
$pass = 'TUA_PASSWORD';
$port = 3306;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $user, $pass, $options);
?>
```
La connessione è gestita tramite PDO con prepared statements per garantire sicurezza e prevenire SQL Injection.

## 🚀 Funzionalità Implementate

- **Registrazione e Login**
  - `register.php`: creazione dell’account utente tramite form.
  - `login.php` / `logout.php`: autenticazione e gestione della sessione.

- **Prenotazione del Campo**
  - Accessibile solo agli utenti autenticati.
  - Selezione dinamica di campo e fascia oraria (filtraggio basato sul campo scelto).
  - Salvataggio della prenotazione nel database tramite `backend.php`.

- **Visualizzazione Eventi**
  - Elenco degli eventi sportivi nella sezione “Eventi”.
  - Possibilità di prenotare direttamente da ogni evento (richiede login).

- **Sicurezza e Best Practice**
  - Utilizzo di **PDO** con *prepared statements* per tutte le query.
  - Validazione lato server dei dati in ingresso.
  - Gestione sicura delle sessioni PHP.

---

## ⚙️ Miglioramenti Futuri

- **AJAX per le prenotazioni**  
  Aggiornamento in tempo reale delle fasce orarie senza ricaricare la pagina.

- **Notifiche Email**  
  Invio automatico di una email di conferma con riepilogo della prenotazione.

- **Dashboard Utente**  
  Area personale per visualizzare, modificare o cancellare le proprie prenotazioni.
