<?php 

 require_once '../../App/auth.php';
 require_once '../../App/Models/emprestimos.class.php';

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

if ($PostFilters['identCall'] == 'viewCesto') {
	
    $seqLivro = 0;
    $tableBody = "";
    if (isset($_SESSION['cestolivros'])) {
    
    	foreach ($_SESSION['cestolivros'] as $key => $value) {
    			$seqLivro++;
    			$tableBody .='
    			    <tr>
    			        <td>
    			            '.$seqLivro.'
    			        </td>                    
    			        <td>
    			            '.$key.'
    			        </td>                    
    			        <td>
    			            <a>
    			                '.$value['titulo'].'
    			            </a>
    			            <br/>
    			            <small>
    			               '.$value['isbn'].'
    			            </small>
    			        </td>
    			        <td class="project-actions text-right">
    			            <a class="btn btn-danger btn-sm btn-del_livro_cesta" id="'.$key.'">
    			            	<i class="fas fa-trash"></i>
    			                	Delete
    			            </a>
    			        </td>
    			    </tr>';
    			};
    }

if ($tableBody != "") {

	$tableLivrosCesto = '<table class="table table-striped projects">
        		      		<thead>
        		      			<tr>
        		      				<th style="width: 1%">
        		      					#
        		      				</th>
        		      				<th style="width: 5%">
        		      					ID
        		      				</th>
        		      				<th style="width: 40%">
        		      					Livro
        		      				</th>
        		      				<th style="width: 10%">
        		      				</th>
        		      			</tr>
        		      		</thead>
        		      			<tbody>
									'.$tableBody.'
        		      			</tbody>
        		  		</table>';  	

	$message = [ 
				'value' => $tableLivrosCesto,
				'titulo' => '',
				'message'=> '',
				'status' => '',
				'redirect' => ''
				];

} else {

    		$tableBody ='
    		    <tr>
    		        <td class="text-center">
    		            Cesto Vazio
    		        </td>                    
    		    </tr>';

	$tableLivrosCesto = '<table class="table table-striped projects">
        		      		<thead>
        		      			<tr>
        		      				<th style="width: 100%">
        		      				</th>
        		      			</tr>
        		      		</thead>
        		      			<tbody>
									'.$tableBody.'
        		      			</tbody>
        		  		</table>';  	

	$message = [ 
				'value' => $tableLivrosCesto,
				'titulo' => '',
				'message'=> '',
				'status' => '',
				'redirect' => ''
				];	

};
                       	        			   

} else if ($PostFilters['identCall'] == 'addLivroCesto'){

	$idLivro = $PostFilters['idlivro'];
	$isbn = $PostFilters['isbn'];
	$titulo = $PostFilters['titulo'];
	
	//$limiteLivros = $_SESSION['permissoes']['limite_livros_emprestimo'];
	//$quant_livros_emprestados = $_SESSION['quant_livros_emprestados'];

	$limiteLivros = $_SESSION['permissoes']['limite_livros_emprestimo'] - $_SESSION['quant_livros_emprestados'];

	$livrosadicionados = isset($_SESSION['cestolivros']) ? count($_SESSION['cestolivros']) : 0;
	
	//Verificar se ainda pode adicionar livros
	if ($limiteLivros <= $livrosadicionados) {
	
		$message = [
					'value' => '',
					'titulo' => '',
					'message'=> "Limite de livros permitido atingido.",
					'status' => "warning",
					'redirect' => ""
				   ];	
	
	} else {
	
		if (!isset($_SESSION['cestolivros'][$idLivro])) {
	
					$_SESSION['cestolivros'][$idLivro] = [
														  "isbn" => $isbn,
											  			  "titulo" => $titulo];
			$message = [
						'value' => '['.count($_SESSION['cestolivros']).']',
						'titulo' => '',
						'message' => "Livro adicionado ao cesto.",
						'status' => "success",
						'redirect' => ""
					   ];
	
		} else {
	
			$message = [
						'value' => '',
						'titulo' => '',
						'message'=> "Livro já se encontra no cesto.",
						'status' => "warning",
						'redirect' => ""
					   ];
	
		};
	};

} else if ($PostFilters['identCall'] == 'deleteLivroCesto'){

	$idLivro = $PostFilters['idlivro'];
	unset($_SESSION['cestolivros'][$idLivro]);

    $seqLivro = 0;
    $tableBody = "";
    foreach ($_SESSION['cestolivros'] as $key => $value) {
    		$seqLivro++;
    		$tableBody .='
    		    <tr>
    		        <td>
    		            '.$seqLivro.'
    		        </td>                    
    		        <td>
    		            '.$key.'
    		        </td>                    
    		        <td>
    		            <a>
    		                '.$value['titulo'].'
    		            </a>
    		            <br/>
    		            <small>
    		               '.$value['isbn'].'
    		            </small>
    		        </td>
    		        <td class="project-actions text-right">
    		            <a class="btn btn-danger btn-sm btn-del_livro_cesta" id="'.$key.'">
    		            	<i class="fas fa-trash"></i>
    		                	Delete
    		            </a>
    		        </td>
    		    </tr>';
    		};

if ($tableBody != "") {

	$tableLivrosCesto = '<table class="table table-striped projects">
        		      		<thead>
        		      			<tr>
        		      				<th style="width: 1%">
        		      					#
        		      				</th>
        		      				<th style="width: 5%">
        		      					ID
        		      				</th>
        		      				<th style="width: 40%">
        		      					Livro
        		      				</th>
        		      				<th style="width: 10%">
        		      				</th>
        		      			</tr>
        		      		</thead>
        		      			<tbody>
									'.$tableBody.'
        		      			</tbody>
        		  		</table>';  	

	$message = [ 
				'value' => $tableLivrosCesto,
				'titulo' => '',
				'message'=> 'Livro deletado do cesto',
				'status' => 'success',
				'redirect' => ''
				];

} else {

    		$tableBody ='
    		    <tr>
    		        <td class="text-center">
    		            Cesto Vazio
    		        </td>                    
    		    </tr>';

	$tableLivrosCesto = '<table class="table table-striped projects">
        		      		<thead>
        		      			<tr>
        		      				<th style="width: 100%">
        		      				</th>
        		      			</tr>
        		      		</thead>
        		      			<tbody>
									'.$tableBody.'
        		      			</tbody>
        		  		</table>';  	

	$message = [ 
				'value' => $tableLivrosCesto,
				'titulo' => '',
				'message'=> 'Livro deletado do cesto',
				'status' => 'success',
				'redirect' => ''
				];	

};

} else if ($PostFilters['identCall'] == 'finalizarCestoLivros'){


	if (isset($_SESSION['cestolivros'])) {
	
	    if (!empty($_SESSION['cestolivros'])){
				
				$data_atual = date('Y-m-d'); 
				$hora_atual = date('H:i:s');     	
	
	      //Inserir Tabela Emprestimos   
	      $values_emprestimo = "'".$idUsuario."',
	                            '".$data_atual."',
	                            '".$hora_atual."'";
	
				$resp_json = $emprestimos->InsertEmprestimo($values_emprestimo, $_SESSION['cestolivros'], $idUsuario);                              
				$message = json_decode($resp_json, true);
			
				if ($message['status'] == 'success'){
					$_SESSION['cestolivros'] = array();
				}; 
	
	    } else {
	
				$message = [
					    'value' => '',
					    'titulo' => '',
					    'message'=> "Cesto de livros está vazio. Primeiro escolha seus livros.",
					    'status' => "warning",
					    'redirect' => ""
						   ];
	    };
	
	} else {
	
		$message = [
		 	    'value' => '',
		 	    'titulo' => '',
			    'message'=> "Cesto de livros não encontrado. Tente novamente.",
			    'status' => "warning",
			    'redirect' => ""
			   ];
	
	} 

}

echo json_encode($message);		