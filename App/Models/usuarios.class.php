<?php

/*
 Class Usuarios
*/

 require_once 'connect.php';

  class Usuarios extends Connect
 {
 	
 	public function index()
 	{

 		//$this->query = "SELECT * FROM USUARIOS
        //               WHERE delrg = '0'";

        $this->query = "SELECT a.iduser, 
                               a.cpf, 
                               a.nome, 
                               a.sobrenome, 
                               a.data_nascimento, 
                               a.sexo, 
                               a.email, 
                               a.cep, 
                               a.rua, 
                               a.num, 
                               a.complemento, 
                               a.bairro, 
                               a.estado, 
                               a.cidade, 
                               a.ativo,
                               b.idlogin,
                               b.idtipo_usuario,
                               c.tipo_usuario 
                        FROM USUARIOS AS a
                        join login as b on b.iduser = a.iduser
                        join tipos_usuario as c on c.idtipo_usuario = b.idtipo_usuario
                        WHERE a.delrg = '0'";

 		$this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
             while ($row[] = mysqli_fetch_array($this->result));
             return json_encode($row);
        }

 			
 	}

        public function GetUsuario($iduser)
    {

        $this->query = "SELECT a.iduser, 
                               a.cpf, 
                               a.nome, 
                               a.sobrenome, 
                               a.data_nascimento, 
                               a.sexo, 
                               a.email, 
                               a.cep, 
                               a.rua, 
                               a.num, 
                               a.complemento, 
                               a.bairro, 
                               a.estado, 
                               a.cidade, 
                               a.ativo,
                               b.idlogin,
                               b.usuario,
                               b.senha,
                               b.idtipo_usuario 
                        FROM USUARIOS AS a
                        join login as b on b.iduser = a.iduser
                        WHERE a.iduser = '$iduser'";
        if ($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
            
            if ($row = mysqli_fetch_array($this->result)) {
                
                $iduser =  $row['iduser'];
                $cpf = $row['cpf'];
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $data_nascimento = $row['data_nascimento'];
                $sexo = $row['sexo'];
                $email = $row['email'];
                $cep = $row['cep'];
                $rua = $row['rua'];
                $num = $row['num'];
                $complemento = $row['complemento'];
                $bairro = $row['bairro'];
                $estado = $row['estado'];
                $cidade = $row['cidade'];
                $ativo = $row['ativo'];
                $login_idlogin = $row['idlogin'];
                $login_usuario = $row['usuario']; 
                $login_senha = $row['senha'];
                $login_idtipo_usuario = $row['idtipo_usuario'];

                                $usuario = array(
                                    "iduser" => $iduser,
                                    "cpf" => $cpf,
                                    "nome" => $nome,
                                    "sobrenome" => $sobrenome,
                                    "data_nascimento" => $data_nascimento,
                                    "sexo" => $sexo,
                                    "email" => $email,
                                    "cep" => $cep,
                                    "rua" => $rua,
                                    "num" => $num,
                                    "complemento" => $complemento,
                                    "bairro" => $bairro,
                                    "estado" => $estado,
                                    "cidade" => $cidade,
                                    "ativo" => $ativo,
                                    "login_idlogin" => $login_idlogin,
                                    "login_usuario" => $login_usuario,
                                    "login_senha" => $login_senha,
                                    "login_idtipo_usuario" => $login_idtipo_usuario,
                                );

                                return $usuario;

            } 

        } else {
            return 0;
        }

    }    

    public function EditUsuario($iduseredit)
    {

        $this->query = "SELECT a.iduser, 
                               a.cpf, 
                               a.nome, 
                               a.sobrenome, 
                               a.data_nascimento, 
                               a.sexo, 
                               a.email, 
                               a.cep, 
                               a.rua, 
                               a.num, 
                               a.complemento, 
                               a.bairro, 
                               a.estado, 
                               a.cidade, 
                               a.ativo,
                               b.idlogin,
                               b.usuario,
                               b.senha,
                               b.idtipo_usuario 
                        FROM USUARIOS AS a
                        join login as b on b.iduser = a.iduser
                        WHERE a.iduser = '$iduseredit'";
        if ($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
            
            if ($row = mysqli_fetch_array($this->result)) {
                
                $iduser =  $row['iduser'];
                $cpf = $row['cpf'];
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $data_nascimento = $row['data_nascimento'];
                $sexo = $row['sexo'];
                $email = $row['email'];
                $cep = $row['cep'];
                $rua = $row['rua'];
                $num = $row['num'];
                $complemento = $row['complemento'];
                $bairro = $row['bairro'];
                $estado = $row['estado'];
                $cidade = $row['cidade'];
                $ativo = $row['ativo'];
                $login_idlogin = $row['idlogin'];
                $login_usuario = $row['usuario']; 
                $login_senha = $row['senha'];
                $login_idtipo_usuario = $row['idtipo_usuario'];

                                $usuario = array(
                                    "iduser" => $iduser,
                                    "cpf" => $cpf,
                                    "nome" => $nome,
                                    "sobrenome" => $sobrenome,
                                    "data_nascimento" => $data_nascimento,
                                    "sexo" => $sexo,
                                    "email" => $email,
                                    "cep" => $cep,
                                    "rua" => $rua,
                                    "num" => $num,
                                    "complemento" => $complemento,
                                    "bairro" => $bairro,
                                    "estado" => $estado,
                                    "cidade" => $cidade,
                                    "ativo" => $ativo,
                                    "login_idlogin" => $login_idlogin,
                                    "login_usuario" => $login_usuario,
                                    "login_senha" => $login_senha,
                                    "login_idtipo_usuario" => $login_idtipo_usuario,
                                );

                                return $usuario;

            } 

        } else {
            return 0;
        }

    }    

    public function DeleteUsuario($iduser){

        $this->query = "UPDATE USUARIOS AS a 
                        JOIN LOGIN AS b ON b.iduser = a.iduser
                        SET a.delrg = '1',
                            b.delrg = '1'
                        WHERE a.iduser = '".$iduser."'
                          AND b.iduser = '".$iduser."'"; 

        if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

              header('Location: ../../views/usuarios/index.php?alert=1');

        }else{

              header('Location: ../../views/usuarios/index.php?alert=0');

        }

    }

    public function CreateEditUserChecks($usuarioLogin, $cpf){     

        $message = array("USUARIO" => "", 
                         "CPF" => "");

        //Checar se Nome de Usuário já existe
        if ($usuarioLogin != "") {
            $this->query = "SELECT iduser FROM LOGIN
                            where usuario = '".$usuarioLogin."'";
    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
    
                if ($row = mysqli_fetch_array($this->result)) {
                    $message['USUARIO'] = 'X';    
                }
    
            };
        };


        //Checar se CPF já existe
        if ($cpf != "") {
            $this->query = "SELECT iduser FROM USUARIOS
                            where cpf = '".$cpf."'";
    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                if ($row = mysqli_fetch_array($this->result)) {
                    $message['CPF'] = 'X';                    
                }

            };
        }


        return $message;         

    }

        public function insertUsuario($usuario){          

        if (!empty($usuario)){

         //Inserir Tabela Usuario   
         $values_usuario = "'".$usuario['cpf']."',
                            '".$usuario['nome']."',
                            '".$usuario['sobrenome']."',
                            '".$usuario['data_nascimento']."',
                            '".$usuario['sexo']."',
                            '".$usuario['email']."',
                            '".$usuario['cep']."',
                            '".$usuario['rua']."',
                            '".$usuario['num']."',
                            '".$usuario['complemento']."',
                            '".$usuario['bairro']."',
                            '".$usuario['estado']."',
                            '".$usuario['cidade']."'";


         $this->query = "INSERT INTO USUARIOS (`cpf`, `nome`, `sobrenome`, `data_nascimento`, `sexo`, `email`, `cep`, `rua`, `num`, `complemento`, `bairro`, `estado`, `cidade`) 
                         VALUES (".$values_usuario.")";

        if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
            
            $last_user_id = mysqli_insert_id($this->SQL);

            //Inserir Tabela Login                       
            $values_login = "'".$last_user_id."',
                             '".$usuario['login_usuario']."',
                             '".$usuario['login_senha']."',
                             '".$usuario['login_idtipo_usuario']."'";

             $this->query = "INSERT INTO LOGIN (`iduser`, `usuario`, `senha`, `idtipo_usuario`) 
                             VALUES (".$values_login.")";
    
               if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
    
                    $message = [
                            'value' => '',
                            'titulo' => "Usuário Criado com sucesso",
                            'message'=> "Usuário <strong>".$last_user_id."</strong> Criado com sucesso.",
                            'status' => "success",
                            'redirect' => ""
                            ];
    
               } else {
    
                    $message = [
                            'value' => '',
                            'titulo' => '',
                            'message'=> "Erro ao tentar inserir usuário.",
                            'status' => "error",
                            'redirect' => ""
                            ]; 

               }

        } else {

            $message = [
                        'value' => '',
                        'titulo' => '',
                        'message'=> "Erro ao tentar inserir usuário.",
                        'status' => "error",
                        'redirect' => ""
                        ];              

        }

        return json_encode($message);        

    }

    } 

    public  function UpdateUsuario($usuario){     

        if (!empty($usuario)){

            $update_login = "";

            if (!empty($usuario['login_usuario'])) {
                $update_login = "b.usuario ='".$usuario['login_usuario']."',"; 
            }

            if (!empty($usuario['login_senha'])) {
                $update_login .= "b.senha ='".$usuario['login_senha']."',"; 
            }

            $update_login .= "b.idtipo_usuario = '".$usuario['login_idtipo_usuario']."'";           

           $this->query = "UPDATE USUARIOS AS a 
                           JOIN LOGIN AS b ON b.iduser = a.iduser
                           SET a.nome = '".$usuario['nome']."',
                               a.sobrenome = '".$usuario['sobrenome']."',
                               a.data_nascimento = '".$usuario['data_nascimento']."',
                               a.sexo = '".$usuario['sexo']."',
                               a.email = '".$usuario['email']."',
                               a.cep = '".$usuario['cep']."',
                               a.rua = '".$usuario['rua']."',
                               a.num = '".$usuario['num']."',
                               a.complemento = '".$usuario['complemento']."',
                               a.bairro = '".$usuario['bairro']."',
                               a.estado = '".$usuario['estado']."',
                               a.cidade = '".$usuario['cidade']."',
                               a.ativo = '".$usuario['ativo']."',
                               ".$update_login."
                           WHERE a.iduser = '".$usuario['iduseredit']."'
                             and b.iduser ='".$usuario['iduseredit']."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                 $message = [
                         'value' => '',
                         'titulo' => "Usuário Modificado com sucesso",
                         'message'=> "Usuário <strong>".$usuario['iduseredit']."</strong> Modificado com sucesso.",
                         'status' => "success",
                         'redirect' => ""
                         ];

            } else {

                 $message = [
                         'value' => '',
                         'titulo' => '',
                         'message'=> "Erro ao tentar editar usuário.",
                         'status' => "error",
                         'redirect' => ""
                         ]; 
            }

            return json_encode($message);

        }
    }

    }

$usuarios = new Usuarios;