<?php
require_once '../auth.php';
require_once '../Models/emprestimos.class.php';

if(isset($_GET['id'])){
	$idLivroEmprestimo = $_GET['id'];
	$idEmprestimo = $_GET['idemprestimo'];
	$emprestimos->DeleteLivroEmprestimo($idEmprestimo, $idLivroEmprestimo);

 } else {
	header('Location: ../../views/emprestimos/index.php');

}	