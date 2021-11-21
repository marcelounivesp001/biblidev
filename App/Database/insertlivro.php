<?php
require_once '../auth.php';
require_once '../Models/livros.class.php';

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

if ($PostFilters['identCall'] == 'insertLivro'){

	$messageCheck = $livros->CreateEditLivroChecks($PostFilters['isbn']);
	if ($messageCheck['ISBN'] == 'X') {
		$message = [
		 	    'value' => '',
		 	    'titulo' => '',
			    'message'=> 'Já existe Livro cadastrado com ISBN informado.',
			    'status' => 'error',
			    'redirect' => ''
			   ];			
	} else {
		$livro = array( "isbn"=> $PostFilters['isbn'], 
						"titulo"=> $PostFilters['titulo'],
						"autores"=> $PostFilters['autores'],
						"ano_publicacao"=> $PostFilters['ano_publicacao'],
						"edicao"=> $PostFilters['edicao'],
						"editora"=> $PostFilters['editora'],
						"paginas"=> $PostFilters['paginas'],
						"categoria"=> $PostFilters['categoria'],
						"quantidade"=> $PostFilters['quantidade'],
						"idusuario"=> $PostFilters['iduser']
					);
	
		$resp_json = $livros->InsertLivro($livro);
		$message = json_decode($resp_json, true);		
	}

	echo json_encode($message);

} else if (isset($_POST['identCall']) == 'updateLivro'){

	$livro = array( "idlivro" => $PostFilters['idlivro'], 
					"isbn"=> $PostFilters['isbn'], 
					"titulo"=> $PostFilters['titulo'],
					"autores"=> $PostFilters['autores'],
					"ano_publicacao"=> $PostFilters['ano_publicacao'],
					"edicao"=> $PostFilters['edicao'],
					"editora"=> $PostFilters['editora'],
					"paginas"=> $PostFilters['paginas'],
					"categoria"=> $PostFilters['categoria'],
					"quantidade"=> $PostFilters['quantidade'],
					"ativo"=> $PostFilters['ativo'],
					"idusuario"=> $PostFilters['iduser'] 
				);

	$resp_json = $livros->UpdateLivro($livro);
	$message = json_decode($resp_json, true);		

	echo json_encode($message);

}