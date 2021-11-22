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
            <h1>Meus Empréstimos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../">Home</a></li>
              <li class="breadcrumb-item active">Meus Empréstimos</li>
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
                <h3 class="card-title">Empréstimos</h3>              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="datatable_default">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Data Reserva</th>
                      <th>Hora Reserva</th>
                      <th>Data Locação</th>
                      <th>Hora Locação</th>
                      <th>Data Devolução</th>
                      <th>Hora Devolução</th>
                      <th>Prazo Devolução</th>
                      <th></th>
                    </tr>
                  </thead>
        <tfoot style="display: table-header-group;">
            <tr>

                      <th>ID</th>
                      <th>Data Reserva</th>
                      <th>Hora Reserva</th>
                      <th>Data Locação</th>
                      <th>Hora Locação</th>
                      <th>Data Devolução</th>
                      <th>Hora Devolução</th>
                      <th></th>
                      <th></th>

            </tr>
        </tfoot>                  
                  <tbody>';


                  $resp_json = $emprestimos->GetEmprestimosUsuario($idUsuario);
                  $resp_array = json_decode($resp_json, true);

                  foreach ($resp_array as $row) {

                    if (isset($row['idemprestimo']) != NULL) {

                      if (!is_null($row['data_locacao']) && is_null($row['data_devolucao'])){
           				  
           				      $limite_dias_emprestimo = $_SESSION['permissoes']['limite_dias_emprestimo'];
                        $start = strtotime($row['data_locacao']);
                        $end = time();
                        $days_between = ($end - $start);
                        $days_between_converted = round($days_between / (60*60*24));
                        $dias_devolucao_converted = $days_between_converted - $limite_dias_emprestimo;   
                        if ($dias_devolucao_converted < 0) {
                          $dias_devolucao_converted *= -1;
                        }
          
                        if ($days_between_converted >= $limite_dias_emprestimo) {
                            $prazo_devolucao = "100%";
                            if ($days_between_converted > $limite_dias_emprestimo) {
                              $dias_devolucao = $dias_devolucao_converted." Dias Atraso Devolução";    
                            } else {
                              $dias_devolucao = $dias_devolucao_converted." Dias para Devolução";      
                            }
                        } else {
                            $prazo_devolucao = ( ( $days_between_converted / $limite_dias_emprestimo ) * 100 )."%";
                            $dias_devolucao = $dias_devolucao_converted." Dias para Devolução";
                        }

                      } else {
                          $prazo_devolucao = "0%";
                          $dias_devolucao = "Devolução Realizada";
                      };
          
                      if ($prazo_devolucao >= 75){
                          $progress_class = "progress-bar bg-danger";
                      } else if ($prazo_devolucao >= 50){
                          $progress_class = "progress-bar bg-warning"; 
                      } else if ($prazo_devolucao >= 25){
                          $progress_class = "progress-bar bg-info";
                      } else {
                          $progress_class = "progress-bar bg-success"; 
                      };                      

                      echo '<tr>';
                      echo '<td>'.$row['idemprestimo'].'</td>';
                      echo '<td>'.$row['data_reserva'].'</td>';
                      echo '<td>'.$row['hora_reserva'].'</td>';
                      echo '<td>'.$row['data_locacao'].'</td>';
                      echo '<td>'.$row['hora_locacao'].'</td>';
                      echo '<td>'.$row['data_devolucao'].'</td>';
                      echo '<td>'.$row['hora_devolucao'].'</td>';
                      echo '<td>
                              <div class="progress progress-xs">
                                <div class="'.$progress_class.'" style="width: '.$prazo_devolucao.'"></div>
                              </div>
                              <small>
                                <strong>'.$dias_devolucao.'</strong>
                              </small>                              
                            </td>';
                      echo '<td class="text-right py-0 align-middle">
                              <div class="btn-group btn-group-sm">
                                <a href="minhaslocacoes_livros.php?id='.$row['idemprestimo'].'" class="btn btn-primary"><i class="fas fa-book"></i></a> 
                              </div>
                            </td>';

                      echo '</tr>';

                    };

                  };

                  echo '
                  </tbody>                  
                </table>
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
        null,
        null,
        {"visible" : false },
        null,
        {"visible" : false },
        null,
        {"visible" : false },
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
          $(\'#datatable_default2\').DataTable({
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