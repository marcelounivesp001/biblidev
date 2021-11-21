<?php
require_once '../auth.php';
require_once '../Models/categoriaslivros.class.php';

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

if ($PostFilters['identCall'] == 'InsertCategoriaLivros'){

	$iduser = $PostFilters['iduser'];
	$categoria_livros = $PostFilters['categoria'];

	$messageCheck = $categoriaslivros->CreateEditCategoriaLivrosChecks($categoria_livros, "");

	if ($messageCheck['CATEGORIA'] == 'X'){
		$message = [
		 	    'value' => "",
		 	    'titulo' => "",
			    'message'=> "Já existe Categoria Livros ".$PostFilters['categoria']." cadastrada.",
			    'status' => "error",
			    'redirect' => ""
			   ];				
	} else {

	$categorialivros = array( 
							"categoria"=> $categoria_livros
							);

	$resp_json = $categoriaslivros->InsertCategoriaLivros($categorialivros);
	$message = json_decode($resp_json, true);

	}

	echo json_encode($message);		

 } else if ($PostFilters['identCall'] == 'UpdateCategoriaLivros'){

 	$iduser = $PostFilters['iduser'];
 	$idcategoria = $PostFilters['idcategoria'];
 	$categoria = $PostFilters['categoria'];
 	$ativo = $PostFilters['ativo'];

	$messageCheck = $categoriaslivros->CreateEditCategoriaLivrosChecks($categoria, $idcategoria);

	if ($messageCheck['CATEGORIA'] == 'X'){
		$message = [
		 	    'value' => "",
		 	    'titulo' => "",
			    'message'=> "Já existe Categoria Livros ".$PostFilters['categoria']." cadastrada.",
			    'status' => "error",
			    'redirect' => ""
			   ];				
	} else {

	$categorialivros = array( "idcategoria"=> $idcategoria, 
							  "categoria"=> $categoria, 
							  "ativo"=> $ativo
							);

	
	$resp_json = $categoriaslivros->UpdateCategoriaLivros($categorialivros);
	$message = json_decode($resp_json, true);

	}

	echo json_encode($message);

}