$(document).ready(function() {
  
	//Deletar Usuário Abrir Modal
	$('#datatable_default').on('click', '.btn-delete_usuario', function(e){
		e.preventDefault();

		var idUsuario = $(this).attr('data-id');
		if (idUsuario != "") {
			var tituloModal = "Deletar Usuário ?";
			var mensagemModal = "Confirma a Deleção do Usuário " + idUsuario + " ?";
			var href = "../../App/Database/deleteusuario.php?id="+ idUsuario +"";

			document.getElementById("deleteYes").setAttribute("href", href);
				
			$('#tituloDelete').html( tituloModal );

			$('#mensagemDelete').html( mensagemModal );

			$('#modalDelete').modal('show');
		}

	})


	//Deletar Tipo Usuário Abrir Modal
	$('#datatable_default').on('click', '.btn-delete_tipo_usuario', function(e){
		e.preventDefault();

		var idTipoUsuario = $(this).attr('data-id');
		if (idTipoUsuario != "") {
			var tituloModal = "Deletar Tipo Usuário ?";
			var mensagemModal = "Confirma a Deleção do Tipo de Usuário " + idTipoUsuario + " ?";
			var href = "../../App/Database/deletetipousuarios.php?id="+ idTipoUsuario +"";

			document.getElementById("deleteYes").setAttribute("href", href);
				
			$('#tituloDelete').html( tituloModal );

			$('#mensagemDelete').html( mensagemModal );

			$('#modalDelete').modal('show');
		}

	})

	//Deletar Livro Abrir Modal
	$('#datatable_default').on('click', '.btn-delete_livro', function(e){
		e.preventDefault();

		var idLivro = $(this).attr('data-id');
		if (idLivro != "") {
			var tituloModal = "Deletar Livro?";
			var mensagemModal = "Confirma a Deleção do Livro " + idLivro + " ?";
			var href = "../../App/Database/deletelivro.php?id="+ idLivro +"";

			document.getElementById("deleteYes").setAttribute("href", href);
				
			$('#tituloDelete').html( tituloModal );

			$('#mensagemDelete').html( mensagemModal );

			$('#modalDelete').modal('show');
		}

	})

	//Deletar Categoria Livro Abrir Modal
	$('#datatable_default').on('click', '.btn-delete_categoria_livro', function(e){
		e.preventDefault();

		var idCategoria = $(this).attr('data-id');
		if (idCategoria != "") {
			var tituloModal = "Deletar Categoria Livro?";
			var mensagemModal = "Confirma a Deleção da Categoria de Livro " + idCategoria + " ?";
			var href = "../../App/Database/deletecategorialivros.php?id="+ idCategoria +"";

			document.getElementById("deleteYes").setAttribute("href", href);
				
			$('#tituloDelete').html( tituloModal );

			$('#mensagemDelete').html( mensagemModal );

			$('#modalDelete').modal('show');
		}

	})	

	//Deletar Emprestimo Livro Abrir Modal
	$('#datatable_default').on('click', '.btn-delete_emprestimo', function(e){
		e.preventDefault();

		var idEmprestimo = $(this).attr('data-id');
		if (idEmprestimo != "") {
			var tituloModal = "Deletar Emprestimo Livros?";
			var mensagemModal = "Confirma a Deleção do Emprestimo de Livros " + idEmprestimo + " ?";
			var href = "../../App/Database/deleteemprestimos.php?id="+ idEmprestimo +"";

			document.getElementById("deleteYes").setAttribute("href", href);
				
			$('#tituloDelete').html( tituloModal );

			$('#mensagemDelete').html( mensagemModal );

			$('#modalDelete').modal('show');
		}

	})

	//Deletar Emprestimo Livro Abrir Modal
	$('#datatable_default').on('click', '.btn-delete_livro_emprestimo', function(e){
		e.preventDefault();

		var idLivroEmprestimo = $(this).attr('data-id');
		var idEmprestimo = $(this).attr('data-idemprestimo');
		if (idLivroEmprestimo != "") {
			var tituloModal = "Deletar Livro Emprestimo?";
			var mensagemModal = "Confirma a Deleção do livro do Emprestimo?";
			var href = "../../App/Database/deletelivroemprestimo.php?idemprestimo="+idEmprestimo+"&id="+ idLivroEmprestimo +"";

			document.getElementById("deleteLivroEmprestimoYes").setAttribute("href", href);
				
			$('#tituloDeleteLivroEmprestimo').html( tituloModal );

			$('#mensagemDeleteLivroEmprestimo').html( mensagemModal );

			$('#modalDeleteLivroEmprestimo').modal('show');
		}

	})		

});