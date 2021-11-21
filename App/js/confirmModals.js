$(document).ready(function() {
  
	//Confirmar Entrega Livros Emprestimos
	$('#datatable_default').on('click', '.btn-entrega_livros', function(e){
		e.preventDefault();

		var idEmprestimo = $(this).attr('data-id');
		if (idEmprestimo != "") {
			var tituloModal = "Confirmar Entrega Livros?";
			var mensagemModal = "Confirma a Entrega dos livros Emprestimo nº <strong>" + idEmprestimo + "</strong> ?";
			var href = "../../App/Database/updateemprestimolivros.php?idEntrega="+ idEmprestimo +"";

			document.getElementById("entregaYes").setAttribute("href", href);
				
			$('#tituloEntrega').html( tituloModal );

			$('#mensagemEntrega').html( mensagemModal );

			$('#modalEntrega').modal('show');
		}

	})

	//Confirmar Devolucao Livros Emprestimos
	$('#datatable_default').on('click', '.btn-devolucao_livros', function(e){
		e.preventDefault();

		var idEmprestimo = $(this).attr('data-id');
		if (idEmprestimo != "") {
			var tituloModal = "Confirmar Devolução Livros?";
			var mensagemModal = "Confirma a Devolução dos livros Emprestimo nº <strong>" + idEmprestimo + "</strong> ?";
			var href = "../../App/Database/updateemprestimolivros.php?idDevolucao="+ idEmprestimo +"";

			document.getElementById("devolucaoYes").setAttribute("href", href);
				
			$('#tituloDevolucao').html( tituloModal );

			$('#mensagemDevolucao').html( mensagemModal );

			$('#modalDevolucao').modal('show');
		}

	})	

});	