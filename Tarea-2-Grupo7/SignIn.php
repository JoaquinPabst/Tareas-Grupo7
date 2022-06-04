<?php
require("db_config.php");
require("hash_password.php");


$email = $_POST["email"];
$password = $_POST["password"];


$sql_statement = "SELECT password FROM usuarios WHERE email = $1;";
$result = pg_query_params($dbconn, $sql_statement, array($email));

if (!$result) {
    echo("No se pudo verificar la data");
    exit();
}

$row = pg_fetch_row($result);
$password_hashed = $row[0];
if (password_verify($password, $password_hashed)) {
    session_start();
    $_SESSION["email"] = $email;


    echo("¡Credenciales correctas!");
    header("Location:http://localhost/index.html");
 exit;
} else {
    $sql_statement = "SELECT password FROM artistas WHERE email = $1;";
    $result = pg_query_params($dbconn, $sql_statement, array($email));

    if (!$result) {
        echo("No se pudo verificar la data");
        exit();
    }
    $row = pg_fetch_row($result);
    $password_hashed = $row[0];
    if (password_verify($password, $password_hashed)) {
        session_start();
        $_SESSION["email"] = $email;
        
        $Es_Artista = 1;
        echo("¡Credenciales correctas!");
        header("Location:http://localhost/index.html");
     exit;
    } else{
        header("Location:http://localhost/html/SignIn.html");
        exit("¡Credenciales incorrectas!");

    }
    
}


?>