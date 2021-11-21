<?php
require_once '../auth.php';
require_once '../Models/emprestimos.class.php';

if(isset($_GET['idEntrega'])){	
	$idemprestimo = $_GET['idEntrega'];	
	var_dump($idemprestimo);
	$emprestimos->ConfirmarEntregaLivros($idemprestimo);

} else if(isset($_GET['idDevolucao'])){	
	$idemprestimo = $_GET['idDevolucao'];	
	$emprestimos->ConfirmarDevolucaoLivros($idemprestimo);

} else {	
	header('Location: ../../views/emprestimos/index.php');

}