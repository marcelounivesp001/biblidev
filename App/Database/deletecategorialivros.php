<?php
require_once '../auth.php';
require_once '../Models/categoriaslivros.class.php';

if(isset($_GET['id']) != NULL){
	$idcategorialivro = $_GET['id'];	
	$categoriaslivros->DeleteCategoriaLivros($idcategorialivro);

 } else {
	header('Location: ../../views/livros/categoriaslivros.php');

}	