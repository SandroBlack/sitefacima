<?php
	session_start();

if (isset($_SESSION['nome_usuario'])) {

if($_SESSION['nivel_acesso'] == 1)
{
	header("Location: pages/professor.php");
} else{
	header("Location: pages/admin.php");
}	

}

?>
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
            <div class="alert alert-danger alertaLogin" id="alerta1" role="alert">
                Usuário ou Senha Inválido!
            </div>
            <div class="alert alert-warning alertaLogin" id="alerta2" role="alert">
                Favor Preencher Todos os Campos!
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

            <button class="btn btn-dark btn-block" id="btnLogin" type="button"><i class="fas fa-sign-in-alt"></i>&nbsp;Entrar</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2018 - Aquilla / Elissandro / Joseano</p>               
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