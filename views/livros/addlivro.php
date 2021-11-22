<?php 

require_once '../../App/auth.php'; 
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/categoriaslivros.class.php';

$resp_categorias_livros_json = $categoriaslivros->GetCategoriasLivro();
$resp_categorias_livros_array = json_decode($resp_categorias_livros_json, true);

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
            <h1>Adicionar Livro</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php">Livros</a></li>
              <li class="breadcrumb-item active">Adicionar Livro</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>
            <!-- Horizontal Form -->
            <div class="d-flex justify-content-center">
            <div class="col-md-6 ">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Livro</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="isbn" class="col-sm-2 col-form-label">ISBN*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="20" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="titulo" class="col-sm-2 col-form-label">Título*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="120" class="form-control" name="titulo" id="titulo" placeholder="Título">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="autores" class="col-sm-2 col-form-label">Autores*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="120" class="form-control" name="autores" id="autores" placeholder="Autores">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="ano_publicacao" class="col-sm-2 col-form-label">Ano</label>
                    <div class="col-sm-12">
                      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
                            maxlength = "4" class="form-control" id="ano_publicacao" name="ano_publicacao" placeholder="Ano Publicacao">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="edicao" class="col-sm-2 col-form-label">Edição</label>
                    <div class="col-sm-12">
                      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
                            maxlength = "2" class="form-control" id="edicao" name="edicao" placeholder="Edição">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="editora" class="col-sm-2 col-form-label">Editora</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="120" class="form-control" id="editora" name="editora" placeholder="Editora">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="paginas" class="col-sm-2 col-form-label">Páginas</label>
                    <div class="col-sm-12">
                      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
                            maxlength = "4" class="form-control" id="paginas" name="paginas" placeholder="Páginas">
                    </div>
                  </div>
                <!--
                  <div class="form-group row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoria*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="60" class="form-control" id="categoria" name="categoria" placeholder="Categoria">
                    </div>
                  </div>
                  --> 
                  <div class="form-group row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoria*</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control-border" id="categoria" name="categoria">
                            <option value=""></option>';
                      foreach ($resp_categorias_livros_array as $row) {

                          if (isset($row['idcategoria']) != NULL) {

                            echo'
                                <option value="'.$row['idcategoria'].'">'.$row['categoria'].'</option>
                                ';
                          }

                      }

                      echo'
                     </select>
                    </div>
                  </div> 
                                    
                  <div class="form-group row">
                    <label for="quantidade" class="col-sm-2 col-form-label">Quantidade*</label>
                    <div class="col-sm-12">
                      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
                            maxlength = "3" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade">
                    </div>
                  </div>
                  <input type="hidden" name="iduser" id="iduser" value="'.$idUsuario.'">
                  <p class="text-muted text-center"><strong>Campos com "*" são obrigatórios</strong></p>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a type="submit" name="create" value="createbook" class="btn btn-info btn-add_livro">Adicionar</a>
                  <a href="index.php" type="submit" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->
            </div>
            </div>
            </div>
            <!-- /.card -->
';

echo '</div>';

//Modal Criação Livro Sucesso
echo '
      <div class="modal fade" id="modalLivroCreateSuccess">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fa fa-check-circle fa-6x text-success"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloLivroCreateSuccess"></h3>
                    <p class="text-muted text-center" id="mensagemLivroCreateSuccess"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-center">
              <a href="index.php" type="submit" class="btn btn-block btn-success btn-ok_user_create">OK</a>
            </div>
          </div>
        </div>
      </div>
';

echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

echo'
  <script src="../../App/js/livros.js"></script>
';

echo $Scripts->GetJavaScript("../", "final");

?>