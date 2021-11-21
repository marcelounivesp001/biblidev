<?php

session_start();

if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['usuario'])) {
	header('Location: ../login.php');
} else {
	
	$idUsuario = $_SESSION['idUsuario'];
	$usuario = $_SESSION['usuario'];
	$tipoUsuario = $_SESSION['idtipoUsuario'];
	$nomeUsuario = $_SESSION['nomeUsuario'];

};