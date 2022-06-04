<?php
session_start();
$Es_Artista = 0;

$email = $_SESSION["email"];

$sql_statement = "SELECT email FROM artistas WHERE email = $1;";
$result = pg_query_params($dbconn, $sql_statement, array($email));
$row = pg_fetch_row($result);
$Correo = $row[0];

if ($Correo == $email) {
    
    // esta en la tabla artistas
    $Es_Artista = 1;
} 
?>