<?php
// Collegamento al database
include '../connection.php';

// Avvia la sessione per ottenere l'ID dell'utente connesso
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $polizza = $_POST['polizza'];
    $scadenza = $_POST['scadenza'];
    $premio = $_POST['premio'];
    $fattura = $_POST['fattura'] ?? '';
    $frazionamento = $_POST['frazionamento'];
    $indicizzato = $_POST['indicizzato'] === 'true' ? 'true' : 'false';
    $agenzia = $_POST['agenzia'];

    // Recupera l'ID dell'utente dalla sessione
    $ID_Utente = $_SESSION['ID_Utente'];

    // Inserimento nel database
    $query = "INSERT INTO clienti (nome, indirizzo_email, numero_polizza, scadenza, premio, fattura, frazionamento, indicizzato, agenzia, ID_Utente) 
              VALUES ('$nome', '$email', '$polizza', '$scadenza', '$premio', '$fattura', '$frazionamento', '$indicizzato', '$agenzia', '$ID_Utente')";

    $result = pg_query($conn, $query);

    if ($result) {
        echo "Cliente inserito con successo!";
    } else {
        echo "Errore nell'inserimento del cliente.";
    }

    // Visualizzare tutti i clienti inseriti finora dall'utente corrente
    $query_select = "SELECT * FROM clienti WHERE ID_Utente = '$ID_Utente'";
    $result_select = pg_query($conn, $query_select);

    echo "<h2>Clienti Inseriti:</h2>";
    while ($row = pg_fetch_assoc($result_select)) {
        echo "Nome: " . $row['nome'] . ", Email: " . $row['indirizzo_email'] . ", Polizza: " . $row['numero_polizza'] . "<br>";
    }
}
?>
