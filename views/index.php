<?php 

require_once '../App/auth.php';
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
      <section class="content">
        <div class="container-fluid">
         <div class="card">
         	<!-- <img src="dist/img/biblioteca1.jpg"/> -->
          <img src="dist/img/biblioteca.png"/>
         </div>
        </div>
      </section>
';

echo '</div>';

echo $Scripts->GetFooter("");

echo $Scripts->GetJavaScript("", "inicio");
  
  //Espaço para adicionar Scripts

echo $Scripts->GetJavaScript("", "final");

?>