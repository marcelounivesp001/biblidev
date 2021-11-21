<?php
require_once '../auth.php';
require_once '../Models/tiposusuarios.class.php';

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

if ($PostFilters['identCall'] == 'InsertTipoUsuarios'){
	$iduser = $idUsuario;
	$idtipo_Usuario = "";

	$messageCheck = $tiposUsuarios->CreateEditTipoUsuarioChecks($PostFilters['tipo_usuario'], $idtipo_Usuario);
	if ($messageCheck['TIPO_USUARIO'] == 'X'){
		$message = [
		 	    'value' => "",
		 	    'titulo' => "",
			    'message'=> "Já existe Tipo Usuário &nbsp;<strong>".$PostFilters['tipo_usuario']."</strong >&nbsp; cadastrado.",
			    'status' => "error",
			    'redirect' => ""
			   ];		
			   		
	} else {

		$tipousuarios = array( 
							"tipo_usuario" =>$PostFilters['tipo_usuario'],
						   	"administrar_usuarios" => $PostFilters['administrar_usuarios'],
						    "administrar_livros" => $PostFilters['administrar_livros'],
						    "administrar_emprestimos" => $PostFilters['administrar_emprestimos'],
						    "limite_livros_emprestimo" => $PostFilters['limite_livros_emprestimo'],
						    "limite_dias_emprestimo" => $PostFilters['limite_dias_emprestimo'],
						);

		$resp_json = $tiposUsuarios->InsertTipoUsuarios($tipousuarios);
		$message = json_decode($resp_json, true);

	}

	echo json_encode($message);	


 } else if ($PostFilters['identCall'] == 'UpdateTipoUsuarios'){
 	$iduser = $idUsuario;
 	$idtipo_Usuario = $PostFilters['idtipo_usuario'];

 	$messageCheck = $tiposUsuarios->CreateEditTipoUsuarioChecks($PostFilters['tipo_usuario'], $idtipo_Usuario);
	if ($messageCheck['TIPO_USUARIO'] == 'X'){
		$message = [
		 	    'value' => "",
		 	    'titulo' => "",
			    'message'=> "Já existe Tipo Usuário &nbsp;<strong>".$PostFilters['tipo_usuario']."</strong> &nbsp; cadastrado.",
			    'status' => "error",
			    'redirect' => ""
			   ];	

	} else {
	$tipousuarios = array( "idtipo_usuario"=> $idtipo_Usuario,
						   "tipo_usuario" =>$PostFilters['tipo_usuario'],
						   "administrar_usuarios" => $PostFilters['administrar_usuarios'],
						   "administrar_livros" => $PostFilters['administrar_livros'],
						   "administrar_emprestimos" => $PostFilters['administrar_emprestimos'],
						   "limite_livros_emprestimo" => $PostFilters['limite_livros_emprestimo'],
						   "limite_dias_emprestimo" => $PostFilters['limite_dias_emprestimo'],
						   "ativo" => $PostFilters['ativo']
						);

	$resp_json = $tiposUsuarios->UpdateTipoUsuarios($tipousuarios);
	$message = json_decode($resp_json, true);

	}

	echo json_encode($message);	

}