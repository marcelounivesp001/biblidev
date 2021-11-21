$(document).ready(function() {
  
	//Adicionar Usuário
	$('body').on('click', '.btn-create_tipo_usuarios', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var tipo_usuario = document.getElementById("tipo_usuario").value;
		var administrar_usuarios = document.getElementById("administrar_usuarios").value;
		var administrar_livros = document.getElementById("administrar_livros").value;
		var administrar_emprestimos = document.getElementById("administrar_emprestimos").value;
		var limite_livros_emprestimo = document.getElementById("limite_livros_emprestimo").value;
		var limite_dias_emprestimo = document.getElementById("limite_dias_emprestimo").value;
		var ativo = "1";

		var msg = "";
		tipo_usuario = tipo_usuario.replace(/ /g,"");

		msg = CheckFields(tipo_usuario, administrar_usuarios, administrar_livros, administrar_emprestimos, limite_livros_emprestimo, limite_dias_emprestimo, ativo)
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'InsertTipoUsuarios',
					tipo_usuario: tipo_usuario,
					administrar_usuarios: administrar_usuarios,
					administrar_livros: administrar_livros,
					administrar_emprestimos: administrar_emprestimos,
					limite_livros_emprestimo: limite_livros_emprestimo,
					limite_dias_emprestimo: limite_dias_emprestimo
					};

		var url = "../../App/Database/inserttipousuarios.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					$('#tituloTipoUsuarioCreateSuccess').html( data['titulo'] );

					$('#mensagemTipoUsuarioCreateSuccess').html( data['message'] );

					$('#modalTipoUsuarioCreateSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalTipoUsuarioCreateSuccess').modal('show');

				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})

	//Editar Usuário
	$('body').on('click', '.btn-update_tipo_usuarios', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var idtipo_usuario = document.getElementById("idtipo_usuario").value;
		var tipo_usuario = document.getElementById("tipo_usuario").value;
		var administrar_usuarios = document.getElementById("administrar_usuarios").value;
		var administrar_livros = document.getElementById("administrar_livros").value;
		var administrar_emprestimos = document.getElementById("administrar_emprestimos").value;
		var limite_livros_emprestimo = document.getElementById("limite_livros_emprestimo").value;
		var limite_dias_emprestimo = document.getElementById("limite_dias_emprestimo").value;
		var ativo = document.getElementById("ativo").value;;
		var msg = "";

		tipo_usuario = tipo_usuario.replace(/ /g,"");

		msg = CheckFields(tipo_usuario, administrar_usuarios, administrar_livros, administrar_emprestimos, limite_livros_emprestimo, limite_dias_emprestimo, ativo)
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'UpdateTipoUsuarios',
					idtipo_usuario: idtipo_usuario,
					tipo_usuario: tipo_usuario,
					administrar_usuarios: administrar_usuarios,
					administrar_livros: administrar_livros,
					administrar_emprestimos: administrar_emprestimos,
					limite_livros_emprestimo: limite_livros_emprestimo,
					limite_dias_emprestimo: limite_dias_emprestimo,
					ativo: ativo
					};

		var url = "../../App/Database/inserttipousuarios.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					$('#tituloTipoUsuarioEditSuccess').html( data['titulo'] );

					$('#mensagemTipoUsuarioEditSuccess').html( data['message'] );

					$('#modalTipoUsuarioEditSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalTipoUsuarioEditSuccess').modal('show');

				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})	

function CheckFields(tipo_usuario, administrar_usuarios, administrar_livros, administrar_emprestimos, limite_livros_emprestimo, limite_dias_emprestimo, ativo)
{

	var msg = "";
 
	//Checar Campos Obrigatórios preenchidos
	if (tipo_usuario == null || tipo_usuario == "") {
		return msg = "Campo Tipo Usuário é obrigatório";
	};
	if (administrar_usuarios == null || administrar_usuarios == "") {
		return msg = "Campo Administrar Usuários é obrigatório";
	};
	if (administrar_livros == null || administrar_livros == "") {
		return msg = "Campo Administrar Livros é obrigatório";
	};	
	if (administrar_emprestimos == null || administrar_emprestimos == "") {
		return msg = "Campo Administrar Emprestimos é obrigatório";
	};	
	if (limite_livros_emprestimo == null || limite_livros_emprestimo == "") {
		return msg = "Campo Limite Livros Emprestimo é obrigatório";
	};
	if (limite_dias_emprestimo == null || limite_dias_emprestimo == "") {
		return msg = "Campo Limite Dias Emprestimo é obrigatório";
	};	

	return msg;
	
}						

});	