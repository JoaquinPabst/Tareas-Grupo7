<?php
ini_set('display_errors', 1);
require("db_config.php");
require("hash_password.php");

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$password = $_POST["password"];
$nombre_artistico = $_POST["nombre_artistico"];
$Veri = 1;


$password_hashed = hash_password($password);


$sql_statement = "INSERT INTO artistas(nombre, apellido, email, password, nombre_artistico, verificado) VALUES ($1, $2, $3, $4, $5, $6);";
// $sql_statement = "INSERT INTO usuario(nombre) VALUES ($1);";
#$sql_statement = "SELECT * FROM usuario;";


// $result = pg_query_params($dbconn, $sql_statement, array($nombre));  
$result = pg_query_params($dbconn, $sql_statement, array($nombre, $apellido, $email, $password_hashed, $nombre_artistico, $Veri));  
#$result = pg_query($dbconn, $sql_statement);  




if ($result) {
 echo("¡Registro Exitoso!");
 header("http://localhost/html/SignIn.html");
 exit;
 
 
} else{
   echo("Error al registrar");
}

?>