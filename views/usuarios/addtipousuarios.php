
<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';

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

        if ($_SESSION['permissoes']['administrar_usuarios'] != 1) {
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
            <h1>Adicionar Tipo Usuários</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item"><a href="tiposusuario.php">Tipos Usuários</a></li>
              <li class="breadcrumb-item active">Adicionar Tipo Usuários</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>
    ';

    echo '
            <!-- Horizontal Form -->
            <div class="d-flex justify-content-center">
            <div class="col-md-6 ">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Tipo Usuários</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="tipo_usuario" class="col-sm-5 col-form-label">Tipo Usuários*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="20" class="form-control" name="tipo_usuario" id="tipo_usuario" placeholder="Tipo Usuários">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="administrar_usuarios" class="col-sm-5 col-form-label">Administrar Usuários*</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control-border" id="administrar_usuarios" name="administrar_usuarios">
                         <option value="0">Não</option>
                         <option value="1">Sim</option>
                     </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="administrar_livros" class="col-sm-5 col-form-label">Administrar Livros*</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control-border" id="administrar_livros" name="administrar_livros">
                         <option value="0">Não</option>
                         <option value="1">Sim</option>
                     </select>
                    </div> 
                  </div> 
                  <div class="form-group row">
                    <label for="administrar_emprestimos" class="col-sm-5 col-form-label">Administrar Empréstimos*</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control-border" id="administrar_emprestimos" name="administrar_emprestimos">
                         <option value="0">Não</option>
                         <option value="1">Sim</option>
                     </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="limite_livros_emprestimo" class="col-sm-5 col-form-label">Limite Livros Empréstimo*</label>
                    <div class="col-sm-12">
                      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
                            maxlength = "3" class="form-control" id="limite_livros_emprestimo" name="limite_livros_emprestimo" placeholder="Limite Livros Empréstimo">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="limite_dias_emprestimo" class="col-sm-5 col-form-label">Limite Dias Empréstimo*</label>
                    <div class="col-sm-12">
                      <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number"
                            maxlength = "3" class="form-control" id="limite_dias_emprestimo" name="limite_dias_emprestimo" placeholder="Limite Livros Empréstimo">
                    </div>
                  </div>                                    
                  <input type="hidden" name="iduser" value="'.$idUsuario.'">
                  <p class="text-muted text-center"><strong>Campos com "*" são obrigatórios</strong></p>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a type="submit" name="create" value="createtipousuarios" class="btn btn-info btn-create_tipo_usuarios">Salvar Modificações</a>
                  <a href="tiposusuario.php" type="submit" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->
            </div>
            </div>
            </div>';

            echo '
            <!-- /.card -->
';

echo '</div>';

//Modal Criação Usuário Sucesso
echo '
      <div class="modal fade" id="modalTipoUsuarioCreateSuccess">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fa fa-check-circle fa-6x text-success"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloTipoUsuarioCreateSuccess"></h3>
                    <p class="text-muted text-center" id="mensagemTipoUsuarioCreateSuccess"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-center">
              <a href="tiposusuario.php" type="submit" class="btn btn-block btn-success btn-ok_tipo_usuario_create">OK</a>
            </div>
          </div>
        </div>
      </div>
';

echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

echo '
  <script src="../../App/js/tiposusuarios.js"></script>
';

echo $Scripts->GetJavaScript("../", "final");  

?>