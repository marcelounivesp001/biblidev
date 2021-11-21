<?php

/*
 Class Livros
*/

 require_once 'connect.php';

  class Livros extends Connect
 {
 	
 	public function Index()
 	{
        $this->query = "
        SELECT count(b.idlivro) as `quant_locados`, 
                a.idlivro, 
                a.isbn, 
                a.titulo, 
                a.autores,  
                a.ano_publicacao, 
                a.edicao, 
                a.editora, 
                a.paginas, 
                a.idcategoria, 
                a.quantidade,
                a.ativo,
                d.categoria 
        from livros as a
        left join emprestimos_livros as b on b.idlivro = a.idlivro
        left join emprestimos as c on c.idemprestimo = b.idemprestimo
        join categorias_livros as d on d.idcategoria = a.idcategoria
        where c.data_devolucao is null
         and a.delrg = '0'
        group by a.isbn";

        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
 		     while ($row[] = mysqli_fetch_array($this->result));
             return json_encode($row);
        }

 	}

    public function GetLivrosLocacao(){

        $this->query = "
        SELECT count(b.idlivro) as `quant_locados`, 
                a.idlivro, 
                a.isbn, 
                a.titulo, 
                a.autores, 
                a.ano_publicacao, 
                a.edicao, 
                a.editora, 
                a.paginas, 
                a.idcategoria, 
                a.quantidade,
                a.ativo 
        from livros as a
        left join emprestimos_livros as b on b.idlivro = a.idlivro
        left join emprestimos as c on c.idemprestimo = b.idemprestimo
        where c.data_devolucao is null
          and a.delrg = '0'
          and a.ativo = '1'  
        group by a.isbn";

        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
                 
           while ($row[] = mysqli_fetch_array($this->result));
           return json_encode($row);
            
        }
    }

    public function EditLivro($idlivro)
    {

        $this->query = "SELECT * FROM `LIVROS` 
                        WHERE `idlivro` = '$idlivro'";
        if ($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
            
            if ($row = mysqli_fetch_array($this->result)) {
                
                $idlivro =  $row['idlivro'];
                $isbn = $row['isbn'];
                $titulo = $row['titulo'];
                $autores = $row['autores'];
                $ano_publicacao = $row['ano_publicacao'];
                $edicao = $row['edicao'];
                $editora = $row['editora'];
                $paginas = $row['paginas'];
                $idcategoria = $row['idcategoria'];
                $quantidade = $row['quantidade'];
                $ativo = $row['ativo'];

                                $livro = array(
                                    "idlivro" => $idlivro,
                                    "isbn" => $isbn,
                                    "titulo" => $titulo,
                                    "autores" => $autores,
                                    "ano_publicacao" => $ano_publicacao,
                                    "edicao" => $edicao,
                                    "editora" => $editora,
                                    "paginas" => $paginas,
                                    "idcategoria" => $idcategoria,
                                    "quantidade" => $quantidade,
                                    "ativo" => $ativo
                                );

                                return $livro;

            }

        } else {
            return 0;
        }

    }

    public function DeleteLivro($idlivro)
    {

            $this->query = "UPDATE `LIVROS` SET `delrg` = '1' 
                            WHERE `idlivro` = '".$idlivro."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

              header('Location: ../../views/livros/index.php?alert=1');

           }else{

              header('Location: ../../views/livros/index.php?alert=0');

           }

    }

    public function CreateEditLivroChecks($isbn){     

        $message = array("ISBN" => "");

        //Checar se ISBN já existe
        if ($isbn != "") {
            $this->query = "SELECT idlivro FROM livros
                            where isbn = '".$isbn."'";
    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
    
                if ($row = mysqli_fetch_array($this->result)) {
                    $message['ISBN'] = 'X';    
                }
    
            };
        };

        return $message;         

    }

    public function insertLivro($livro){

        if (!empty($livro)){

            $values = "'".$livro['isbn']."',
                        '".$livro['titulo']."',
                        '".$livro['autores']."',
                        '".$livro['ano_publicacao']."',
                        '".$livro['edicao']."',
                        '".$livro['editora']."',
                        '".$livro['paginas']."',
                        '".$livro['categoria']."',
                        '".$livro['quantidade']."'";
    
            $this->query = "INSERT INTO LIVROS (`isbn`, `titulo`, `autores`, `ano_publicacao`, `edicao`, `editora`, `paginas`, `idcategoria`, `quantidade`) 
                            VALUES (".$values.")";
    
            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                $last_livro_id = mysqli_insert_id($this->SQL);
    
                $message = [
                        'value' => '',
                        'titulo' => "Livro Criado com sucesso",
                        'message'=> "Livro <strong>".$last_livro_id."</strong> Criado com sucesso.",
                        'status' => "success",
                        'redirect' => ""
                        ];
    
            }else{
    
                $message = [
                        'value' => '',
                        'titulo' => '',
                        'message'=> "Erro ao tentar inserir Livro.",
                        'status' => "error",
                        'redirect' => ""
                        ];
    
            }

            return json_encode($message);

        }
    
    }    

    public  function UpdateLivro($livro){

        if (!empty($livro)){

           $this->query = "UPDATE `LIVROS` SET `isbn` = '".$livro['isbn']."', 
                                                `titulo`= '".$livro['titulo']."',
                                                `autores`= '".$livro['autores']."',
                                                `ano_publicacao`= '".$livro['ano_publicacao']."',
                                                `edicao`= '".$livro['edicao']."',
                                                `editora`= '".$livro['editora']."',
                                                `paginas`= '".$livro['paginas']."',
                                                `idcategoria`= '".$livro['categoria']."',
                                                `quantidade`= '".$livro['quantidade']."', 
                                                `ativo`='".$livro['ativo']."'  
                            WHERE `idlivro` = '".$livro['idlivro']."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

                $message = [
                        'value' => '',
                        'titulo' => "Livro Modificado com sucesso",
                        'message'=> "Livro <strong>".$livro['idlivro']."</strong> Modificado com sucesso.",
                        'status' => "success",
                        'redirect' => ""
                        ];

            }else{

                $message = [
                        'value' => '',
                        'titulo' => '',
                        'message'=> "Erro ao tentar editar Livro.",
                        'status' => "error",
                        'redirect' => ""
                        ]; 

           }

           return json_encode($message);
           
        }
    }    

 }

$livros = new Livros;