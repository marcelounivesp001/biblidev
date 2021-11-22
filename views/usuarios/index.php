<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/usuarios.class.php';

echo $Scripts->GetHead("../", "inicio");

  //Espaço para adicionar Links em geral
 
echo '
      <!-- DataTables -->
      <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     ';

echo '
      <style> 
        .dataTables_filter {
          display:none;
        }
      </style>
';       

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


echo '          <!-- /.card -->
  <br>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuários</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active">Usuários</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>
    <!-- daqui -->
      <section class="content">
        <div class="container-fluid">
        <div class="row">
      <!--  até daqui -->
        <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Usuários</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 135px;">
                        <div class="box-footer clearfix no-border">
                            <a href="addusuario.php" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Usuario </a>
                        </div>
                  </div>
                </div>                
              </div>
              
              <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable_default">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th>Tp. Usuário</th>
                      <th>Sexo</th>
                      <th>E-mail</th>
                      <th>Rua</th>
                      <th>Nº</th>
                      <th>Comp.</th>
                      <th>Bairro</th>
                      <th>Estado</th>
                      <th>Cidade</th>
                      <th>Ativo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot style="display: table-header-group;">
                    <tr>
                      <th>ID</th>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th>Tp. Usuário</th>
                      <th>Sexo</th>
                      <th>E-mail</th>
                      <th>Rua</th>
                      <th>Nº</th>
                      <th>Comp.</th>
                      <th>Bairro</th>
                      <th>Estado</th>
                      <th>Cidade</th>
                      <th>Ativo</th>
                      <th></th>
                    </tr>
                  </tfoot>                    
                  <tbody>';
                   

                   $resp_json = $usuarios->index();
                   $resp_array = json_decode($resp_json, true);

                  foreach ($resp_array as $row) {

                    if (isset($row['iduser']) != NULL) {

                        $ativo = $row['ativo'] == '1' ? "Sim" : "Não";

                        //Identificar se é o usuário que está logado
                        if ($row['iduser'] == $idUsuario) {
                        
                        echo '<tr>';
                        echo '<td><strong>'.$row['iduser'].'</strong></td>';
                        echo '<td><strong>'.$row['cpf'].'</strong></td>';
                        echo '<td><strong>'.$row['nome'].' '.$row['sobrenome'].'</strong></td>';
                        echo '<td><strong>'.$row['tipo_usuario'].'</strong></td>';
                        echo '<td><strong>'.$row['sexo'].'</strong></td>';
                        echo '<td><strong>'.$row['email'].'</strong></td>';
                        echo '<td><strong>'.$row['rua'].'</strong></td>';
                        echo '<td><strong>'.$row['num'].'</strong></td>';
                        echo '<td><strong>'.$row['complemento'].'</strong></td>';
                        echo '<td><strong>'.$row['bairro'].'</strong></td>';
                        echo '<td><strong>'.$row['estado'].'</strong></td>';
                        echo '<td><strong>'.$row['cidade'].'</strong></td>';
                        echo '<td><strong>'.$ativo.'</strong></td>';
                        echo '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="editusuario.php?id='.$row['iduser'].'" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                  <a data-id="'.$row['iduser'].'" class="btn btn-danger btn-delete_usuario"><i class="fas fa-trash"></i></a>
                                  <!-- <a href="../../App/Database/deleteusuario.php?id='.$row['iduser'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->

                                </div>
                              </td>';
                        echo '</tr>';

                      } else {
                        
                        echo '<tr>';
                        echo '<td>'.$row['iduser'].'</td>';
                        echo '<td>'.$row['cpf'].'</td>';
                        echo '<td>'.$row['nome'].' '.$row['sobrenome'].'</td>';
                        echo '<td>'.$row['tipo_usuario'].'</td>';
                        echo '<td>'.$row['sexo'].'</td>';
                        echo '<td>'.$row['email'].'</td>';
                        echo '<td>'.$row['rua'].'</td>';
                        echo '<td>'.$row['num'].'</td>';
                        echo '<td>'.$row['complemento'].'</td>';
                        echo '<td>'.$row['bairro'].'</td>';
                        echo '<td>'.$row['estado'].'</td>';
                        echo '<td>'.$row['cidade'].'</td>';
                        echo '<td>'.$ativo.'</td>';
                        echo '<td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                  <a href="editusuario.php?id='.$row['iduser'].'" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                  <a data-id="'.$row['iduser'].'" class="btn btn-danger btn-delete_usuario"><i class="fas fa-trash"></i></a>
                                  <!-- <a href="../../App/Database/deleteusuario.php?id='.$row['iduser'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->

                                </div>
                              </td>';
                        echo '</tr>';

                      }

                    };

                  };

                          echo '
                  </tbody>
                </table>

';

echo'                
              </div>
              <!-- /.card-body -->             
            </div>
            </div>
            <!-- daqui -->
            </div>
            </div>
            </section>
            <!-- até daqui -->
            <!-- /.card -->';             
 
echo '</div>';


//Modal Deletar Usuário
echo '
      <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <section class="content">
                <div class="justify-content">
                  <div class="modal-body text-center">
                    <i class="fas fa-trash-alt fa-4x text-danger"></i>
                  </div>
                  <div>
                    <h3 class="text-center" id="tituloDelete"></h3>
                    <p class="text-muted text-center" id="mensagemDelete"></p>
                  </div>
                </div>              
              </section>
            </div>
            <div class="modal-footer justify-content-between">
              <a type="submit" class="btn btn-info" data-dismiss="modal">Cancelar</a>
              <a id="deleteYes" type="submit" class="btn btn-danger btn-delete_user_yes">Deletar</a>
            </div>
          </div>
        </div>
      </div>
';

echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

echo '
    <script src="../../App/js/deleteModals.js"></script>
    ';

echo '
      <!-- DataTables  & Plugins -->
      <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="../plugins/jszip/jszip.min.js"></script>
      <script src="../plugins/pdfmake/pdfmake.min.js"></script>
      <script src="../plugins/pdfmake/vfs_fonts.js"></script>
      <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      
      <!-- Page specific script -->
      <script>
        $(function () {

    // Setup - add a text input to each footer cell
    $(\'#datatable_default tfoot th\').each( function () {
        var title = $(this).text();
        if (title != ""){
          $(this).html( \'<input type="text" placeholder="Buscar \'+title+\'" />\' );    
        }
    } );


          $("#datatable_default").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

    "columns" : [
        {"visible" : false },
        null,
        null,
        null,
        {"visible" : false },
        null,
        null,
        null,
        {"visible" : false },
        {"visible" : false },
        {"visible" : false },
        {"visible" : false },
        {"visible" : false },
        null
    ],



            initComplete: function () {
    // Apply the search
    this.api().columns().every( function () {
        var that = this;
        $( \'input\', this.footer() ).on( \'keyup change clear\', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
}


          }).buttons().container().appendTo(\'#datatable_default_wrapper .col-md-6:eq(0)\');
          $(\'#example2\').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script> 
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