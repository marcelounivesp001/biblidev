<?php

/**
 * Conexão com o banco de dados
 */ 
 class Connect
 {
 	
 	var $localhost = "localhost";
 	var $root = "root";  
 	var $passwd = "";
 	var $database = "biblidev";
 	var $SQL;

 	public function __construct()
 	{
 		$this->SQL = mysqli_connect($this->localhost, $this->root, $this->passwd);
		mysqli_select_db($this->SQL, $this->database);
		if(!$this->SQL){
			die("Conexão com o banco de dados falhou!:" . mysqli_connect_error($this->SQL)); 
		}
 	}

 	function login($username, $password, $rememberme){

 		$passwordCheck = md5($password);

 		//Login
 		$this->query  = "SELECT a.iduser, 
 								a.usuario, 
 								a.senha, 
 								a.idtipo_usuario, 
 								b.nome, 
 								b.sobrenome 
						 FROM LOGIN AS a 
						 JOIN USUARIOS AS b ON b.iduser = a.iduser
						 where a.usuario = '$username'";				 
 		$this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
 		$this->total  = mysqli_num_rows($this->result);

 		if($this->total){

 			$this->dados = mysqli_fetch_array($this->result);
 			if(!strcmp($passwordCheck, $this->dados['senha'])){			

 				$_SESSION['idUsuario'] = $this->dados['iduser'];
 				$_SESSION['usuario'] = $this->dados['usuario'];
 				$_SESSION['idtipoUsuario'] = $this->dados['idtipo_usuario'];
 				$_SESSION['nomeUsuario'] = $this->dados['nome']." ".$this->dados['sobrenome'];
 				//$_SESSION['foto']      = $this->dados['imagem'];

 				if ($rememberme == "SIM") {
		   			$expira = time() + 60*60*24*30;  					
		   			setCookie('CookieRememberme', base64_encode('SIM'), $expira);
		   			setCookie('CookieUsername', base64_encode($username), $expira);

 				} else {
 					setCookie('CookieRememberme');
					setCookie('CookieUsername');

 				}
 				
				$this->getPermissoes($_SESSION['idtipoUsuario']);

 				header("Location: views/");
 			} else {
 				header("Location: login.php?alert=2");
 			}
 		} else {
 				header("Location: login.php?alert=1");
 		}
 	}

 	function login2($username, $password, $rememberme){

 		$passwordCheck = md5($password);

 		//Login
 		$this->query  = "SELECT a.iduser, 
 								a.usuario, 
 								a.senha, 
 								a.idtipo_usuario, 
 								b.nome, 
 								b.sobrenome 
						 FROM LOGIN AS a 
						 JOIN USUARIOS AS b ON b.iduser = a.iduser
						 where a.usuario = '$username'";				 
 		$this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
 		$this->total  = mysqli_num_rows($this->result);

 		if($this->total){

 			$this->dados = mysqli_fetch_array($this->result);
 			if(!strcmp($passwordCheck, $this->dados['senha'])){			

 				$_SESSION['idUsuario'] = $this->dados['iduser'];
 				$_SESSION['usuario'] = $this->dados['usuario'];
 				$_SESSION['idtipoUsuario'] = $this->dados['idtipo_usuario'];
 				$_SESSION['nomeUsuario'] = $this->dados['nome']." ".$this->dados['sobrenome'];
 				//$_SESSION['foto']      = $this->dados['imagem'];

 				if ($rememberme == "SIM") {
		   			$expira = time() + 60*60*24*30;  					
		   			setCookie('CookieRememberme', base64_encode('SIM'), $expira);
		   			setCookie('CookieUsername', base64_encode($username), $expira);

 				} else {
 					setCookie('CookieRememberme');
					setCookie('CookieUsername');

 				}
 				
				$this->getPermissoes($_SESSION['idtipoUsuario']);

 				$message = [
                        	'value' => '',
                        	'titulo' => '',
                        	'message'=> 'Login realizado com sucesso',
                        	'status' => 'success',
                        	'redirect' => 'views/'
                        	]; 
 			} else {
 				$message = [
                        	'value' => '',
                        	'titulo' => '',
                        	'message'=> 'Usuário e senha não conferem.<br>Verifique suas credenciais',
                        	'status' => 'error',
                        	'redirect' => ''
                        ]; 
 			}
 		} else {
            $message = [
                        'value' => '',
                        'titulo' => '',
                        'message'=> 'Usuário não encontrado.<br>Verifique suas credenciais.',
                        'status' => 'error',
                        'redirect' => ''
                        ]; 				
 		}

 		return json_encode($message);

 	} 	

 	function getPermissoes($idtipo_Usuario){

 		$this->query  = "SELECT *
						 FROM tipos_usuario 
						 where idtipo_usuario = '$idtipo_Usuario'";				 
 		$this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
 		$this->total  = mysqli_num_rows($this->result);

 		if($this->total){
 			$this->dados = mysqli_fetch_array($this->result);

 			$_SESSION['permissoes'] = array("administrar_usuarios"=> $this->dados['administrar_usuarios'],
 											"administrar_livros"=> $this->dados['administrar_livros'],
 											"administrar_emprestimos"=> $this->dados['administrar_emprestimos'],
 											"limite_livros_emprestimo"=> $this->dados['limite_livros_emprestimo'],
 											"limite_dias_emprestimo"=> $this->dados['limite_dias_emprestimo']);


 		}

 	}
 	
 }
$connect = new Connect; 