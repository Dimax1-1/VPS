<?php
// Collegamento al database
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $polizza = $_POST['polizza'];
    $scadenza = $_POST['scadenza'];
    $premio = $_POST['premio'];

    // Inserimento nel database
    $query = "INSERT INTO clienti (nome, email, polizza, scadenza, premio, ID_Utente) 
              VALUES ('$nome', '$email', '$polizza', '$scadenza', '$premio', '1')";

    $result = pg_query($conn, $query);

    if ($result) {
        echo "Cliente inserito con successo!";
    } else {
        echo "Errore nell'inserimento del cliente.";
    }

    // Visualizzare tutti i clienti inseriti finora
    $query_select = "SELECT * FROM clienti";
    $result_select = pg_query($conn, $query_select);

    echo "<h2>Clienti Inseriti:</h2>";
    while ($row = pg_fetch_assoc($result_select)) {
        echo "Nome: " . $row['nome'] . ", Email: " . $row['email'] . ", Polizza: " . $row['polizza'] . "<br>";
    }
}
?>