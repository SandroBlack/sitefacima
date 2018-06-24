<?php
	include_once("../db/dbConexao.php"); 
	session_start();

if (!isset($_SESSION['nome_usuario']) OR ($_SESSION['nivel_acesso'] != 3)) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../index.php");
	exit;
}

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
					<a class="navbar-brand h1 text-light mb-0" href=""><i class="fas fa-cogs"></i>&nbsp;PAINEL ADMINISTRATIVO</a>
					<div class="dropdown">
						<h5 class="text-light mr-2 mt-1 float-left nomeUser"><?=$_SESSION["nome_usuario"]?></h5>								
						<button class="btn btn-dark my-2 my-sm-0 dropdown-toggle" type="submit" data-toggle="dropdown" data-target="#xampleModal"><i class="fas fa-user-circle fa-lg"></i></button>						
						<div class="dropdown-menu">
							<!-- <a class="dropdown-item" href=""><i class="fas fa-address-card"></i>&nbsp;Perfil</a>								 -->
							<button type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</button>						
						</div>
					</div>												
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
			<div class="row mb-1" style="min-height: 85vh;">								
				<div class="list-group col-md-2 p-0 bg-white border">					
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
												
						<a class="nav-link active border-bottom" id="v-pills-equipamentos-tab" data-toggle="pill" href="#v-pills-equipamentos" role="tab" aria-controls="v-pills-equipamentos" aria-selected="false"><i class="fas fa-laptop"></i>&nbsp;Equipamentos</a>
						<a class="nav-link border-bottom" id="v-pills-professores-tab" data-toggle="pill" href="#v-pills-professores" role="tab" aria-controls="v-pills-professores" aria-selected="false"><i class="fas fa-users"></i>&nbsp;Usuarios</a>					
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
									<div class="tab-pane fade show active table-responsive" id="nav-rel-equip" role="tabpanel" aria-labelledby="nav-rel-equip-tab">
									<h5 class="mt-2">Relação de Equipamentos</h5>										
										<hr style="border-width: 5px; border-color:#006FA7">										
										<table class="table table-bordered bg-white text-center" id="equipamentosCadastrados">
											<thead class="thead-light">
												<tr>
													<th scope="col">Nome</th>													
													<th scope="col">Fabricante</th>
													<th scope="col">Quantidade</th>
													<th scope="col">Patrimonio</th>
													<th scope="col">Editar</th>
												</tr>
											</thead>													
										</table>
									</div>
									<div class="tab-pane fade" id="nav-cadastrar-equip" role="tabpanel" aria-labelledby="nav-cadastrar-equip-tab">
										<form class="" id="formEquipamento" onsubmit="return false;">                                    
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
												<input class="form-control" type="number" name="quantidade" id="quantidade" required/>
											</div>                                        
											<div class="form-group">
												<label for="fabricante">Patrimonio do equipamento:</label>
												<input class="form-control" type="number" name="patrimonio" id="patrimonio" required/>
											</div>                                        
											<button class="btn btn-dark" id="btn-cad-equip">Cadastrar</button>                                    
										</form>		
									</div>

									<!-- EQUIPAMENTOS RESERVADOS -->
									<div class="tab-pane fade" id="nav-reservados-equip" role="tabpanel" aria-labelledby="nav-reservados-equip-tab">
										<h5 class="mt-2">Equipamentos Reservados</h5>
										<hr style="border-width: 5px; border-color:#006FA7">
										<form action="../pages/relatorio.php" method="post" target="_blank">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<label class="input-group-text" for="inputGroupSelect">Filtro</label>
												</div>
												<input class="form-control" type="date" name="dataRelatorio" id="dataRelatorio">
												<input hidden name="funcao" id="funcao" value="txt">
												<button class="btn btn-dark" id="btn-res-equip">Gerar Relatório</button>						
											</div>	
										</form>										
									</div>

								</div>
							</div>    
                            <!-- FIM CADASTRO DE EQUIPAMENTOS -->

                            <!-- CADASTRO DE USUÁRIOS -->
							<div class="tab-pane fade" id="v-pills-professores" role="tabpanel" aria-labelledby="v-pills-professores-tab">
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="nav-rel-professor-tab" data-toggle="tab" href="#nav-rel-professor" role="tab" aria-controls="nav-rel-professor" aria-selected="true">Relação</a>
									</div>
								</nav>

								<div class="tab-content" id="nav-tabContent-professor">
								<h5 class="mt-2">Relação de Usuarios</h5>
									<div class="tab-pane fade show active table-responsive" id="nav-rel-professor" role="tabpanel" aria-labelledby="nav-rel-professor-tab">										
										<hr style="border-width: 5px; border-color:#006FA7">										
										<table class="table table-bordered bg-white text-center" id="usuariosCadastrados">
											<thead class="thead-light">
												<tr>
													<th scope="col">Nome</th>
													<th scope="col">Cargo</th>													
													<th scope="col">Editar</th>
												</tr>
											</thead>		
										</table>										
									</div>
							</div>
                            <!-- FIM CADASTRO DE USUÁRIOS -->
						</div>	
						
						<!-- Modal Usuários -->
									<div class="modal fade" id="modalUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												<form class="" id="formUsuario" onsubmit="return false;">                         
													<div class="form-group">
														<label for="nome">Nome:</label>
														<input class="form-control" type="text" name="atualizarNomeUsuario" id="atualizarNomeUsuario"/>
													</div>
													<div class="form-group">
														<label for="nome">E-mail:</label>
														<input class="form-control" type="email" name="atualizaEmailUsuario" id="atualizaEmailUsuario"/>
													</div>													
													<div class="form-group">
														<label for="nome">Cargo:</label>
														<input class="form-control" type="text" name="atualizarCargoUsuario" id="atualizarCargoUsuario"/>
													</div>
													<div class="form-group mb-5">
														<label for="tipoUsuario">Acesso:</label>
														<select class="form-control" name="atualizarAcessoUsuario" id="atualizarAcessoUsuario">
															<option value="">Selecione</option>
															<option value="Bloqueado">Bloqueado</option>
															<option value="Professor">Professor</option>
															<option value="Administrador">Administrador</option>
														</select>
													</div>    											      
												</form>		
											</div>
											
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" class="btn btn-primary" id="btnAtualizarUsuario">Atualizar</button>
											</div>
											</div>
										</div>
									</div>
									<!-- Fim Modal Usuários -->
									
									<!-- Modal Equipamentos-->
									<div class="modal fade" id="modalEquipamentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Editar Equipamento</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<div class="modal-body">
												<form class="" id="formEquipamento" onsubmit="return false;">												
													<div class="form-group">
														<label for="nome">Nome do equipamento:</label>
														<input class="form-control" type="text" name="atualizarNomeEquipamento" id="atualizarNomeEquipamento" required/>
													</div>
													<div class="form-group">
														<label for="modelo">Fabricante do equipamento:</label>
														<input class="form-control" type="text" name="atualizarFabricanteEquipamento" id="atualizarFabricanteEquipamento" required/>
													</div>
													<div class="form-group">
														<label for="fabricante">Quantidade de equipamento(s)</label>
														<input class="form-control" type="number" name="atualizarQuantidadeEquipamento" id="atualizarQuantidadeEquipamento" required/>
													</div>                                        
													<div class="form-group">
														<label for="fabricante">Patrimonio do equipamento:</label>
														<input class="form-control" type="number" name="atualizarPatrimonioEquipamento" id="atualizarPatrimonioEquipamento" required/>
													</div>       										
												</form>		
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" class="btn btn-primary" id="btnAtualizarEquipamento">Atualizar</button>
											</div>
											</div>
										</div>
									</div>
									<!-- Fim Modal -->
									
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
		<script src="../js/admin.js"></script>			
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="../js/bootstrap.min.js"></script>
  </body>
</html>