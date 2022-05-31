<?php
require("db_config.php");
require("hash_password.php");
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_hashed = hash_password($password);
$sql_statement = "INSERT INTO usuarios(nombre, apellido, email, password, suscripcion_activa) VALUES ($1, $2, $3, $4, $5);";
$result = pg_query_params($db_conn, $sql_statement, array($nombre, $apellido, $email, $password_hashed, 0));
if ($result) {
 echo("¡Registro Exitoso!");
}
?>