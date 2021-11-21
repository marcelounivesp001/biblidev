<?php
require_once '../auth.php';
require_once '../Models/usuarios.class.php';

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

if ($PostFilters['identCall'] == 'insertUsuario'){

	$messageCheck = $usuarios->CreateEditUserChecks($PostFilters['login_usuario'], $PostFilters['cpf']);
	if ($messageCheck['CPF'] == 'X'){
		$message = [
		 	    'value' => '',
		 	    'titulo' => '',
			    'message'=> 'Já existe um usuário cadastrado com o CPF informado.',
			    'status' => 'error',
			    'redirect' => ''
			   ];		
	} else if ($messageCheck['USUARIO'] == 'X'){
		$message = [
		 	    'value' => '',
		 	    'titulo' => '',
			    'message'=> 'Já existe um usuário cadastrado com o Login informado.',
			    'status' => 'error',
			    'redirect' => ''
			   ];		
	} else {

		$usuario = array( 
						"cpf"=> $PostFilters['cpf'], 
						"nome"=> $PostFilters['nome'],
						"sobrenome"=> $PostFilters['sobrenome'],
						"data_nascimento"=> $PostFilters['data_nascimento'],
						"sexo"=> $PostFilters['sexo'],
						"email"=> $PostFilters['email'],
						"cep"=> $PostFilters['cep'],
						"rua"=> $PostFilters['rua'],
						"num"=> $PostFilters['num'],
						"complemento"=> $PostFilters['complemento'],
						"bairro"=> $PostFilters['bairro'],
						"estado"=> $PostFilters['estado'],
						"cidade"=> $PostFilters['cidade'],
						"iduser"=>  $idUsuario,
						"login_usuario"=> $PostFilters['login_usuario'],
						"login_senha"=> md5($PostFilters['login_senha']),
						"login_idtipo_usuario"=> $PostFilters['login_idtipo_usuario']					
					);
	
	
			$resp_json = $usuarios->insertUsuario($usuario);
			$message = json_decode($resp_json, true);

	};

	echo json_encode($message);	

} else if ($PostFilters['identCall'] == 'updateUsuario'){

	$login_usuario = $PostFilters['login_usuario'] != "no_change" ? $PostFilters['login_usuario'] : "";
	$login_senha = $PostFilters['login_senha'] != "no_change" ? md5($PostFilters['login_senha']) : "";
	$user_check_error = "";

	if ($login_usuario != "") {
		$messageCheck = $usuarios->CreateEditUserChecks($PostFilters['login_usuario'], "");
		$user_check_error = $messageCheck['USUARIO'] == "X" ? "X" : "";
	}
	
	if ($user_check_error == "X"){
		$message = [
		 	    'value' => '',
		 	    'titulo' => '',
			    'message'=> 'Já existe um usuário cadastrado com o Login informado.',
			    'status' => 'error',
			    'redirect' => ''
			   ];		
	} else {

		$usuario = array( 
						"iduseredit"=> $PostFilters['iduseredit'],
						"cpf"=> $PostFilters['cpf'], 
						"nome"=> $PostFilters['nome'],
						"sobrenome"=> $PostFilters['sobrenome'],
						"data_nascimento"=> $PostFilters['data_nascimento'],
						"sexo"=> $PostFilters['sexo'],
						"email"=> $PostFilters['email'],
						"cep"=> $PostFilters['cep'],
						"rua"=> $PostFilters['rua'],
						"num"=> $PostFilters['num'],
						"complemento"=> $PostFilters['complemento'],
						"bairro"=> $PostFilters['bairro'],
						"estado"=> $PostFilters['estado'],
						"cidade"=> $PostFilters['cidade'],
						"ativo"=> $PostFilters['ativo'],
						"iduser"=> $idUsuario,
						"login_usuario"=> $login_usuario,
						"login_senha"=> $login_senha,
						"login_idtipo_usuario"=> $PostFilters['login_idtipo_usuario']				
					);
	
		$resp_json = $usuarios->UpdateUsuario($usuario);
		$message = json_decode($resp_json, true);

	}

	echo json_encode($message);

}