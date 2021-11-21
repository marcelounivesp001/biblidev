<?php
require_once '../auth.php';
require_once '../Models/livros.class.php';

if(isset($_GET['id']) != NULL){
	$idlivro = $_GET['id'];
	$livros->DeleteLivro($idlivro);

 } else {
	header('Location: ../../views/livros/index.php');

}		