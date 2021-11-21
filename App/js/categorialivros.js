$(document).ready(function() {
  
	//Adicionar Usuário
	$('body').on('click', '.btn-create_categoria_livros', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var iduser = document.getElementById("iduser").value;
		var categoria = document.getElementById("categoria").value;
		var ativo = "1";

		var msg = "";

		msg = CheckFields(categoria, ativo)
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'InsertCategoriaLivros',
					categoria: categoria,
					iduser: iduser
					};

		var url = "../../App/Database/insertcategorialivros.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					$('#tituloCategoriaLivrosCreateSuccess').html( data['titulo'] );

					$('#mensagemCategoriaLivrosCreateSuccess').html( data['message'] );

					$('#modalCategoriaLivrosCreateSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalCategoriaLivrosCreateSuccess').modal('show');

				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})

	//Editar Usuário
	$('body').on('click', '.btn-update_categoria_livros', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var iduser = document.getElementById("iduser").value;
		var idcategoria = document.getElementById("idcategoria").value;
		var categoria = document.getElementById("categoria").value;
		var ativo = document.getElementById("ativo").value;;
		var msg = "";

		msg = CheckFields(categoria, ativo)
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}


		var form = {
					identCall: 'UpdateCategoriaLivros',
					idcategoria: idcategoria,
					categoria: categoria,
					ativo: ativo,
					iduser: iduser
					};

		var url = "../../App/Database/insertcategorialivros.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					$('#tituloCategoriaLivrosEditSuccess').html( data['titulo'] );

					$('#mensagemCategoriaLivrosEditSuccess').html( data['message'] );

					$('#modalCategoriaLivrosEditSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalCategoriaLivrosEditSuccess').modal('show');

				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})	

function CheckFields(categoria, ativo)
{

	var msg = "";
 
	//Checar Campos Obrigatórios preenchidos
	if (categoria == null || categoria == "") {
		return msg = "Campo Categoria é obrigatório";
	};
	if (ativo == null || ativo == "") {
		return msg = "Campo Ativo é obrigatório";
	};	

	return msg;
	
}						

});	