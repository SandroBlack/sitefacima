<?php
	include_once("../db/dbConexao.php"); 
	session_start();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Facima - Administração</title>
	<link rel="icon" href="../img/favicon-16x16.png">

    <!-- Bootstrap CSS, Font Awesome --> 
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
	
	<!-- Optional CSS -->
	<link rel="stylesheet" href="../css/style.css">

  </head>
  
  <body>
	<div class="container">
			<!-- TOPO -->
			<header class="row align-items-center mb-1 bg-dark">			
				<nav class="navbar navbar-light col-md-12">
					<a class="navbar-brand h1 text-light mb-0" href="">PAINEL ADMINISTRATIVO</a>
					<!-- <h3 class="text-light align-center">PAINEL</h3>	 -->					
					<button class="btn btn-light my-2 my-sm-0" type="submit" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-sign-out-alt"></i>Sair</button>												
				</nav>								
			</header>
			<!-- FIM TOPO -->

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Painel Administrativo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Deseja Realmente Sair?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
						<button type="button" class="btn btn-primary" id="btnSair">Sim</button>
					</div>
					</div>
				</div>
			</div>
			<!-- Fim Modal -->

            <!-- Menu Lateral -->
			<div class="row mb-1" style="height: 85vh;">								
				<div class="list-group col-md-2 p-0 bg-white border">					
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
												
						<a class="nav-link active border-bottom" id="v-pills-equipamentos-tab" data-toggle="pill" href="#v-pills-equipamentos" role="tab" aria-controls="v-pills-equipamentos" aria-selected="false">Equipamentos</a>
						<a class="nav-link border-bottom" id="v-pills-professores-tab" data-toggle="pill" href="#v-pills-professores" role="tab" aria-controls="v-pills-professores" aria-selected="false">Usuarios</a>					
					</div>					  
				</div>

				<div class="col-md-10 bg-light">
					<section>						
						<div class="tab-content" id="v-pills-tabContent">	
                            <!-- CADASTRO DE EQUIPAMENTOS -->
							<div class="tab-pane fade show active" id="v-pills-equipamentos" role="tabpanel" aria-labelledby="v-pills-equipamentos-tab">
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="nav-rel-equip-tab" data-toggle="tab" href="#nav-rel-equip" role="tab" aria-controls="nav-rel-equip" aria-selected="true">Relação</a>
										<a class="nav-item nav-link" id="nav-cadastrar-equip-tab" data-toggle="tab" href="#nav-cadastrar-equip" role="tab" aria-controls="nav-cadastrar-equip" aria-selected="false">Cadastrar</a>
										<a class="nav-item nav-link" id="nav-reservados-equip-tab" data-toggle="tab" href="#nav-reservados-equip" role="tab" aria-controls="nav-reservados-equip" aria-selected="false">Reservados</a>
									</div>
								</nav>
								<div class="tab-content" id="nav-tabContent-equip">
									<div class="tab-pane fade show active" id="nav-rel-equip" role="tabpanel" aria-labelledby="nav-rel-equip-tab">
										<h5 class="mt-2">Relação de Equipamentos</h5>
										<hr style="border-width: 5px; border-color:#006FA7">
										<form action="../pages/relatorio.php" method="post" target="_blank">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<label class="input-group-text" for="inputGroupSelect">Filtro</label>
											</div>
											 <input class="form-control" type="date" name="dataRelatorio" id="dataRelatorio">
											 <input hidden type="text" name="funcao" value="gerarRelatorio">
											<input type="text" class="form-control" placeholder="Digite sua pesquisa" aria-label="" aria-describedby="basic-addon1">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="pesquisa-equipamento" title="Pesquisar"><i class="fas fa-search"></i></button>
											</div>
										</div>
											
										<table class="table table-bordered bg-white text-center">
											<thead class="thead-light">
												<tr>
													<th scope="col">ID</th>
													<th scope="col">NOME</th>													
													<th scope="col">FABRICANTE</th>
													<th scope="col">ESTOQUE</th>
													<th scope="col">EDITAR</th>
													<th scope="col">EXCLUIR</th>
												</tr>
											</thead>	
												
											<tbody class="dadosEquipamentos">
												
											</tbody>
													
										</table>
										<button class="btn btn-dark" id="btn-rel-equip">Gerar Relatório</button>
										</form>
									</div>
									<div class="tab-pane fade" id="nav-cadastrar-equip" role="tabpanel" aria-labelledby="nav-cadastrar-equip-tab">
										<form class="" id="formEquipamento">                                    
											<h5 class="mt-2">Cadastro de Equipamentos</h5>
											<hr style="border-width: 5px; border-color:#006FA7">	
											<div class="form-group">
												<label for="nome">Nome do equipamento:</label>
												<input class="form-control" type="text" name="nome" id="nome" required/>
											</div>
											<div class="form-group">
												<label for="modelo">Fabricante do equipamento:</label>
												<input class="form-control" type="text" name="fabricante" id="fabricante" required/>
											</div>
											<div class="form-group">
												<label for="fabricante">Quantidade de equipamento(s)</label>
												<input class="form-control" type="text" name="quantidade" id="quantidade" required/>
											</div>                                        
											<div class="form-group">
												<label for="fabricante">Patrimonio do equipamento:</label>
												<input class="form-control" type="text" name="patrimonio" id="patrimonio" required/>
											</div>                                        
											<button class="btn btn-dark" id="btn-cad-equip">Cadastrar</button>                                    
										</form>		
									</div>
									<div class="tab-pane fade" id="nav-reservados-equip" role="tabpanel" aria-labelledby="nav-reservados-equip-tab">
										<h5 class="mt-2">Equipamentos Reservados</h5>
										<hr style="border-width: 5px; border-color:#006FA7">

										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<label class="input-group-text" for="inputGroupSelect">Filtro</label>
											</div>
											<select class="custom-select" id="inputGroupSelectEquipamento">
												<option selected hidden>Selecione</option>
												<option value="3">EQUIPAMENTO</option>											
												<option value="1">PROFESSOR</option>
												<option value="2">SALA</option>
											</select>
											<input type="text" class="form-control" placeholder="Digite sua pesquisa" aria-label="" aria-describedby="basic-addon1">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="pesquisa-equipamento" title="Pesquisar"><i class="fas fa-search"></i></button>
											</div>
										</div>				

										<table class="table table-bordered bg-white text-center">
											<thead class="thead-light">
												<tr>
													<th scope="col">ID</th>
													<th scope="col">PROFESSOR</th>
													<th scope="col">EQUIPAMENTO</th>
													<th scope="col">SALA</th>
													<th scope="col">DATA</th>														
												</tr>
											</thead>	
											
												<tbody class="dadosReserva">
													
												</tbody>
														
										</table>
										<button class="btn btn-dark" id="btn-res-equip">Gerar Relatório</button>
									</div>

								</div>
							</div>    
                            <!-- FIM CADASTRO DE EQUIPAMENTOS -->

                            <!-- CADASTRO DE PROFESSORES -->
							<div class="tab-pane fade" id="v-pills-professores" role="tabpanel" aria-labelledby="v-pills-professores-tab">
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="nav-rel-professor-tab" data-toggle="tab" href="#nav-rel-professor" role="tab" aria-controls="nav-rel-professor" aria-selected="true">Relação</a>
										<a class="nav-item nav-link" id="nav-cadastrar-professor-tab" data-toggle="tab" href="#nav-cadastrar-professor" role="tab" aria-controls="nav-cadastrar-professor" aria-selected="false">Cadastrar</a>
									</div>
								</nav>
								<div class="tab-content" id="nav-tabContent-professor">
									<div class="tab-pane fade show active" id="nav-rel-professor" role="tabpanel" aria-labelledby="nav-rel-professor-tab">
										<h5 class="mt-2">Relação de Usuarios</h5>
										<hr style="border-width: 5px; border-color:#006FA7">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<label class="input-group-text" for="inputGroupSelect01">Filtro</label>
											</div>
											<select class="custom-select" id="inputGroupSelectProfessor">
												<option selected hidden>Selecione</option>
												<option value="1">RG</option>
												<option value="2">NOME</option>
												<option value="3">CURSO</option>
												<option value="4">TITULAÇÃO</option>
											</select>
											<input type="text" class="form-control" placeholder="Digite sua pesquisa" aria-label="" aria-describedby="basic-addon1">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="pesquisa-professor" title="Pesquisar"><i class="fas fa-search"></i></button>
											</div>
										</div>
											
										<table class="table table-bordered bg-white text-center">
											<thead class="thead-light">
												<tr>
													<th scope="col">ID</th>
													<th scope="col">RG</th>
													<th scope="col">NOME</th>
													<th scope="col">SEXO</th>
													<th scope="col">TITULAÇÃO</th>
													<th scope="col">EDITAR</th>
													<th scope="col">EXCLUIR</th>													
												</tr>
											</thead>	
												
												<tbody class="dadosProfessores">
													
												</tbody>
														
										</table>
										<button class="btn btn-dark" id="btn-rel-professor">Gerar Relatório</button>
									</div>
									<div class="tab-pane fade" id="nav-cadastrar-professor" role="tabpanel" aria-labelledby="nav-cadastrar-professor-tab">
										<form class="" id="formUsuario" onsubmit="return false;">                                    
											<h5 class="mt-2">Cadastro de Usuario</h5>
											<hr style="border-width: 5px; border-color:#006FA7">	
											<div class="form-group">
												<label for="nome">Nome:</label>
												<input class="form-control" type="text" name="nome" id="nome"/>
											</div>
											<div class="form-group">
												<label for="nome">E-mail:</label>
												<input class="form-control" type="text" name="email" id="email"/>
											</div>											
											<div class="form-group">
												<label for="nome">Cargo:</label>
												<input class="form-control" type="text" name="cargo" id="cargo"/>
											</div>
											<div class="form-group mb-5">
												<label for="tipoUsuario">Tipo de usuario:</label>
												<select class="form-control" name="tipoUsuario" id="tipoUsuario">
													<option value="">Selecione</option>
													<option value="Professor">Professor</option>
													<option value="Administrador">Administrador</option>
												</select>
											</div>                                        
											<button class="btn btn-dark" id="btn-cad-professor">Cadastrar</button>                                    
										</form>		
									</div> 
							</div>
                            <!-- FIM CADASTRO DE PROFESSORES -->

							<!-- GERENCIAR NOTÍCIAS -->
							<div class="tab-pane fade" id="v-pills-noticias" role="tabpanel" aria-labelledby="v-pills-noticias-tab">
								<h5>Gerenciar Notícias</h5>
				                <hr style="border-width: 5px; border-color:#006FA7">
							</div>
							<!-- FIM GERENCIAR NOTÍCIAS -->
						</div>	
					</section>
				</div>
					
			</div>	
			
			<!-- RODAPÉ -->
			<footer class="row bg-dark">
				<div class="col-md-12">
					<p class="text-center text-light mt-2">&copy 2018 - Aquilla / Elissandro / Joseano</p>
				</div>
			</footer>
	</div>
	

		<!-- Optional JavaScript -->		
			
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="../js/funcoes.js"></script>			
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="../js/bootstrap.min.js"></script>
  </body>
</html>