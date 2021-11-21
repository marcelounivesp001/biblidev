<?php
 
$CookieUsername = (isset($_COOKIE['CookieUsername'])) ? base64_decode($_COOKIE['CookieUsername']) : '';
$CookieRememberme = (isset($_COOKIE['CookieRememberme'])) ? base64_decode($_COOKIE['CookieRememberme']) : '';
$checked = ($CookieRememberme == 'SIM') ? 'Checked' : '';
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblidev | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script> 

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>Bibli</b>DEV</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Log-se para iniciar uma sessão</p>    
        <div class="input-group mb-3">
          <input id="login_usuario" type="text" name="username" class="form-control" placeholder="Usuario" value="<?=$CookieUsername ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="login_senha" type="password" name="password" class="form-control" placeholder="Password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <a type="submit" onclick="ShowHidePassword()" class="btn-show_pass"> <span class="fas fa-lock"></span> <a/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" value="SIM" <?=$checked ?>>
              <label for="remember">
                Lembre-me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-login">Entrar</button>
          </div>
      </div>
  </div>
</div>
<div id="divErrorMessage"/>

<script src="App/js/login.js"></script>

<!-- jQuery -->
<script src="views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.min.js"></script>
</body>
</html>