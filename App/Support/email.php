<?php

    $localhost = "localhost";
    $root = "root";
    $passwd = "";
    $database = "biblidev";
    $SQL;

    $SQL = mysqli_connect($localhost, $root, $passwd);
    mysqli_select_db($SQL, $database);
    if(!$SQL){
      die("Conexão com o banco de dados falhou!:" . mysqli_connect_error($SQL)); 
    }

    function GetEmprestimosSemDevolucao($SQL){

        $query = "SELECT a.idemprestimo, 
                               a.iduser, 
                               a.data_locacao, 
                               a.hora_locacao, 
                               a.data_devolucao, 
                               a.hora_devolucao, 
                               b.nome, 
                               b.sobrenome,
                               b.email,
                               d.limite_dias_emprestimo
                        FROM EMPRESTIMOS AS a 
                        JOIN USUARIOS AS b ON b.iduser = a.iduser
                        JOIN LOGIN AS c ON c.iduser = a.iduser
                        JOIN TIPOS_USUARIO AS d ON d.idtipo_usuario = c.idtipo_usuario 
                        WHERE a.data_locacao is not null
                          and a.data_devolucao is null
                          and b.email is not null
                          and a.delrg = '0'";

        $result = mysqli_query($SQL, $query) or die ( mysqli_error($SQL));

        if($result){
        
            while ($row[] = mysqli_fetch_array($result)); 
            return json_encode($row);
            
        }        

    }

	
	 //Variáveis
  	 $nome = "Maluhy BibliDev";
  	 $email = "maluly.biblidev@gmail.com";
  	 $data_envio = date('d/m/Y');
  	 $hora_envio = date('H:i:s');
  	 $destino = "";
  	 $assunto = "";

  	 //Este sempre deverá existir para garantir a exibição correta dos caracteres
  	 $headers  = "MIME-Version: 1.0\n";
  	 $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  	 $headers .= "From: $nome <$email>";

  	 //Buscar Emprestimos Aguardando Devolução
	   $resp_json = GetEmprestimosSemDevolucao($SQL);
     $resp_array = json_decode($resp_json, true);

      foreach ($resp_array as $row) {

       	$destino = "";
       	$assunto = "";
       	$corpo_email = "";

         if (isset($row['idemprestimo']) != NULL) {

          $limite_dias_emprestimo = isset($row['limite_dias_emprestimo']) ? $row['limite_dias_emprestimo'] : 0;
          $start = strtotime($row['data_locacao']);
          $end = time();
          $days_between = ($end - $start);
          $days_between_converted = round($days_between / (60*60*24));
          $days_to_back = $limite_dias_emprestimo - $days_between_converted;

          $nome = $row['nome']." ".$row['sobrenome'];
          $data_locacao = $row['data_locacao'];

          if ($days_to_back < 0) {

          	$assunto = "Maluhy Biblidev - Devolução de Livros Atrasada";
           	$corpo_email = "
  						<html>
  						  <p>Sr(a). <b>$nome</b> este é um aviso de que sua devolucão dos livros locados no dia $data_locacao está vencida.</p>
  						  <p><b>Favor realizar a devolucão dos mesmos na Biblioteca Maluhy.</b></p>
  						  <p>Atenciosamente</p>
  						  <p><b>Maluhy BibliDev</b></p>
                <p>Este é um e-mail automático. <b>Não responda este e-mail.</b></p>
  						 </html>
  						"; 


          } else if ($days_to_back == 0) {

           	$assunto = "Maluhy Biblidev - Devolução Livros";
           	$corpo_email = "
  						<html>
  						  <p>Sr(a). <b>$nome</b> este é um lembrete de que a data limite para devolucão dos livros locados no dia $data_locacao é hoje.</p>
  						  <p>Atenciosamente</p>
  						  <p><b>Maluhy BibliDev</b></p>
                <p>Este é um e-mail automático. <b>Não responda este e-mail.</b></p>
  						 </html>
  						";                      	

          } else if ($days_to_back <= 5) {
           	
           	$assunto = "Maluhy Biblidev - Lembrete Devolução Livros";
           	$corpo_email = "
  						<html>
  						  <p>Sr(a). <b>$nome</b> este é um aviso de que faltam <b>$days_to_back dias</b> para a data de devolucão dos livros locados no dia $data_locacao.</p>
  						  <p>Atenciosamente</p>
  						  <p><b>Maluhy BibliDev</b></p>
                <p>Este é um e-mail automático. <b>Não responda este e-mail.</b></p>
  						 </html>
  						";

          } 

     		if (!empty($corpo_email)) {

     			$destino = $row['email']; 

     			//Enviar E-mail
  				$status = mail($destino, $assunto, $corpo_email, $headers);
  				 
     		
     		} 

         } 

    }

?>