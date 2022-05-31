<?php
require("db_config.php");
require("hash_password.php");

$email = $_POST["email"];
$password = $_POST["password"];

// Obtenemos la contraseña hasheada del usuario de la BD.
$sql_statement = "SELECT password FROM artistas WHERE email = $1;";
$result = pg_query_params($db_conn, $sql_statement, array($email));

?>