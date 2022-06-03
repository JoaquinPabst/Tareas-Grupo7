<?php
session_start();
if (!isset($_SESSION["email"])) {
 header("Location: http://localhost/index.html");
 exit("Debe Iniciar Sesión");
}
?>
