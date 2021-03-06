<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Facima - Login</title>
    <link rel="icon" href="img/favicon-16x16.png">

    <!-- Bootstrap CSS, Font Awesome-->    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    	
	  <!-- Optional CSS -->
	  <link rel="stylesheet" href="css/style.css">
  </head>
  
  <body>
    <div class="container">      
          
      <div class="row justify-content-center centralizado">
        <div class="col-md-4 bg-light border">                          
          <form>
            <div class="text-center mt-3">
              <a href="#"><img class="" src="img/Logo_Loginb.png" alt="Logo Facima"></a>              
              <hr style="border-width: 5px; border-color:#006FA7">
              <h5 class="text-dark">Central de Autenticação</h5>
            </div>

            <!-- Alertas Login -->
            <div class="alert alert-warning alertaLogin" id="alertaLogin1" role="alert">
                Favor Preencher Todos os Campos.
            </div>
            <div class="alert alert-danger alertaLogin" id="alertaLogin2" role="alert">
                Usuário ou Senha Inválido.
            </div>            
            <div class="alert alert-warning alertaLogin" id="alertaLogin3" role="alert">
                Usuario inativo, entre em contato com o administrador.
            </div>
            <br>
            <div class="form-group">
              <!--<label for="LoginA">Login</label>-->
              <input class="form-control" type="text" id="login" placeholder="E-mail" required>
            </div>

            <div class="form-group">  
              <!--<label for="SenhaA">Senha</label>-->
              <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" required>
            </div>

            <button class="btn btn-dark btn-block mb-3" id="btnLogin" type="button"><i class="fas fa-sign-in-alt"></i>&nbsp;Entrar</button>
            <a href="pages/cadastro.usuario.php" class="link">Cadastro</a>
            <div class="dropdown-divider mb-3"></div>
            <p class="text-muted text-center mb-3">&copy; 2018 - Aquilla / Elissandro / Joseano</p>               
          </form>
          
        </div>        
      </div>
    </div>
    
    
    <!-- Optional JavaScript -->    
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/funcoes.js"></script>    	
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>  
  </body>
</html>