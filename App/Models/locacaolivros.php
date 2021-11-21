<?php 

session_start();

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

$search = $PostFilters['filter'];
$divReturn = "";

$listaLivrosFiltrados = filtrarLivros($_SESSION['LIVROS'], $search);

foreach ($listaLivrosFiltrados as $row) {
		
  $divReturn .= ' 
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="ty-01">
              <!-- <form method="POST"> -->
              <div class="card bg-light d-flex flex-fill">
                
                     
                <div class="card-header text-muted border-bottom-0">
                  <h2>'.$row['titulo'].'</h2>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-7">
                      <input name="tituloLivro" id="tituloLivro" class="card-title" type="hidden" value="'.$row['titulo'].'"/>
                      <h2 class="lead"><b>ISBN:</b> '.$row['isbn'].'</h2>
                      <h1 class="text-muted text-sm"><b>Genero:</b> Comédia </h1>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-users"></i></i></span><b>Autor(es):</b> '.$row['autores'].'</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Editora:</b> '.$row['editora'].'</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-layer-group"></i></span> <b>Edição:</b> '.$row['edicao'].'</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-globe-americas"></i></span> <b>Ano:</b> '.$row['ano_publicacao'].'</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-file"></i></span> <b>Páginas: </b>'.$row['paginas'].'</li>
                      </ul>
                    </div>
                    <div class="col-4 text-center">
                      <img src="../dist/img/livro-280x280.jpg" alt="user-avatar" class="img-circle img-fluid">
                      <!--<img src="../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-square img-fluid">-->
                      <input name="idlivro" id="idlivro" type="hidden" value="'.$row['idlivro'].'"/>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  <!--
                    <a href="?infoid='.$row['idlivro'].'" class="btn btn-sm bg-teal">
                      <i class="fas fa-info-circle"></i> Infos
                    </a>
                  -->
                    <a class="btn btn-sm btn-primary bt-add" data-id="'.$row['idlivro'].'" data-isbn="'.$row['isbn'].'" data-titulo="'.$row['titulo'].'"><i class="fas fa-cart-plus"></i> Adicionar </a>
                  </div>
                </div>
              


                </div>
              </div> 
            </div>

        ';
    }

$message = $divReturn;	
echo json_encode($message);

function filtrarLivros($listaLivros, $search){

	$listaLivrosFilter = array();
	if (!empty($search)) {
		foreach ($listaLivros as $row) {
			if (isset($row['titulo'])) {
				$tituloMaiusc = strtoupper($row['titulo']);
				$searchMaiusc = strtoupper($search);
				if (strpos($tituloMaiusc, $searchMaiusc) !== false) {
					$listaLivrosFilter[] = $row;
				 }
			}
		}
	} else {
		foreach ($listaLivros as $row) {
			if (isset($row['titulo'])) {
				$listaLivrosFilter[] = $row;
			}
		}		
	}

	return $listaLivrosFilter;
};