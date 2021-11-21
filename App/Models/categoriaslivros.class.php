<?php

/*
 Class Categorias Livros
*/

 require_once 'connect.php';

  class CategoriasLivros extends Connect
 {
 	
    public function GetCategoriasLivro(){

        $this->query = "SELECT *
        				FROM CATEGORIAS_LIVROS
        				WHERE delrg = '0'";

        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
                 
           while ($row[] = mysqli_fetch_array($this->result));
           return json_encode($row);
            
        }
    }

    public function EditCategoriaLivros($idcategoria)
    { 

        $this->query = "SELECT * FROM CATEGORIAS_LIVROS
                        WHERE idcategoria = '$idcategoria'";

        if ($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
            
            if ($row = mysqli_fetch_array($this->result)) {
                
                $idcategoria =  $row['idcategoria'];
                $categoria = $row['categoria'];
                $ativo = $row['ativo'];

                $categorialivro = array(
                                		 "idcategoria" => $idcategoria,
                                		 "categoria" => $categoria,
                                         "ativo" => $ativo
                               			);

                return $categorialivro;

            }

        } else {
            return 0;
        }

    }

    public  function UpdateCategoriaLivros($categorialivros){

        if (!empty($categorialivros)){

           $this->query = "UPDATE CATEGORIAS_LIVROS  SET categoria = '".$categorialivros['categoria']."', 
                                                         ativo = '".$categorialivros['ativo']."' 
                           WHERE idcategoria = '".$categorialivros['idcategoria']."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                $message = [
                        'value' => '',
                        'titulo' => "Categoria Livros Modificada com sucesso",
                        'message'=> "Categoria Livros <strong>".$categorialivros['categoria']."</strong> Modificada com sucesso.",
                        'status' => "success",
                        'redirect' => ""
                        ];              

            }else{  

                $message = [
                        'value' => '',
                        'titulo' => "Erro ao tentar Modificar Categoria Livros",
                        'message'=> "Erro ao tentar Modificar Categoria Livros <strong>".$categorialivros['categoria']."</strong>",
                        'status' => "error",
                        'redirect' => ""
                        ];

            }

            return json_encode($message);

        }
    }

    public function DeleteCategoriaLivros($idcategorialivros)
    {

            $this->query = "UPDATE CATEGORIAS_LIVROS SET delrg = '1' 
                            WHERE idcategoria = '".$idcategorialivros."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

              header('Location: ../../views/livros/categoriaslivros.php?alert=1');

           }else{

              header('Location: ../../views/livros/categoriaslivros.php?alert=0');

           }

    }
    
 	public function InsertCategoriaLivros($categorialivros){

 		if (!empty($categorialivros)){

            $values = "'".$categorialivros['categoria']."'";
    
            $this->query = "INSERT INTO CATEGORIAS_LIVROS (`categoria`) 
                             VALUES (".$values.")";
    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                $message = [
                        'value' => '',
                        'titulo' => "Categoria Livros Criada com sucesso",
                        'message'=> "Categoria Livros <strong>".$categorialivros['categoria']."</strong> Criada com sucesso.",
                        'status' => "success",
                        'redirect' => ""
                        ];

            }else{

                $message = [
                        'value' => '',
                        'titulo' => "Erro ao tentar inserir Categoria Livros",
                        'message'=> "Erro ao tentar inserir Categoria Livros <strong>".$categorialivros['categoria']."</strong>",
                        'status' => "error",
                        'redirect' => ""
                        ];

            }
            
            return json_encode($message);

 		}
     
 	}


    public function CreateEditCategoriaLivrosChecks($categoria, $idcategoria){     

        $message = array("CATEGORIA" => "");

        //Checar se a Categoria Livros já existe
        if ($categoria != "") {
            if ($idcategoria == "") {
                $this->query = "SELECT idcategoria FROM CATEGORIAS_LIVROS
                                where categoria = '".$categoria."'";
            } else {
                $this->query = "SELECT idcategoria FROM CATEGORIAS_LIVROS
                                where categoria = '".$categoria."'
                                  AND idcategoria <> '".$idcategoria."'";                
            }

    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
    
                if ($row = mysqli_fetch_array($this->result)) {
                    $message['CATEGORIA'] = 'X';    
                }
    
            };
        };


        return $message;         

    }

 }

 $categoriaslivros = new CategoriasLivros;