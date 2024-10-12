<?php
// Connessione al database
include '../connection.php';

$message = ''; // Variabile per memorizzare l'errore

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se l'utente esiste
    $query = "SELECT * FROM utenti WHERE username = '$username'";
    $result = pg_query($conn, $query);
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $id_user = $user['id'];
        // Login riuscito
        $message = "Login effettuato con successo!";
        header("Location: ../login.html?message=" . urlencode($message) . "&id=" . urlencode($id_user));
        exit();
    } else {
        // Login fallito
        $message = "Username o password errati. Riprova.";
        header("Location: ../login.html?message=" . urlencode($message));
        exit();
    }
}
?>
