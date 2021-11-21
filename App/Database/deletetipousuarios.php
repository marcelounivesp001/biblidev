<?php
require_once '../auth.php';
require_once '../Models/tiposusuarios.class.php';

//if(isset($_POST['update']) == 'deleteuser'){
if(isset($_GET['id']) != NULL){
	//$iduseredit = $_POST['iduseredit'];
	$idtipo_Usuario = $_GET['id'];	
	$tiposUsuarios->DeleteTipoUsuarios($idtipo_Usuario);

 } else {

	header('Location: ../../views/usuarios/tiposusuario.php');

}	