$(document).ready(function() {

	//Adicionar Livro ao Cesto
	$('body').on('click', '.bt-add', function(e){
		e.preventDefault();

		var form = {
					identCall: 'addLivroCesto',
					idlivro: $(this).attr('data-id'),
					isbn: $(this).attr('data-isbn'),
					titulo: $(this).attr('data-titulo')
					};

		var url = "../../App/Models/cestolivros.php";

		$.ajax({ 
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {

				if(data['status'] == 'success'){
					document.getElementById("quant_livros_cesto").textContent = data['value'];
    				alert(data['status'], '&nbsp;'+data['message']+''); 

				} else if (data['status'] == 'info') {
					alert(data['status'], '&nbsp;'+data['message']+''); 
		
				} else if (data['status'] == 'warning') {
					alert(data['status'], '&nbsp;'+data['message']+''); 

				} else {
					alert(data['status'], '&nbsp;'+data['message']+''); 
					
				}


			setTimeout(function(){
				$('#status-container').hide();

				if(data['redirect'] != ''){
					window.location.href = data['redirect'];
				}
			}, 3000);

			}

		})

	})

	//Visualizar Cesto Livro
	$('body').on('click', '.bt-cestolivros', function(e){
		e.preventDefault();

		var form = { 
					identCall: "viewCesto",
					idlivro: '',
					isbn: '',
					titulo: ''					
					};				

		var url = "../../App/Models/cestolivros.php";

		$.ajax({
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {

				$('#listaLivrosCesto').html( data['value'] );
		
				$('#modalCestoLivros').modal('show');				

			}

		})

	})

	//Deletar Livro do Cesto
	$('body').on('click', '.btn-del_livro_cesta', function(e){
		e.preventDefault();

		var form = { 
					identCall: "deleteLivroCesto",
					idlivro: $(this).attr("id"),
					isbn: '',
					titulo: ''
					};

		var url = "../../App/Models/cestolivros.php";

		$.ajax({
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {

				var quant_livros_cesto = document.getElementById("quant_livros_cesto").innerText;
				quant_livros_cesto = quant_livros_cesto.replace(/[\W_]/g, '');
				quant_livros_cesto != 0 ? quant_livros_cesto -= 1 : 0; 
				document.getElementById("quant_livros_cesto").textContent = '['+quant_livros_cesto+']';

				$('#listaLivrosCesto').html( data['value'] );
				
				$('#modalCestoLivros').modal('show');	

				if (data['message'] != '') {

					alert(data['status'], '&nbsp;'+data['message']+'');		

				}


			}

		})

	})

	//Finalizar Cesto
	$('body').on('click', '.btn-finalizar_cesto_livros', function(e){
		e.preventDefault();

		var form = { 
					identCall: "finalizarCestoLivros",
					idlivro: '',
					isbn: '',
					titulo: ''
					};

		var url = "../../App/Models/cestolivros.php";

		$.ajax({
			url: url, 
			type: 'POST',
			data: form,
			dataType: 'JSON',

			success: function(data, textStatus, jqXHR) {

				$('#modalCestoLivros').modal('hide');

				if (data['status'] == 'warning') {

					alert(data['status'], '&nbsp;'+data['message']+'');

				} else {	
	
					if (data['status'] == 'success') {
		
						$('#tituloCriacaoReservaSuccess').html( data['titulo'] );
		
						$('#mensagemCriacaoReservaSuccess').html( '&nbsp;'+data['message']+'' );
				
						$('#modalCriacaoReservaSuccess').modal('show');	
		
					} else {
		
						$('#tituloCriacaoReservaError').html( data['titulo'] );
		
						$('#mensagemCriacaoReservaError').html( '&nbsp;'+data['message']+'' );
				
						$('#modalCriacaoReservaError').modal('show');	
		
					}			
				}
			}

		})

	})					

});