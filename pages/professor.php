<?php 
session_start();

if (!isset($_SESSION['nome_usuario']) OR ($_SESSION['nivel_acesso'] != "Professor" && $_SESSION['nivel_acesso'] != "Administrador")) {
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

	<title>Facima - Central do Professor</title>
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
			<header class="row align-items-center mb-1 bg-secondary">			
				<nav class="navbar navbar-light col-md-12">
					<a class="navbar-brand h1 text-light mb-0" href=""><i class="fas fa-cogs"></i>&nbsp;CENTRAL DO PROFESSOR</a>
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
						<h5 class="modal-title" id="exampleModalLabel">Central do Professor</h5>
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
			
			<div class="row mb-1" style="min-height: 85vh;">								
				<div class="list-group col-md-2 p-0 bg-white border">					
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">					
						<a class="nav-link active border-bottom" id="v-pills-reserva-tab" data-toggle="pill" href="#v-pills-reserva" role="tab" aria-controls="v-pills-reserva" aria-selected="true"><i class="fas fa-laptop"></i>&nbsp;Reservar Equip.</a>
					</div>					  
				</div>

				<div class="col-md-10 bg-light">
					<section>						
						<div class="tab-content" id="v-pills-tabContent">						

							<!-- RESERVA DE EQUIPAMENTO -->
							<div class="tab-pane fade show active" id="v-pills-reserva" role="tabpanel" aria-labelledby="v-pills-reserva-tab">

								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="nav-equip-reservado-tab" data-toggle="tab" href="#nav-equip-reservado" role="tab" aria-controls="nav-equip-reservado" aria-selected="true">Minhas Reservas</a>
										<a class="nav-item nav-link" id="nav-reservar-equip-tab" data-toggle="tab" href="#nav-reservar-equip" role="tab" aria-controls="nav-reservar-equip" aria-selected="false">Nova Reserva</a>
									</div>
								</nav>

								<div class="tab-content" id="nav-tabContent-equip">
									<div class="tab-pane fade show active table-responsive" id="nav-equip-reservado" role="tabpanel" aria-labelledby="nav-equip-reservado-tab">
										<table class="table table-bordered table-sm bg-white text-center text-secondary table-responsive-sm mt-2">
											<tr>
												<thead class="thead-light">
													<th scope="col">Data</th>
													<th scope="col">Patrimônio/Equipamento</th>
													<th scope="col">Sala</th>
													<th scope="col">Receber</th>
													<th scope="col">Entregar</th>
													<th scope="col">Cancelar</th>
												</thead>										
											</tr>
											<tbody id="reservaUsuario">
											
											</tbody>									
										</table>
									</div>

									<div class="tab-pane fade" id="nav-reservar-equip" role="tabpanel" aria-labelledby="nav-reservar-equip-tab"><br>
										<form class="" id="formReserva" name="formReserva" onsubmit="return false;">
											<div class="row">					      
												<div class="form-group col">
													<label for="data">Data da reserva:</label>
													<input class="form-control" type="date" name="data" id="data">
												</div>
												<div class="form-group col">
													<label for="horario">Aula para entrega do equipamento:</label>
													<select class="form-control" name="horarioInicio" id="horarioInicio">
														<option value="">Selecione</option>
														<option value="1° Aula">1° Aula</option>
														<option value="2° Aula">2° Aula</option>
														<option value="3° Aula">3° Aula</option>
														<option value="4° Aula">4° Aula</option>
													</select>
												</div>
											</div>

											<div class="row">	
												<div class="form-group col">
													<label for="horario">Aula para recolher o equipamento:</label>
													<select class="form-control" name="horarioEntrega" id="horarioEntrega">
														<option value="">Selecione</option>
														<option value="1° Aula">1° Aula</option>
														<option value="2° Aula">2° Aula</option>
														<option value="3° Aula">3° Aula</option>
														<option value="4° Aula">4° Aula</option>
													</select>
												</div>
												<div class="form-group col">
													<label for="equipamento">Equipamento que será reservado:</label>
													<select class="form-control" name="ListaEquipamento" id="ListaEquipamento">
														<option value="">Selecione</option>
													</select>
												</div>
											</div>

											<div class="row">
												<div class="form-group col">
													<label for="sala">Curso:</label>
													<select class="form-control" name="curso" id="curso">
														<option value="">Selecione</option>
														<option value="Ciência da Computação">Ciência da Computação</option>
														<option value="Administração">Administração</option>
														<option value="Direito">Direito</option>
														<option value="Enfermagem">Enfermagem</option>
													</select>
												</div>
												<div class="form-group col">
													<label for="sala">Semestre:</label>
													<select class="form-control" name="semestre" id="semestre">
														<option value="">Selecione</option>
														<option value="1°">1° semestre</option>
														<option value="2°">2° semestre</option>
														<option value="3°">3° semestre</option>
														<option value="4°">4° semestre</option>
														<option value="5°">5° semestre</option>
														<option value="6°">6° semestre</option>
														<option value="7°">7° semestre</option>
														<option value="8°">8° semestre</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="form-group col">
													<label for="sala">Sala para entrega do equipamento:</label>
													<select class="form-control" name="sala" id="sala">
														<option value="">Selecione</option>
														<option value="1">Sala 1</option>
														<option value="2">Sala 2</option>
														<option value="3">Sala 3</option>
														<option value="4">Sala 4</option>
														<option value="5">Sala 5</option>
														<option value="6">Sala 6</option>
														<option value="7">Sala 7</option>
														<option value="8">Sala 8</option>
														<option value="9">Sala 9</option>
														<option value="10">Sala 10</option>
													</select>
												</div>
												<div class="form-group mb-5 col">
													<label for="periodo">Periodo do dia para entrega do equipamento:</label>
													<select class="form-control" name="periodo" id="periodo">
														<option value="">Selecione</option>
														<option value="Matutino">Matutino</option>
														<option value="Vespertino">Vespertino</option>
														<option value="Noturno">Noturno</option>
													</select>
												</div>
											</div>	
											<button class="btn btn-outline-dark mb-5" id="btn-reserva" name="btn-reserva"><i class="fas fa-save"></i>&nbsp;Reservar</button>                                    
										</form>
									</div>	
								</div>
                            	<!-- FIM RESERVA DE EQUIPAMENTO -->
							</div>                       
						</div>
					</section>
				</div>			
			</div>
			
			<!-- RODAPÉ -->
			<footer class="row bg-secondary">
				<div class="col-md-12">
					<p class="text-center text-light mt-2">&copy 2018 - Aquilla / Elissandro / Joseano</p>
				</div>
			</footer>
		</div>
	

		<!-- Optional JavaScript -->		
			
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="../js/jquery-3.3.1.min.js"></script>
		<script src="../js/professor.js"></script>
		<script src="../js/funcoes.js"></script>					
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="../js/bootstrap.min.js"></script>
  </body>
</html>