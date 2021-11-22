<?php 

require_once '../App/auth.php';
require_once '../App/Models/usuarios.class.php';
require_once '../App/Classes/script.class.php';

echo $Scripts->GetHead("", "inicio");
  
  //Espaço para adicionar Links em geral

echo $Scripts->GetHead("", "final");

echo $Scripts->GetNavBar("");

echo $Scripts->GetAsideInicio("");

//Verificações de Permissão
if ($_SESSION['permissoes']['limite_livros_emprestimo'] > 0) {
  echo $Scripts->GetAsideLocacao("");
}

if ($_SESSION['permissoes']['administrar_usuarios'] == 1) {
  echo $Scripts->GetAsideUsuario("");  
}

if ($_SESSION['permissoes']['administrar_livros'] == 1) {
  echo $Scripts->GetAsideLivros("");
}

if ($_SESSION['permissoes']['administrar_emprestimos'] == 1) {
  echo $Scripts->GetAsideEmprestimos("");
}

echo $Scripts->GetAsideFinal("");
echo '<div class="content-wrapper">';

echo '
            <!-- /.card -->

  <br>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Informações Usuário</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Informações Usuário</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>

        ';

    if (isset($_SESSION['idUsuario'])) {
      $resp = $usuarios->GetUsuario($_SESSION['idUsuario']);
      $nome = $resp['nome']." ".$resp['sobrenome'];
      $imagemUser = $_SESSION['permissoes']['administrar_livros'] == 1 ? 'admin.png' : 'user.jpg';

    echo '

            <!-- Horizontal Form -->
            <section class="content">
            <!-- <form class="form-horizontal" role="form" action="../../App/Database/insertusuario.php" method="POST"> -->
            <div class="row">



<div class="col-md-6">


            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/'.$imagemUser.'"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">'.$nome.'</h3>

                <p class="text-muted text-center">Informações Usuário</p>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->











  <div class="card card-secondary card-outline">
    <div class="card-body">
      <div class="form-group">
        <label for="login_usuario">Usuário</label>
        <input type="text" id="login_usuario" name="login_usuario" maxlength="15" placeholder="Usuário" class="form-control" readonly value="'.$resp['login_usuario'].'">
      </div>
      <!--
      <div class="form-group">
        <label for="login_senha">Senha Login</label>
        <input type="password" id="login_senha" name="login_senha" placeholder="Senha" maxlength="15" class="form-control">
      </div>
      -->




    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>











            <div class="col-md-6 ">
            <div class="card card-primary card-outline">
            <!--
              <div class="card-header">
                <h3 class="card-title">Usuário</h3>                
              </div>
              -->
              <!-- /.card-header -->


              <!-- form start -->
              
                <div class="card-body">
                  <div class="form-group row">
                    <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="14" class="form-control" name="cpf" id="cpf" placeholder="CPF" readonly value="'.$resp['cpf'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="30" class="form-control" name="nome" id="nome" placeholder="Nome" readonly value="'.$nome.'">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="data_nascimento" class="col-sm-5 col-form-label">Data Nascimento</label>
                    <div class="col-sm-12">
                      <input type = "date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data Nascimento" readonly value="'.$resp['data_nascimento'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-12">
                      <input type="mail" maxlength="90" class="form-control" id="email" name="email" placeholder="E-mail" readonly value="'.$resp['email'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="cep" class="col-sm-2 col-form-label">CEP</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength = "9" class="form-control" id="cep" name="cep" placeholder="CEP" readonly value="'.$resp['cep'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rua" class="col-sm-2 col-form-label">Rua</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="70" class="form-control" id="rua" name="rua" placeholder="Rua" readonly value="'.$resp['rua'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="num" class="col-sm-2 col-form-label">Nº</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="10" class="form-control" id="num" name="num" placeholder="Nº" readonly value="'.$resp['num'].'">
                    </div>
                  </div>           
                  <div class="form-group row">
                    <label for="complemento" class="col-sm-2 col-form-label">Comp.</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="10" class="form-control" id="complemento" name="complemento" placeholder="Complemento" readonly value="'.$resp['complemento'].'">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="bairro" class="col-sm-2 col-form-label">Bairro</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="60" class="form-control" id="bairro" name="bairro" placeholder="Bairro" readonly value="'.$resp['bairro'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="60" class="form-control" id="estado" name="estado" placeholder="Estado" readonly value="'.$resp['estado'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="50" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly value="'.$resp['cidade'].'">
                    </div>
                  </div>               
                </div>
                <!-- /.card-body -->
                <!--
                <div class="card-footer">
                  <button type="submit" name="update" value="updateuser" class="btn btn-info">Salvar Modificações</button>
                  <button type="submit" class="btn btn-default float-right">Cancelar</button>
                </div>
                -->
                <!-- /.card-footer -->

              
            </div>
            </div>
                        </div>
            <!-- </form> -->
            </section>';
                };//if
      echo '
            <!-- /.card -->
';

echo '</div>';

echo $Scripts->GetFooter("");

echo $Scripts->GetJavaScript("", "inicio");
  
  //Espaço para adicionar Scripts

echo $Scripts->GetJavaScript("", "final");

?>