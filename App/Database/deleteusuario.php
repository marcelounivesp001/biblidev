<?php
require_once '../auth.php';
require_once '../Models/usuarios.class.php';

if(isset($_GET['id']) != NULL){
	$iduseredit = $_GET['id'];	
	$usuarios->DeleteUsuario($iduseredit);

 } else {
	header('Location: ../../views/usuarios/index.php');

}	