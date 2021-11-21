$(document).ready(function() {

$(".btn-login").click(function(){

  var username = $("#login_usuario").val();
  var password = $("#login_senha").val();
  var remember = $("#remember").val();

  if ( (username == "" || username == null) || (password == "" || password == null) ){
          var divMessage = 
                          "<div class='card-body'>" +
                          "   <div class='callout callout-danger'>" +
                          "     <p>Usuário e Senha devem ser preenchidos.</p>" +
                          "   </div>" +
                          "</div>";

          $('#divErrorMessage').html(divMessage);
          $('#divErrorMessage').append(divMessage.htmlresponse);
          
  } else {

    var form = {
          identCall: 'login',
          username: username,
          password: password,
          remember: remember
          };    

    $.ajax({
          url: 'App/login.php',
          type: 'POST',
          data: form,
          dataType: 'JSON',

          success: function (data, textStatus, jqXHR) {
            if(data['status'] == 'error'){

              var divMessage = 
                          "<div class='card-body'>" +
                          "   <div class='callout callout-danger'>" +
                          "     <p>" + data['message'] +"</p>" +
                          "   </div>" +
                          "</div>";

              $('#divErrorMessage').html(divMessage);
              $('#divErrorMessage').append(divMessage.htmlresponse);                          

            } else {
              window.location.href = data['redirect'];
            }

          }
    });    


  }


});


});

function ShowHidePassword(){

  var senha = document.getElementById('login_senha');

  senha.type == "password" ? senha.type = "text" : senha.type = "password"; 

}