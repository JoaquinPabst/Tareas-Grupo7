<?php
ini_set('display_errors', 1);
require("db_config.php");
require("hash_password.php");

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$password = $_POST["password"];
$Sub = 0;


#$password_hashed = hash_password($password);


$sql_statement = "INSERT INTO usuarios(nombre, apellido, email, password, suscripcion_activa) VALUES ($1, $2, $3, $4, $5);";
// $sql_statement = "INSERT INTO usuario(nombre) VALUES ($1);";
#$sql_statement = "SELECT * FROM usuario;";

echo("a");
// $result = pg_query_params($dbconn, $sql_statement, array($nombre));  
$result = pg_query_params($dbconn, $sql_statement, array($nombre, $apellido, $email, $password, $Sub));  
#$result = pg_query($dbconn, $sql_statement);  


echo("aaaaaaaaaaaa");


if ($result) {
 echo("¡Registro Exitoso!");
 
 
} else{
   echo("no funciona");
}

?>

