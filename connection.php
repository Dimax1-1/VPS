<?php
$dbhost = "151.80.149.206";
$dbport = "5432";
$dbname = "progetto";
$dbuser = "postgres";
$dbpass = "123456";

$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass");

if (!$conn) {
    die("Connessione al database fallita");
}
?>