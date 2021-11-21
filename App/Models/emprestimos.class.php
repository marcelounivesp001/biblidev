<?php

/*
 Class Emprestimos
*/

 require_once 'connect.php';

  class Emprestimos extends Connect
 {
 	
 	public function Index()
 	{
 		$this->query = "SELECT a.idemprestimo, 
                               a.iduser, 
                               a.data_reserva, 
                               a.hora_reserva,                               
                               a.data_locacao, 
                               a.hora_locacao, 
                               a.data_devolucao, 
                               a.hora_devolucao, 
                               b.nome, 
                               b.sobrenome,
                               d.limite_dias_emprestimo
                        FROM EMPRESTIMOS AS a 
                        JOIN USUARIOS AS b ON b.iduser = a.iduser
                        JOIN LOGIN AS c ON c.iduser = a.iduser
                        JOIN TIPOS_USUARIO AS d ON d.idtipo_usuario = c.idtipo_usuario
                        WHERE a.delrg = '0'";
 		$this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

 		if($this->result){
 		
 			while ($row[] = mysqli_fetch_array($this->result)); 
            return json_encode($row);
 			
 		}

 	}

    public function GetEmprestimosUsuario($idUser)
    {

        $this->query = "SELECT a.idemprestimo, 
                               a.iduser,
                               a.data_reserva,
                               a.hora_reserva,  
                               a.data_locacao, 
                               a.hora_locacao, 
                               a.data_devolucao, 
                               a.hora_devolucao, 
                               b.nome, 
                               b.sobrenome,
                               d.limite_dias_emprestimo
                        FROM EMPRESTIMOS AS a 
                        JOIN USUARIOS AS b ON b.iduser = a.iduser
                        JOIN LOGIN AS c ON c.iduser = a.iduser
                        JOIN TIPOS_USUARIO AS d ON d.idtipo_usuario = c.idtipo_usuario
                        WHERE a.iduser = ".$idUser."
                          AND a.delrg = '0'";
        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
        
            while ($row[] = mysqli_fetch_array($this->result)); 
            return json_encode($row);
            
        }

    }

    public function GetEmprestimoLivros($idemprestimo){

        $this->query = "SELECT a.id, 
                               a.idemprestimo, 
                               a.iduser, 
                               a.idlivro, 
                               a.comentario, 
                               b.nome, 
                               b.sobrenome, 
                               c.titulo,
                               c.isbn,
                               d.data_locacao
                        FROM EMPRESTIMOS_LIVROS AS a 
                        JOIN USUARIOS AS b ON b.iduser = a.iduser
                        JOIN LIVROS AS c ON c.idlivro = a.idlivro
                        JOIN EMPRESTIMOS AS d on d.idemprestimo = a.idemprestimo
                        where a.idemprestimo = '$idemprestimo'";
        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if($this->result){
            
            while ($row[] = mysqli_fetch_array($this->result)); 
            return json_encode($row);
            
        }

    }

    public function EditEmprestimo($idemprestimo)
    {

        $this->query = "SELECT * FROM `EMPRESTIMOS` 
                        WHERE `idemprestimos` = '$idemprestimos'";
        if ($this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL))){
            
            if ($row = mysqli_fetch_array($this->result)) {
                
                $idemprestimo = $row['idemprestimo'];
                $iduser =  $row['iduser'];
                $data_locacao = $row['data_locacao'];
                $hora_locacao = $row['hora_locacao'];
                $data_devolucao = $row['data_devolucao'];
                $hora_devolucao = $row['hora_devolucao'];

                                $emprestimo = array(
                                    "idemprestimo" => $idemprestimo,
                                    "iduser" => $iduser,
                                    "data_locacao" => $data_locacao,
                                    "hora_locacao" => $hora_locacao,
                                    "data_devolucao" => $data_devolucao,
                                    "hora_devolucao" => $hora_devolucao
                                );

                                return $emprestimo;

            }

        } else {
            return 0;
        }

    }

    public function DeleteEmprestimo($emprestimo)
    {

            $this->query = "UPDATE EMPRESTIMOS AS a 
                            JOIN EMPRESTIMOS_LIVROS AS b ON b.idemprestimo = a.idemprestimo
                            SET a.delrg = '1',
                                b.delrg = '1' 
                            WHERE a.idemprestimo = '".$idemprestimo."'
                              AND b.idemprestimo = '".$idemprestimo."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

              header('Location: ../../views/emprestimos/index.php?alert=1');

           }else{

              header('Location: ../../views/emprestimos/index.php?alert=0');

           }

    }

    public function DeleteLivroEmprestimo($idemprestimo, $idLivroEmprestimo)
    {

            $this->query = "DELETE FROM EMPRESTIMOS_LIVROS  
                            WHERE id = '".$idLivroEmprestimo."'
                              AND idemprestimo = '".$idemprestimo."'";

            if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

              header('Location: ../../views/emprestimos/emprestimo_livros.php?id='.$idemprestimo.'&alert=1');

           }else{

              header('Location: ../../views/emprestimos/emprestimo_livros.php?id='.$idemprestimo.'&alert=0');

           }        

    }


    public function InsertEmprestimo($valueEmprestimo, $cestoLivros, $idUsuario)
    {

         $this->query = "INSERT INTO EMPRESTIMOS (`iduser`, `data_reserva`, `hora_reserva`) 
                         VALUES (".$valueEmprestimo.")";

        if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
            
            $last_emprestimo_id = mysqli_insert_id($this->SQL);

            //Inserir Tabela Livros Emprestimo   
            $values_livros_emprestimo = "";
            foreach ($cestoLivros as $key => $value) {
                if (empty($values_livros_emprestimo)) {
                    $values_livros_emprestimo .= "('".$last_emprestimo_id."',
                                                   '".$idUsuario."',
                                                   '".$key."')";
                } else {
                    $values_livros_emprestimo .= ",('".$last_emprestimo_id."',
                                                    '".$idUsuario."',
                                                    '".$key."')";                   
                }

            }


         $this->query = "INSERT INTO EMPRESTIMOS_LIVROS (`idemprestimo`, `iduser`, `idlivro`) 
                         VALUES ".$values_livros_emprestimo."";

           if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

            $message = [
                        'value' => '',
                        'titulo' => "Reserva <strong>".$last_emprestimo_id."</strong> criada com sucesso.",
                        'message'=> "Para a retirada dos livros dirija-se a um funcionário da biblioteca com o número de reserva.",
                        'status' => "success",
                        'redirect' => ""
                       ];

           } else {

            $message = [
                        'value' => '',
                        'titulo' => 'Erro Criação Reserva',
                        'message'=> "Erro ao atribuir livros a reserva".$last_emprestimo_id."",
                        'status' => "error",
                        'redirect' => ""
                       ];

           };

        } else {

            $message = [
                        'value' => '',
                        'titulo' => 'Erro Criação Reserva',
                        'message'=> "Erro ao criar reserva livros. Tente novamente",
                        'status' => "error",
                        'redirect' => ""
                       ];

        };               

        return json_encode($message);

    }

    public function GetQuantLivrosEmprestimoUsuario($idUser)
    {

        $this->query = "SELECT count(b.id) as `quant_livros_emprestados`
                        FROM EMPRESTIMOS AS a 
                        JOIN EMPRESTIMOS_LIVROS AS b ON b.idemprestimo = a.idemprestimo 
                        WHERE a.iduser = ".$idUser."
                          and a.data_reserva is not null
                          and a.data_devolucao is null
                          and a.delrg = '0'";

        $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));

        if ($row = mysqli_fetch_array($this->result)) {
                
            $quant_livros_emprestados = 0;
            if (isset($row['quant_livros_emprestados']) && $row['quant_livros_emprestados'] > 0) {
                $quant_livros_emprestados = $row['quant_livros_emprestados'];
            }

                return $quant_livros_emprestados;

        }      

    }

    public function ConfirmarEntregaLivros($idEmprestimo)
    {
        $data_atual_orig = new DateTime("now", new DateTimeZone('America/Sao_Paulo') );  
        //$data_atual = $data_atual_orig->format('Y-m-d');
        //$hota_atual = $data_atual_orig->format('H:i:s');
        $data_atual = date('Y-m-d');
        $hora_atual = date('H:i:s');   

        $this->query = "UPDATE EMPRESTIMOS SET data_locacao = '".$data_atual."',
                                               hora_locacao = '".$hora_atual."'
                        WHERE idemprestimo = '".$idEmprestimo."'";

        if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

          header('Location: ../../views/emprestimos/index.php?alert=1');

        } else{

          header('Location: ../../views/emprestimos/index.php?alert=0');

        }

    }

    public function ConfirmarDevolucaoLivros($idEmprestimo)
    {
        $data_atual_orig = new DateTime("now", new DateTimeZone('America/Sao_Paulo') );  
        $data_atual = date('Y-m-d');
        $hora_atual = date('H:i:s');

        $this->query = "UPDATE EMPRESTIMOS SET data_devolucao = '".$data_atual."',
                                               hora_devolucao = '".$hora_atual."'
                        WHERE idemprestimo = '".$idEmprestimo."'";

        if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){

          header('Location: ../../views/emprestimos/index.php?alert=1');

        } else{

          header('Location: ../../views/emprestimos/index.php?alert=0');

        }

    }    

 }

$emprestimos = new Emprestimos;