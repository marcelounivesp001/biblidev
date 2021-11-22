<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/usuarios.class.php';
require_once '../../App/Models/tiposusuarios.class.php';

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

  //Espaço para adicionar Links em geral

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
            <h1>Editar Usuário</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php">Usuários</a></li>
              <li class="breadcrumb-item active">Editar Usuário</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>

        ';
 
    if (isset($_GET['id'])) {
      $iduseredit = $_GET['id'];
      $resp = $usuarios->editUsuario($iduseredit);
      if(isset($resp['iduser']) != null ){
			   $resp_tipos_usuario_json = $tiposUsuarios->GetTiposUsuarios();  
			   $resp_tipos_usuario_array = json_decode($resp_tipos_usuario_json, true);
      }
      $login_usuario = isset($resp['login_usuario']) ? $resp['login_usuario'] : "";



    echo '

            <!-- Horizontal Form -->
            <section class="content">
            <div class="row">



<div class="col-md-6">
  <div class="card card-secondary">
    <div class="card-header">
      <h3 class="card-title">Login</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="login_usuario">Usuário Login*</label>
			<div class="input-group mb-3">
                <input type="text" id="login_usuario" name="login_usuario" maxlength="15" placeholder="Usuário" class="form-control" value="'.$login_usuario.'" disabled>
                	<span class="input-group-append">
                    	<button class="btn btn-outline-primary btn-modificar_usuario_login">Modificar</button>
                    </span>
			</div>	
				     	
      </div>
      <div class="form-group">
              <label for="login_senha">Senha Login*</label>
			<div class="input-group mb-3">
                <input type="password" id="login_senha" name="login_senha" placeholder="Senha" maxlength="15" class="form-control" value="123456789" disabled>
                	<span class="input-group-append">



            <div class="input-group-text">
              <a type="submit" onclick="ShowHidePassword()" class="btn-show_pass"> <span class="fas fa-lock"></span> </a>
            </div>                      
                    

                    	<button class="btn btn-outline-primary btn-modificar_senha_login">Modificar</button>
                    </span>
			</div>
	</div>			

                  <div class="form-group row">
                    <label for="login_idtipo_usuario" class="col-sm-2 col-form-label">Tipo Usuário*</label>
                    <div class="col-sm-12">
                      <select class="custom-select form-control-border" id="login_idtipo_usuario" name="login_idtipo_usuario">
                            <option value=""></option>';
                      foreach ($resp_tipos_usuario_array as $row) {

                          if (isset($row['idtipo_usuario']) != NULL) {

                            echo'
                                <option value="'.$row['idtipo_usuario'].'">'.$row['tipo_usuario'].'</option>
                                ';
                          }

                      }

                      echo'
                     </select>
                    </div>
                  </div> 






    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>











            <div class="col-md-6 ">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Usuário</h3>                
              </div>
              <!-- /.card-header -->


              <!-- form start -->
              
                <div class="card-body">
                  <div class="form-group row">
                    <label for="cpf" class="col-sm-2 col-form-label">CPF*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="14" class="form-control" name="cpf" id="cpf" placeholder="CPF" value="'.$resp['cpf'].'" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Nome*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="30" class="form-control" name="nome" id="nome" placeholder="Nome" value="'.$resp['nome'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="sobrenome" class="col-sm-2 col-form-label">Sobrenome*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="70" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome" value="'.$resp['sobrenome'].'">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="data_nascimento" class="col-sm-5 col-form-label">Data Nascimento*</label>
                    <div class="col-sm-12">
                      <input type = "date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data Nascimento" value="'.$resp['data_nascimento'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="sexo" class="col-sm-2 col-form-label">Sexo*</label>
                    <div class="col-sm-12">
                        <select class="custom-select form-control-border" id="sexo" name="sexo">
                           <option value=""></option>
                           <option value="M">Masculino</option>
                           <option value="F">Feminino</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail*</label>
                    <div class="col-sm-12">
                      <input type="mail" maxlength="90" class="form-control" id="email" name="email" placeholder="E-mail" value="'.$resp['email'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="cep" class="col-sm-2 col-form-label">CEP*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength = "9" class="form-control" id="cep" name="cep" placeholder="CEP" value="'.$resp['cep'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rua" class="col-sm-2 col-form-label">Rua*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="70" class="form-control" id="rua" name="rua" placeholder="Rua" value="'.$resp['rua'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="num" class="col-sm-2 col-form-label">Nº*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="10" class="form-control" id="num" name="num" placeholder="Nº" value="'.$resp['num'].'">
                    </div>
                  </div>           
                  <div class="form-group row">
                    <label for="complemento" class="col-sm-2 col-form-label">Comp.</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="10" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="'.$resp['complemento'].'">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="bairro" class="col-sm-2 col-form-label">Bairro*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="60" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="'.$resp['bairro'].'">
                    </div>
                  </div>  
                  <div class="form-group row">
                    <label for="estado" class="col-sm-2 col-form-label">Estado*</label>
                    <div class="col-sm-12">
                       <select class="custom-select form-control-border" id="estado" name="estado">
                           <option value=""></option>
                           <option value="AC">Acre</option>
                           <option value="AL">Alagoas</option>
                           <option value="AP">Amapá</option>
                           <option value="AM">Amazonas</option>
                           <option value="BA">Bahia</option>
                           <option value="CE">Ceará</option>
                           <option value="DF">Distrito Federal</option>
                           <option value="ES">Espírito Santo</option>
                           <option value="GO">Goiás</option>
                           <option value="MA">Maranhão</option>
                           <option value="MT">Mato Grosso</option>
                           <option value="MS">Mato Grosso do Sul</option>
                           <option value="MG">Minas Gerais</option>
                           <option value="PA">Pará</option>
                           <option value="PB">Paraíba</option>
                           <option value="PR">Paraná</option>
                           <option value="PE">Pernambuco</option>
                           <option value="PI">Piauí</option>
                           <option value="RJ">Rio de Janeiro</option>
                           <option value="RN">Rio Grande do Norte</option>
                           <option value="RS">Rio Grande do Sul</option>
                           <option value="RO">Rondônia</option>
                           <option value="RR">Roraima</option>
                           <option value="SC">Santa Catarina</option>
                           <option value="SP">São Paulo</option>
                           <option value="SE">Sergipe</option>
                           <option value="TO">Tocantins</option>
                           <option value="EX">Estrangeiro</option>
                       </select>                      
                    </div>
                  </div>     
                  <div class="form-group row">
                    <label for="cidade" class="col-sm-2 col-form-label">Cidade*</label>
                    <div class="col-sm-12">
                      <input type="text" maxlength="50" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="'.$resp['cidade'].'">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ativo" class="col-sm-2 col-form-label">Ativo*</label>
                    <div class="col-sm-12">
                        <select class="custom-select form-control-border" name="ativo" id="ativo">
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
                      setValueList("estado", "'.$resp['estado'].'");
                      setValueList("sexo", "'.$resp['sexo'].'");
                      setValueList("login_idtipo_usuario", "'.$resp['login_idtipo_usuario'].'")                  
                  </script>                                                                              
                  <input type="hidden" id="iduseredit" name="iduseredit" value="'.$iduseredit.'">
                  <input type="hidden" id="idloginedit" name="idloginedit" value="'.$resp['login_idlogin'].'">
                  <input type="hidden" id="iduser" name="iduser" value="'.$idUsuario.'">
                  <p class="text-muted text-center"><strong>Campos com "*" são obrigatórios</strong></p>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a type="submit" name="update" value="updateuser" class="btn btn-info btn-edit_usuario">Salvar Modificações</a>
                  <a href="index.php" type="submit" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->

              
            </div>
            </div>
                        </div>
            </section>';
                };//if
      echo '
            <!-- /.card -->
';

echo '</div>';

//Modal Edição Usuário Sucesso
echo '
      <div class="modal fade" id="modalUserEditSuccess">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fa fa-check-circle fa-6x text-success"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloUserEditSuccess"></h3>
                    <p class="text-muted text-center" id="mensagemUserEditSuccess"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-center">
              <a id="ok_user_edit" href="index.php" type="submit" class="btn btn-block btn-success btn-ok_user_edit">OK</a>
            </div>
          </div>
        </div>
      </div>
';


echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

echo '
  <script src="../../App/js/usuario.js"></script>
';

echo $Scripts->GetJavaScript("../", "final");

?>