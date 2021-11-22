<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/tiposusuarios.class.php';

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


echo '          <!-- /.card -->
  <br>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tipos Usuários</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active">Tipos Usuários</li>
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
                <h3 class="card-title">Tipos Usuários</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 190px;">
                        <div class="box-footer clearfix no-border">
                            <a href="addtipousuarios.php" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Tipo Usuários </a>
                        </div>
                  </div>
                </div>                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable_default">
                  <thead>
                    <tr>
                      <th>ID Tipo Usuário</th>
                      <th>Tipo Usuário</th>
                      <th>Administrar Usuários</th>
                      <th>Administrar Livros</th>
                      <th>Administrar Empréstimos</th>
                      <th>Limite Livros Empréstimos</th>
                      <th>Limite Dias Empréstimos</th>
                      <th>Ativo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot style="display: table-header-group;">
                    <tr>
                      <th>ID Tipo Usuário</th>
                      <th>Tipo Usuário</th>
                      <th>Administrar Usuários</th>
                      <th>Administrar Livros</th>
                      <th>Administrar Empréstimos</th>
                      <th>Limite Livros Empréstimos</th>
                      <th>Limite Dias Empréstimos</th>
                      <th>Ativo</th>
                      <th></th>
                    </tr>
                  </tfoot>                    
                  <tbody>';

                  $resp_json = $tiposUsuarios->GetTiposUsuarios();
                  $resp_array = json_decode($resp_json, true);

                  foreach ($resp_array as $row) {

                    if (isset($row['idtipo_usuario']) != NULL) {

                      $ativo = $row['ativo'] == '1' ? "Sim" : "Não";
                      $administrar_usuarios = $row['administrar_usuarios'] == '1' ? "Sim" : "Não";
                      $administrar_livros = $row['administrar_livros'] == '1' ? "Sim" : "Não";
                      $administrar_emprestimos = $row['administrar_emprestimos'] == '1' ? "Sim" : "Não";

                      echo '<tr>';
                      echo '<td>'.$row['idtipo_usuario'].'</td>';
                      echo '<td>'.$row['tipo_usuario'].'</td>';
					            echo '<td>'.$administrar_usuarios.'</td>';
					            echo '<td>'.$administrar_livros.'</td>';
					            echo '<td>'.$administrar_emprestimos.'</td>';
                      echo '<td>'.$row['limite_livros_emprestimo'].'</td>';
                      echo '<td>'.$row['limite_dias_emprestimo'].'</td>';
                      echo '<td>'.$ativo.'</td>';
                      echo '
                 <td class="text-right py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href="edittipousuarios.php?id='.$row['idtipo_usuario'].'" class="btn btn-info"><i class="fas fa-edit"></i></a>
                      <a data-id="'.$row['idtipo_usuario'].'" class="btn btn-danger btn-delete_tipo_usuario"><i class="fas fa-trash"></i></a>
                  <!--    <a href="../../App/Database/deletetipousuarios.php?id='.$row['idtipo_usuario'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
                  <!--<a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-default" ><i class="fas fa-trash"></i></a> -->
                    </div>
                 </td>
                 ';

                      echo '</tr>';

                    };

                  };

        echo '
                  </tbody>
                </table>

';

//echo '
//<form action="../../App/Database/deletetipousuarios.php" method="POST">
//      <div class="modal fade" id="modal-default">
//        <div class="modal-dialog">
//          <div class="modal-content">
//            <div class="modal-header">
//              <h4 class="modal-title">Deletar Livro?</h4>
//              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                <span aria-hidden="true">&times;</span>
//              </button>
//            </div>
//            <div class="modal-body">
//              <p>Deseja deletar o livro selecionado?</p>
//            </div>
//            <input type="hidden" name="idlivro" id="idlivro"">
//            <div class="modal-footer justify-content-between">
//              <button type="submit" name="update" value="cancelar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
//              <button type="submit" name="update" value="deletebook" class="btn btn-primary btn-delete_tipo_">Deletar</button>
//            </div>
//          </div>
//          <!-- /.modal-content -->
//        </div>
//        <!-- /.modal-dialog -->
//      </div>
//</form>';

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

//Modal Deletar Tipo Usuário
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
              <a id="deleteYes" type="submit" class="btn btn-danger">Deletar</a>
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
        null,
        null,
        null,
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