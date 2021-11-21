<?php
require_once '../auth.php';
require_once '../Models/emprestimos.class.php';

if(isset($_GET['id'])){
	$idemprestimo = $_GET['id'];
	$emprestimos->DeleteEmprestimo($idemprestimo);

 } else {
	header('Location: ../../views/emprestimos/index.php');

}	