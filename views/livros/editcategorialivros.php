<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/categoriaslivros.class.php';

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

if ($_SESSION['permissoes']['administrar_livros'] != 1) {
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

echo '
            <!-- /.card -->

  <br>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Categoria Livros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item"><a href="categoriaslivros.php">Categorias Livros</a></li>
              <li class="breadcrumb-item active">Editar Categoria Livros</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>
    ';

    if (isset($_GET['id'])) {
      $resp = $categoriaslivros->EditCategoriaLivros($_GET['id']); 

    echo '
            <!-- Horizontal Form -->
            <div class="d-flex justify-content-center">
            <div class="col-md-6 ">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Categoria Livros</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="20" class="form-control" name="categoria" id="categoria" placeholder="Categoria" value="'.$resp['categoria'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ativo" class="col-sm-2 col-form-label">Ativo</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control-border" id="ativo" name="ativo">
                         <option value="0">Não</option>
                         <option value="1">Sim</option>
                     </select>
                    </div>
                  </div> 
                     <script>
                      function setValueList(id, value) {
                        document.getElementById(id).value=value;
                      }
                      setValueList("ativo", '.$resp['ativo'].');
                     </script>                  
                  <input type="hidden" id="iduser" name="iduser" value="'.$idUsuario.'">
                  <input type="hidden" id="idcategoria" name="idcategoria" value="'.$resp['idcategoria'].'">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a type="submit" name="update" value="updatecategorialivro" class="btn btn-info btn-update_categoria_livros">Salvar Modificações</a>
                  <a href="categoriaslivros.php" type="submit" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->
            </div>
            </div>
            </div>';
        };//if
            echo '
            <!-- /.card -->
';

echo '</div>';

//Modal Edição Categoria Livros Sucesso
echo '
      <div class="modal fade" id="modalCategoriaLivrosEditSuccess">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fa fa-check-circle fa-6x text-success"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloCategoriaLivrosEditSuccess"></h3>
                    <p class="text-muted text-center" id="mensagemCategoriaLivrosEditSuccess"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-center">
              <a href="categoriaslivros.php" type="submit" class="btn btn-block btn-success btn-ok_categoria_livros_update">OK</a>
            </div>
          </div>
        </div>
      </div>
';

echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

echo '
  <script src="../../App/js/categorialivros.js"></script>
';

echo $Scripts->GetJavaScript("../", "final");

?>