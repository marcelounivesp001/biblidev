$(document).ready(function() {
  
	//Adicionar Usuário
	$('body').on('click', '.btn-add_usuario', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var usuario = document.getElementById("login_usuario").value;
		var senha = document.getElementById("login_senha").value;
		var tipo_usuario = document.getElementById("login_idtipo_usuario").value;
		var cpf = document.getElementById("cpf").value;
		var nome = document.getElementById("nome").value;
		var sobrenome = document.getElementById("sobrenome").value;
		var data_nascimento = document.getElementById("data_nascimento").value;
		var sexo = document.getElementById("sexo").value;
		var email= document.getElementById("email").value;
		var cep = document.getElementById("cep").value;
		var rua = document.getElementById("rua").value;
		var num = document.getElementById("num").value;
		var complemento = document.getElementById("complemento").value;
		var bairro = document.getElementById("bairro").value;
		var estado = document.getElementById("estado").value;
		var cidade = document.getElementById("cidade").value;
		var ativo = "1";
		var msg = "";

		//Retirar pontos e traço CPF
		cpf = cpf.replace(/\./g, '');
  	cpf = cpf.replace('-', '');

		msg = CheckFields(usuario, senha, tipo_usuario, cpf, nome, sobrenome, data_nascimento, sexo, email, cep, rua, num, bairro, estado, cidade, ativo);
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'insertUsuario',
					login_usuario: usuario,
					login_senha: senha,
					login_idtipo_usuario: tipo_usuario,
					cpf: cpf,
					nome: nome,
					sobrenome: sobrenome,
					data_nascimento: data_nascimento,
					sexo: sexo,
					email: email,
					cep: cep,
					rua: rua,
					num: num,
					complemento: complemento,
					bairro: bairro,
					estado: estado,
					cidade: cidade
					};

		var url = "../../App/Database/insertusuario.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					$('#tituloUserCreateSuccess').html( data['titulo'] );

					$('#mensagemUserCreateSuccess').html( data['message'] );

					$('#modalUserCreateSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalUserCreateSuccess').modal('show');

				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})

	//Editar Usuário
	$('body').on('click', '.btn-edit_usuario', function(e){
		e.preventDefault();

		//Buscar todos os campos tela
		var iduseredit = document.getElementById("iduseredit").value;
		var usuario = !document.getElementById("login_usuario").disabled ? document.getElementById("login_usuario").value : "no_change"; 
		var senha = !document.getElementById("login_senha").disabled ? document.getElementById("login_senha").value : "no_change";
		var tipo_usuario = document.getElementById("login_idtipo_usuario").value;
		var cpf = document.getElementById("cpf").value;
		var nome = document.getElementById("nome").value;
		var sobrenome = document.getElementById("sobrenome").value;
		var data_nascimento = document.getElementById("data_nascimento").value;
		var sexo = document.getElementById("sexo").value;
		var email= document.getElementById("email").value;
		var cep = document.getElementById("cep").value;
		var rua = document.getElementById("rua").value;
		var num = document.getElementById("num").value;
		var complemento = document.getElementById("complemento").value;
		var bairro = document.getElementById("bairro").value;
		var estado = document.getElementById("estado").value;
		var cidade = document.getElementById("cidade").value;
		var ativo = document.getElementById("ativo").value;
		var msg = "";
 
		//Usuário Logado Sistema
		var iduser = document.getElementById("iduser").value;

		//Retirar pontos e traço CPF
		cpf = cpf.replace(/\./g, '');
  	cpf = cpf.replace('-', ''); 

		msg = CheckFields(usuario, senha, tipo_usuario, cpf, nome, sobrenome, data_nascimento, sexo, email, cep, rua, num, bairro, estado, cidade, ativo);
		
		if(msg!= "" ){
			alert("error", "&nbsp;"+msg+".");
			return;	
		}

		var form = {
					identCall: 'updateUsuario',
					iduseredit: iduseredit,
					login_usuario: usuario,
					login_senha: senha,
					login_idtipo_usuario: tipo_usuario,
					cpf: cpf,
					nome: nome,
					sobrenome: sobrenome,
					data_nascimento: data_nascimento,
					sexo: sexo,
					email: email,
					cep: cep,
					rua: rua,
					num: num,
					complemento: complemento,
					bairro: bairro,
					estado: estado,
					cidade: cidade,
					ativo: ativo
					};

		var url = "../../App/Database/insertusuario.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {
				if(data['status'] == 'success'){

					if ( iduseredit == iduser ){
						document.getElementById("ok_user_edit").setAttribute("href", "../destroy.php");
					}

					$('#tituloUserEditSuccess').html( data['titulo'] );

					$('#mensagemUserEditSuccess').html( data['message'] );

					$('#modalUserEditSuccess').modal({backdrop: 'static', keyboard: false})  

					$('#modalUserEditSuccess').modal('show');



				} else {
					alert(data['status'], '&nbsp;'+data['message']+'');
				}

			}

		})		

	})

	//Modificar Usuário Login
	$('body').on('click', '.btn-modificar_usuario_login', function(e){
		e.preventDefault();

		var input = document.getElementById("login_usuario");

  	if(input.disabled){
    	input.disabled = false;
  	} else {
    	input.disabled = true;
  	};

	})

	//Modificar Senha Login
	$('body').on('click', '.btn-modificar_senha_login', function(e){
		e.preventDefault();

		var input = document.getElementById("login_senha");

  	if(input.disabled){
    	input.disabled = false;
    	input.value = "";
  	} else {
    	input.disabled = true;
    	input.value = "123456789";
  	};

	})					

})

