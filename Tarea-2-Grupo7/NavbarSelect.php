<?php
include 'db_config.php';

session_start();

if (isset($_SESSION["email"])){
    
    if($_SESSION["EsArtista"] == 1){
        
        include 'include/navbar_Logeado_Artista.html';
    } else {
        
        include 'include/navbar_Logeado.html';
    }
} else {
    
    include 'include/navbar.html'; 
}

?>
