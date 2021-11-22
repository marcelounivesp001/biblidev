<?php 
// Inicia sessões, para assim poder destruílas
session_start();
session_destroy();	

header('Location: ../index.php');

?>