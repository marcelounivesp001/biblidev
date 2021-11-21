<?php 

require_once 'App/auth.php';

if ($usuario && $tipoUsuario) {
	header('Location: views/');
} else {
	header('Location: login.php');
};

?>