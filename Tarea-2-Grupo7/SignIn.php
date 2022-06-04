<?php
require("db_config.php");
require("hash_password.php");


$email = $_POST["email"];
$password = $_POST["password"];


$sql_statement = "SELECT id, nombre, apellido, email, password, suscripcion_activa FROM usuarios WHERE email = $1;";
$result = pg_query_params($dbconn, $sql_statement, array($email));


if (!$result) {
    echo("No se pudo verificar la data");
    exit();
}

$row = pg_fetch_row($result);
$password_hashed = $row[4];
if (password_verify($password, $password_hashed)) {
    session_start();
    $_SESSION["id"] = $row[0];
    $_SESSION["email"] = $email;
    $_SESSION["nombre"] = $row[1];
    $_SESSION["apellido"] = $row[2];
    $_SESSION["suscripcion"] = $row[5];
    $_SESSION["EsArtista"] = 0;


    echo("¡Credenciales correctas!");
    header("Location:http://localhost/index.html");
 exit;
} else {
    $sql_statement = "SELECT id, nombre, apellido, email, password, nombre_artistico, verificado FROM artistas WHERE email = $1;";
    $result = pg_query_params($dbconn, $sql_statement, array($email));

    if (!$result) {
        echo("No se pudo verificar la data");
        exit();
    }
    $row = pg_fetch_row($result);
    $password_hashed = $row[4];
    if (password_verify($password, $password_hashed)) {
        session_start();
        $_SESSION["id"] = $row[0];
        $_SESSION["email"] = $email;
        $_SESSION["nombre"] = $row[1];
        $_SESSION["apellido"] = $row[2];
        $_SESSION["nombre_artistico"] = $row[5];
        $_SESSION["verificado"] = $row[6];
        $_SESSION["EsArtista"] = 1;
        
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