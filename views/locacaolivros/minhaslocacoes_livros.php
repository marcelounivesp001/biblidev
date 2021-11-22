<?php 

require_once '../../App/auth.php';
require_once '../../App/Classes/script.class.php';
require_once '../../App/Models/emprestimos.class.php';

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

echo '          <!-- /.card -->
  <br>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Empréstimo Livros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active"><a href="minhaslocacoes.php">Meus Empréstimos</a></li>
              <li class="breadcrumb-item active">Empréstimo Livros</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <br>
    <section class="content">
            <div class="container-fluid">
        <div class="row">


        <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Empréstimo Livros</h3>
              </div>
              

              <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable_default">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ID Emprestimo</th>
                      <th>Nome</th>
                      <th>ISBN</th>
                      <th>Título</th>
                      <th>Comentário</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <tfoot style="display: table-header-group;">
                    <tr>
                      <th>ID</th>
                      <th>ID Emprestimo</th>
                      <th>Nome</th>
                      <th>ISBN</th>                      
                      <th>Título</th>
                      <th>Comentário</th>
                      <!-- <th></th> -->
                    </tr>                  
                  </tfoot>                  
                  <tbody>';

                  $resp_json = $emprestimos->GetEmprestimoLivros($_GET['id']);
                  $resp_array = json_decode($resp_json, true);

                  foreach ($resp_array as $row) {

                    if (isset($row['id']) != NULL) {

                      echo '<tr>';
                      echo '<td>'.$row['id'].'</td>';
                      echo '<td>'.$row['idemprestimo'].'</td>';
                      echo '<td>'.$row['nome'].' '.$row['sobrenome'].'</td>';
                      echo '<td>'.$row['isbn'].'</td>';
                      echo '<td>'.$row['titulo'].'</td>';
                      echo '<td>'.$row['comentario'].'</td>';
                      echo '</tr>';

                    }
                  }                    


                  echo '
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="box-footer clearfix no-border">
            </div>
            </div>
                        </div>
            </div>
            </section>
            <!-- /.card -->';             

echo '</div>';

echo $Scripts->GetFooter("../");

echo $Scripts->GetJavaScript("../", "inicio");

  //Espaço para adicionar Scripts

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
        {"visible" : false },
        null,
        null,
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