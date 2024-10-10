<?php
// Connessione al database
include 'connaction.php';

$message = ''; // Variabile per memorizzare l'errore

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se l'utente esiste
    $query = "SELECT * FROM utenti WHERE email = '$username'";
    $result = pg_query($conn, $query);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Login riuscito
        $message = "Login effettuato con successo!";
    } else {
        // Login fallito
        $message = "Username o password errati. Riprova.";
    }
    header("Location: ../login.html?message=" . urlencode($message));
    exit();
}
?>
