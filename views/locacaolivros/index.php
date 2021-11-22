<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/livros.class.php';
require_once '../../App/Models/emprestimos.class.php';

echo $Scripts->GetHead("../", "inicio");

  //Espaço para adicionar Links em geral

echo $Scripts->GetHead("../", "final");

echo $Scripts->GetNavBar("../");

echo $Scripts->GetAsideInicio("../");

//Verificações de Permissão
if ($_SESSION['permissoes']['limite_livros_emprestimo'] > 0) {
  echo $Scripts->GetAsideLocacao("../");
}

if ($_SESSION['permissoes']['administrar_usuarios'] == 1) {
  echo $Scripts->GetAsideUsuario("../");  
}

if ($_SESSION['permissoes']['administrar_livros'] == 1) {
  echo $Scripts->GetAsideLivros("../");
}

if ($_SESSION['permissoes']['administrar_emprestimos'] == 1) {
  echo $Scripts->GetAsideEmprestimos("../");
}

echo $Scripts->GetAsideFinal("../");

echo '<div class="content-wrapper">';

if ($_SESSION['permissoes']['limite_livros_emprestimo'] <= 0) {
  echo ' <div class="card-body">
            <div class="callout callout-danger">
              <h5>Sem Autorização!</h5>
              <p>Você não possui autorização para acessar essa área do site.</p>
            </div>
          </div>';
        
  echo '</div>';

  echo $Scripts->GetFooter("../");

  echo $Scripts->GetJavaScript("../", "inicio");

    //Espaço para adicionar Scripts

  echo $Scripts->GetJavaScript("../", "final");

  exit();

};

$_SESSION['quant_livros_emprestados'] = $emprestimos->GetQuantLivrosEmprestimoUsuario($idUsuario);

$quantLivrosCesto = isset($_SESSION['cestolivros']) ? count($_SESSION['cestolivros']) : 0;  

echo '
    <!-- Content Header (Page header) -->
	 <div class="result"></div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Escolha de Livros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active">Escolha de Livros</li>
            </ol>
          </div>
        </div>

          <div class="row mb-1">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">


                <a class="btn btn-sm bg-teal bt-cestolivros"><i class="fas fa-shopping-basket"></i> Cesto Livros <span class="qnt" id="quant_livros_cesto"> ['.$quantLivrosCesto.']</span></a>

              ';

              echo '
              
              </li>
            </ol>
 
            <ol class="breadcrumb float-sm-none">
              <li class="breadcrumb-item">
                <div class="input-group mb-3">
                <input type="text" id="searchBook" name="table_search" class="form-control" style="min-width:500px;" placeholder="Busca por Título" onkeydown="searchBook()">

                <!--                 <input type="text" id="searchBook" name="table_search" class="form-control" style="min-width:500px;" placeholder="Busca por Título" onkeyup="searchBook()"> -->

                  <div class="input-group-append">
                    <div class="input-group-text">
                      <a type="submit" onclick="clearSearchBook()"> <span class="fas fa-times"></span> </a>
                    </div>
                  </div>
                  </div>
              ';

              echo '
              
              </li>
            </ol>

          </div>



        </div>
        <div class="pull-right">
                            
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0" id="listaLivrosEscolha">
          <div id="bookList" class="row ty-00">';

        $resp_json = $livros->GetLivrosLocacao();
        $resp_array = json_decode($resp_json, true);
        $_SESSION['LIVROS'] = array();

        foreach ($resp_array as $row) {

            if (isset($row['idlivro']) != NULL) {
            $quant_disponivel = $row['quantidade'] - $row['quant_locados'];

            if ($quant_disponivel > 0) {

              $_SESSION['LIVROS'][] = $row; 

        echo '
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

        };
      }
    }

          echo '
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="pagination">
          <li class="page-item previous-page disable"><a class="page-link" href="#">Prev</a></li>
          <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
          <li class="page-item dots"><a class="page-link" href="#">...</a></li>
          <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
          <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
          <li class="page-item dots"><a class="page-link" href="#">...</a></li>
          <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
          <li class="page-item next-page"><a class="page-link" href="#">Next</a></li>
        </div>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

';

//Modal Cesto de Livros
echo '
      <div class="modal fade" id="modalCestoLivros">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100">Cesto de Livros</h4>
              <button type="button" class="close" //data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <section class="content">
                <div class="card">
                  <div class="card-header text-center">
                    <h3 class="card-title w-100">Livros Selecionados</h3>
                  </div>
                  <div class="card-body p-01">

                  <span id="listaLivrosCesto"></span>

                  </div>
                </div>
              </section>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary btn-finalizar_cesto_livros">Finalizar Cesto</button>
            </div>
          </div>
        </div>
      </div>
';

//Modal Criação Reserva Sucesso
echo '
      <div class="modal fade" id="modalCriacaoReservaSuccess">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fa fa-check-circle fa-6x text-success"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloCriacaoReservaSuccess"></h3>
                    <p class="text-muted text-center" id="mensagemCriacaoReservaSuccess"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-center">
              <a href="../../index.php" type="submit" class="btn btn-block btn-success btn-ok_reserva_criada">OK</a>
            </div>
          </div>
        </div>
      </div>
';

//Modal Criação Reserva Erro
echo '
      <div class="modal fade" id="modalCriacaoReservaError">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fas fa-times-circle fa-6x text-danger"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloCriacaoReservaError"></h3>
                    <p class="text-muted text-center" id="mensagemCriacaoReservaError"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="submit" class="btn btn-block btn-danger" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
';

echo '</div>';

echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

echo '
    <script src="../../App/js/cesto.js"></script>
    <script src="../../App/js/locacaolivros.js"></script>
  ';  

echo $Scripts->GetJavaScript("../", "final");

if (isset($_GET['alert'])){
  if ($_GET['alert'] == 0) {
    echo '<script>alert("error", "&nbsp;Operação não efetuada tente novamente.")</script>'; 
  } else if ($_GET['alert'] == 1) {
    echo '<script>alert("success", "&nbsp;Operação realizada com sucesso!")</script>'; 
  } else {
    echo '<script>alert("warning", "&nbsp;Erro desconhecido.")</script>';
  }  ;
};

?>