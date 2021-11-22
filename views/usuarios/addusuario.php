<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/tiposusuarios.class.php';

$resp_tipos_usuario_json = $tiposUsuarios->GetTiposUsuarios();  
$resp_tipos_usuario_array = json_decode($resp_tipos_usuario_json, true);

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
          echo '<div class="card-body">
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

  <br>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Adicionar Usuário</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php">Usuários</a></li>
              <li class="breadcrumb-item active">Adicionar Usuário</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <br>

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
                <input type="text" id="login_usuario" name="login_usuario" maxlength="15" placeholder="Usuário" class="form-control">
              </div>
              <div class="form-group">
                <label for="login_senha">Senha Login*</label>
                <div class="input-group mb-3">
                  <input type="password" id="login_senha" name="login_senha" placeholder="Senha" maxlength="15" class="form-control">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <a type="submit" onclick="ShowHidePassword()" class="btn-show_pass"> <span class="fas fa-lock"></span> </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="login_idtipo_usuario" class="col-sm-2 col-form-label">Tipo Usuário*</label>
                <div class="col-sm-12">
                  <select class="custom-select form-control-border" id="login_idtipo_usuario" name="login_idtipo_usuario">
                    <option value="">
                    </option>';
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
          </div>
        </div>

        <div class="col-md-6 ">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Usuário</h3>
            </div>  
            <div class="card-body">
              <div class="form-group">
                <label for="cpf" class="col-sm-2 col-form-label">CPF*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="14" class="form-control" name="cpf" id="cpf" placeholder="CPF">
                </div>
              </div>
              <div class="form-group">
                <label for="nome" class="col-sm-2 col-form-label">Nome*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="30" class="form-control" name="nome" id="nome" placeholder="Nome">
                </div>
              </div>
              <div class="form-group">
                <label for="sobrenome" class="col-sm-2 col-form-label">Sobrenome*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="70" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome">
                </div>
              </div>  
              <div class="form-group">
                <label for="data_nascimento" class="col-sm-5 col-form-label">Data Nascimento*</label>
                <div class="col-sm-12">
                  <input type = "date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data Nascimento">
                </div>
              </div>
              <div class="form-group">
                <label for="sexo" class="col-sm-2 col-form-label">Sexo*</label>
                <div class="col-sm-12">
                  <select class="custom-select form-control-border" name="sexo" id="sexo">
                    <option value=""></option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 col-form-label">E-mail*</label>
                <div class="col-sm-12">
                  <input type="mail" maxlength="90" class="form-control" id="email" name="email" placeholder="E-mail">
                </div>
              </div>
              <div class="form-group">
                <label for="cep" class="col-sm-2 col-form-label">CEP*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength = "9" class="form-control" id="cep" name="cep" placeholder="CEP">
                </div>
              </div>
              <div class="form-group">
                <label for="rua" class="col-sm-2 col-form-label">Rua*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="70" class="form-control" id="rua" name="rua" placeholder="Rua">
                </div>
              </div>
              <div class="form-group">
                <label for="num" class="col-sm-2 col-form-label">Nº*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="10" class="form-control" id="num" name="num" placeholder="Nº">
                </div>
              </div>           
              <div class="form-group">
                <label for="complemento" class="col-sm-2 col-form-label">Comp.</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="10" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                </div>
              </div>  
              <div class="form-group">
                <label for="bairro" class="col-sm-2 col-form-label">Bairro*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="60" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                </div>
              </div>  
              <div class="form-group">
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
              <div class="form-group">
                <label for="cidade" class="col-sm-2 col-form-label">Cidade*</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="50" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                </div>
              </div>                                                                              
              <input type="hidden" name="iduser" value="'.$idUsuario.'">
              <p class="text-muted text-center"><strong>Campos com "*" são obrigatórios</strong></p>
            </div>
            <div class="card-footer">
              <a type="submit" name="create" value="createuser" class="btn btn-info btn-add_usuario">Adicionar</a>
              <a href="index.php" type="submit" class="btn btn-default float-right">Cancelar</a>
            </div>
          </div>
        </div>
      </div>
    </section>
';

echo '</div>';

//Modal Criação Usuário Sucesso
echo '
      <div class="modal fade" id="modalUserCreateSuccess">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fa fa-check-circle fa-6x text-success"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloUserCreateSuccess"></h3>
                    <p class="text-muted text-center" id="mensagemUserCreateSuccess"></p>
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
  <script src="../../App/js/usuario.js"></script>
';

echo $Scripts->GetJavaScript("../", "final");