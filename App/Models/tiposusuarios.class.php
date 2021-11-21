<?php

/*
 Class Tipos Usuario
*/

 require_once 'connect.php';

  class TiposUsuarios extends Connect
 {
 	
    public function GetTiposUsuarios(){

        $this->query = "SELECT *
        				FROM TIPOS_USUARIO
        				WHERE delrg = '0'";

        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
                 
           while ($row[] = mysqli_fetch_array($this->result));
           return json_encode($row);
            
        }
    }

    function GetTipoUsuario($idtipo_Usuario){

        $this->query  = "SELECT *
                         FROM tipos_usuario 
                         where idtipo_usuario = '$idtipo_Usuario'";              
        $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
        $this->total  = mysqli_num_rows($this->result);

        if($this->total){
            $this->dados = mysqli_fetch_array($this->result);

            $tipo_usuario = array("administrar_usuarios"=> $this->dados['administrar_usuarios'],
                                  "administrar_livros"=> $this->dados['administrar_livros'],
                                  "administrar_emprestimos"=> $this->dados['administrar_emprestimos'],
                                  "emprestimos_livros"=> $this->dados['emprestimo_livros'],
                                  "limite_livros_emprestimo"=> $this->dados['limite_livros_emprestimo'],
                                  "limite_dias_emprestimo"=> $this->dados['limite_livros_emprestimo'],
                                  "ativo"=> $this->dados['ativo']);

            return $tipo_usuario;
        }

    }    

    public function EditTipoUsuarios($idtipo_usuario)
    {

        $this->query = "SELECT * FROM TIPOS_USUARIO
                        WHERE idtipo_usuario = '$idtipo_usuario'";

        if ($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
            
            if ($row = mysqli_fetch_array($this->result)) {
                
                $idtipo_usuario =  $row['idtipo_usuario'];
                $tipo_usuario =  $row['tipo_usuario'];
                $administrar_usuarios = $row['administrar_usuarios'];
                $administrar_livros = $row['administrar_livros'];
                $administrar_emprestimos = $row['administrar_emprestimos'];
                $limite_livros_emprestimo = $row['limite_livros_emprestimo'];
                $limite_dias_emprestimo = $row['limite_dias_emprestimo'];                
                $ativo = $row['ativo'];

                $TiposUsuario = array(
                                         "idtipo_usuario" => $idtipo_usuario,
                                		 "tipo_usuario" => $tipo_usuario,
                                         "administrar_usuarios" => $administrar_usuarios,
                                         "administrar_livros" => $administrar_livros,
                                         "administrar_emprestimos" => $administrar_emprestimos,
                                         "limite_livros_emprestimo" => $limite_livros_emprestimo,
                                         "limite_dias_emprestimo" => $limite_dias_emprestimo,
                                         "ativo" => $ativo,
                               			);

                return $TiposUsuario;

            }

        } else {
            return 0;
        }

    }

    public function DeleteTipoUsuarios($idtipo_usuario)
    {

            $this->query = "UPDATE TIPOS_USUARIO SET delrg = '1' 
                            WHERE idtipo_usuario = '".$idtipo_usuario."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

              header('Location: ../../views/usuarios/tiposusuario.php?alert=1');

           }else{

              header('Location: ../../views/usuarios/tiposusuario.php?alert=0');

           }

    }

    public function CreateEditTipoUsuarioChecks($tipo_usuario, $idtipo_usuario){     

        $message = array("TIPO_USUARIO" => "");

        //Checar se o Tipo de Usuário já existe
        if ($tipo_usuario != "") {
            if ($idtipo_usuario == "") {
                $this->query = "SELECT idtipo_Usuario FROM TIPOS_USUARIO
                                where tipo_usuario = '".$tipo_usuario."'";
            } else {
                $this->query = "SELECT idtipo_Usuario FROM TIPOS_USUARIO
                                where tipo_usuario = '".$tipo_usuario."'
                                  AND idtipo_usuario <> '".$idtipo_usuario."'";                
            }

    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
    
                if ($row = mysqli_fetch_array($this->result)) {
                    $message['TIPO_USUARIO'] = 'X';    
                }
    
            };
        };


        return $message;         

    }    

    public function InsertTipoUsuarios($tipoUsuarios){

        if (!empty($tipoUsuarios)){

         $values = "'".$tipoUsuarios['tipo_usuario']."',
                    '".$tipoUsuarios['administrar_usuarios']."',
                    '".$tipoUsuarios['administrar_livros']."',
                    '".$tipoUsuarios['administrar_emprestimos']."',
                    '".$tipoUsuarios['limite_livros_emprestimo']."',
                    '".$tipoUsuarios['limite_dias_emprestimo']."'";

        $this->query = "INSERT INTO TIPOS_USUARIO (`tipo_usuario`, `administrar_usuarios`, `administrar_livros`, `administrar_emprestimos`, `limite_livros_emprestimo`, `limite_dias_emprestimo`) 
                         VALUES (".$values.")";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                $message = [
                        'value' => '',
                        'titulo' => "Tipo Usuários Criado com sucesso",
                        'message'=> "Tipo Usuários <strong>".$tipoUsuarios['tipo_usuario']."</strong> Criado com sucesso.",
                        'status' => "success",
                        'redirect' => ""
                        ];

            }else{

                $message = [
                        'value' => '',
                        'titulo' => "Erro ao tentar inserir Tipo Usuários",
                        'message'=> "Erro ao tentar inserir Tipo Usuários <strong>".$tipoUsuarios['tipo_usuario']."</strong>",
                        'status' => "error",
                        'redirect' => ""
                        ];

            }
            
        return json_encode($message);

        }
    
    }

    public  function UpdateTipoUsuarios($tipousuarios){

        if (!empty($tipousuarios)){

           $this->query = "UPDATE TIPOS_USUARIO  SET tipo_usuario = '".$tipousuarios['tipo_usuario']."',
                                                     administrar_usuarios = '".$tipousuarios['administrar_usuarios']."',
                                                     administrar_livros = '".$tipousuarios['administrar_livros']."',
                                                     administrar_emprestimos = '".$tipousuarios['administrar_emprestimos']."',
                                                     limite_livros_emprestimo = '".$tipousuarios['limite_livros_emprestimo']."',
                                                     limite_dias_emprestimo = '".$tipousuarios['limite_dias_emprestimo']."',
                                                     ativo = '".$tipousuarios['ativo']."'
                           WHERE idtipo_usuario = '".$tipousuarios['idtipo_usuario']."'";

           if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                $message = [
                        'value' => '',
                        'titulo' => "Tipo Usuários Modificado com sucesso",
                        'message'=> "Tipo Usuários <strong>".$tipousuarios['tipo_usuario']."</strong> Modificado com sucesso.",
                        'status' => "success",
                        'redirect' => ""
                        ];

           }else{

                $message = [
                        'value' => '',
                        'titulo' => "Erro ao tentar Modificar Tipo Usuários",
                        'message'=> "Erro ao tentar Modificar Tipo Usuários <strong>".$tipoUsuarios['tipo_usuario']."</strong>",
                        'status' => "error",
                        'redirect' => ""
                        ];

           }

           return json_encode($message);

        }
    }    

 }

 $tiposUsuarios = new TiposUsuarios;