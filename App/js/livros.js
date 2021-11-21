$(document).ready(function() {
  
	//Adicionar Usuário
	$('body').on('click', '.btn-add_livro', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var isbn = document.getElementById("isbn").value;
		var titulo = document.getElementById("titulo").value;
		var autores = document.getElementById("autores").value;
		var ano_publicacao = document.getElementById("ano_publicacao").value;
		var edicao = document.getElementById("edicao").value;
		var editora = document.getElementById("editora").value;
		var paginas = document.getElementById("paginas").value;
		var categoria = document.getElementById("categoria").value;
		var quantidade = document.getElementById("quantidade").value;
		var iduser = document.getElementById("iduser").value;
		var ativo = "1";
		var msg = "";

		msg = CheckFields(isbn, titulo, autores, categoria, quantidade, ativo);
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'insertLivro',
					isbn: isbn,
					titulo: titulo,
					autores: autores,
					ano_publicacao: ano_publicacao,
					edicao: edicao,
					editora: editora,
					paginas: paginas,
					categoria: categoria,
					quantidade: quantidade,
					iduser: iduser,
					ativo: ativo
					};

		var url = "../../App/Database/insertlivro.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					$('#tituloLivroCreateSuccess').html( data['titulo'] );

					$('#mensagemLivroCreateSuccess').html( data['message'] );

					$('#modalLivroCreateSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalLivroCreateSuccess').modal('show');

				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})

	//Editar Usuário
	$('body').on('click', '.btn-edit_livro', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var idlivro = document.getElementById("idlivro").value; 
		var isbn = document.getElementById("isbn").value;
		var titulo = document.getElementById("titulo").value;
		var autores = document.getElementById("autores").value;
		var ano_publicacao = document.getElementById("ano_publicacao").value;
		var edicao = document.getElementById("edicao").value;
		var editora = document.getElementById("editora").value;
		var paginas = document.getElementById("paginas").value;
		var categoria = document.getElementById("categoria").value;
		var quantidade = document.getElementById("quantidade").value;
		var ativo = document.getElementById("ativo").value;
		var msg = "";

		//Usuário Logado Sistema
		var iduser = document.getElementById("iduser").value;

		msg = CheckFields(isbn, titulo, autores, categoria, quantidade, ativo);
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'updateLivro',
					idlivro: idlivro,
					isbn: isbn,
					titulo: titulo,
					autores: autores,
					ano_publicacao: ano_publicacao,
					edicao: edicao,
					editora: editora,
					paginas: paginas,
					categoria: categoria,
					quantidade: quantidade,
					iduser: iduser,
					ativo: ativo
					};

		var url = "../../App/Database/insertlivro.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {

				if(data['status'] == 'success'){

					$('#tituloLivroEditSuccess').html( data['titulo'] );

					$('#mensagemLivroEditSuccess').html( data['message'] );

					$('#modalLivroEditSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalLivroEditSuccess').modal('show');

				} else {

					alert(data['status'], '&nbsp;'+data['message']+'');

				}

			}

		})		

	})		

})

function CheckFields(isbn, titulo, autores, categoria, quantidade, ativo)
{

	var msg = "";
 
	//Checar Campos Obrigatórios preenchidos
	if (isbn == null || isbn == "") {
		return msg = "Campo ISBN é obrigatório";
	};
	if (titulo == null || titulo == "") {
		return msg = "Campo Título é obrigatório";
	};
	if (autores == null || autores == "") {
		return msg = "Campo Tipo Autores é obrigatório";
	};	
	if (categoria == null || categoria == "") {
		return msg = "Campo Categoria é obrigatório";
	}; 
	if (quantidade == null || quantidade == "") {
		return msg = "Campo Quantidade é obrigatório";
	};
	if (ativo == null || ativo == "") {
		return msg = "Campo Ativo é obrigatório";
	};


	return msg;
	
}