//Validar CPF
function ValidateCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;

  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

//Validar CEP
function ValidateCEP(cep){
  var cep_new = cep.replace(/\./g, '');
  cep_new = cep.replace('-', '');
  if(cep_new.length != 8){
  	return false;
  } else {
  	return true;
  }            
}

//Validar E-mail
function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function CheckFields(usuario, senha, tipo_usuario, cpf, nome, sobrenome, data_nascimento, sexo, email, cep, rua, num, bairro, estado, cidade, ativo)
{

	var msg = "";
 
	//Checar Campos Obrigatórios preenchidos
	if (usuario == null || usuario == "") {
		return msg = "Campo usuário é obrigatório";
	};
	if (senha == null || senha == "") {
		return msg = "Campo senha é obrigatório";
	};
	if (tipo_usuario == null || tipo_usuario == "") {
		return msg = "Campo Tipo Usuário é obrigatório";
	};	
	if (cpf == null || cpf == "") {
		return msg = "Campo CPF é obrigatório";
	} else {
		if (!ValidateCPF(cpf)){
			return msg = "CPF não é um CPF valido";
		};
	}; 
	if (nome == null || nome == "") {
		return msg = "Campo nome é obrigatório";
	};
	if (sobrenome == null || sobrenome == "") {
		return msg = "Campo Sobrenome é obrigatório";
	};		
	if (sobrenome == null || sobrenome == "") {
		return msg = "Campo Sobrenome é obrigatório";
	};	
	if (data_nascimento == null || data_nascimento == "") {
		return msg = "Campo Data Nascimento é obrigatório";
	};	
	if (sexo == null || sexo == "") {
		return msg = "Campo sexo é obrigatório";
	};	
	if (email == null || email == "") {
		return msg = "Campo E-mail é obrigatório";
	}else {
		if(!validateEmail(email)){
			return msg = "E-mail não é um e-mail valido";
		}
	};	
	if (cep == null || cep == "") {
		return msg = "Campo CEP é obrigatório";
	} else {
		if (!ValidateCEP(cep)){
			return msg = "CEP não é um CEP valido";
		};			
	};			
	if (rua == null || rua == "") {
		return msg = "Campo Rua é obrigatório";
	};							
	if (num == null || num == "") {
		return msg = "Campo Número é obrigatório";
	};	
	if (bairro == null || bairro == "") {
		return msg = "Campo Bairro é obrigatório";
	};	
	if (estado == null || estado == "") {
		return msg = "Campo Estado é obrigatório";
	};
	if (cidade == null || cidade == "") {
		return msg = "Campo Cidade é obrigatório";
	};
	if (ativo == null || ativo == "") {
		return msg = "Campo Ativo é obrigatório";
	};

	return msg;
	
}

//Mostrar_Esconder Senha
function ShowHidePassword(){
  
  var senha = document.getElementById("login_senha");
  
  if (!senha.disabled) {
    senha.type == "password" ? senha.type = "text" : senha.type = "password"; 
  };
  
} 	