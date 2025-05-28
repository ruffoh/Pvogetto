 <?php
$nome = htmlspecialchars($_POST["nome"] ?? '');
$email = htmlspecialchars($_POST["email"] ?? '');
$messaggio = htmlspecialchars($_POST["messaggio"] ?? '');
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Messaggio inviato</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #74ebd5, #ACB6E5);
      color: #333;
      padding: 80px 20px;
      text-align: center;
    }

    .box {
      background: #fff;
      padding: 40px;
      max-width: 600px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .checkmark {
      font-size: 80px;
      color: #2ecc71;
      margin-bottom: 20px;
    }

    .button {
      margin-top: 30px;
      padding: 10px 25px;
      background-color: #2ecc71;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      text-decoration: none;
    }

    .button:hover {
      background-color: #27ae60;
    }
  </style>
</head>
<body>
  <div class="box">
    <div class="checkmark">✅</div>
    <h1>Messaggio inviato!</h1>
    <p>Grazie <strong><?= $nome ?></strong> per averci contattato.<br>
       Ti risponderemo al più presto all'indirizzo <strong><?= $email ?></strong>.</p>

    <p><em>Messaggio ricevuto:</em><br><?= nl2br($messaggio) ?></p>

    <a href="index.php" class="button">🔙 Torna alla home</a>
  </div>
</body>
</html>
