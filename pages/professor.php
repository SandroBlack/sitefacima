<?php session_start();?>

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
					<a class="navbar-brand h1 text-light mb-0" href="">CENTRAL DO PROFESSOR</a>
					<!-- <h3 class="text-light align-center">PAINEL</h3>	 -->					
					<button class="btn btn-dark my-2 my-sm-0" type="submit" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-sign-out-alt"></i>Sair</button>												
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

			<div class="row mb-1" style="height: 85vh;">								
				<div class="list-group col-md-2 p-0 bg-white border">					
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active border-bottom" id="v-pills-inicio-tab" data-toggle="pill" href="#v-pills-inicio" role="tab" aria-controls="v-pills-inicio" aria-selected="true">Inicio</a>
						<a class="nav-link border-bottom" id="v-pills-dados-tab" data-toggle="pill" href="#v-pills-dados" role="tab" aria-controls="v-pills-dados" aria-selected="true">Dados Pessoais</a>
						<a class="nav-link border-bottom" id="v-pills-mensagens-tab" data-toggle="pill" href="#v-pills-mensagens" role="tab" aria-controls="v-pills-mensagens" aria-selected="false">Mensagens
								<span class="badge badge-dark badge-pill ml-4">02</span>
						</a>						
						<a class="nav-link border-bottom" id="v-pills-reserva-tab" data-toggle="pill" href="#v-pills-reserva" role="tab" aria-controls="v-pills-reserva" aria-selected="false">Reservar Equip.</a>
						<a class="nav-link border-bottom" id="v-pills-servicos-tab" data-toggle="pill" href="#v-pills-servicos" role="tab" aria-controls="v-pills-servicos" aria-selected="false">Serviços</a>
					</div>					  
				</div>

				<div class="col-md-10 bg-light">
					<section>						
						<div class="tab-content" id="v-pills-tabContent">

							<!-- INICIO	 -->
							<div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
                            <h5>Bem Vindo Professor!</h5>
				            <hr style="border-width: 5px; border-color:#006FA7">
							</div>
							<!-- FIM INICIO -->

							<!-- DADOS PESSOAIS -->
							<div class="tab-pane fade" id="v-pills-dados" role="tabpanel" aria-labelledby="v-pills-dados-tab">
                                    <h5>Dados Pessoais</h5>
                                    <hr style="border-width: 5px; border-color:#006FA7">
									<div class="bg-secondary">
											
									</div>								
									<table class="table table-bordered bg-white ">
											
											<tbody>
											  <tr class="text-dark">
													<th scope="row">
														<p class="mb-0" style="font-weight: normal">NOME: <span class="text-secondary"><?=$_SESSION["nomeUsuario"]?></span>
														<br>RA: <span class="text-secondary"><?=$_SESSION["idUsuario"]?></span>
														
													</th>																							
													<th scope="row" colspan="1">
															<img src="../img/rosto.svg" alt="Foto Aluno" class="img-thumbnail float-right rosto">
													</th>																							
											  </tr>
											  <tr>
													<th scope="row">RG:</th>
													<td class="text-secondary">200.200.12345</td> 																																																												
											  </tr>
											  <tr>
													<th scope="row">CPF:</th>
													<td class="text-secondary">121.456.789-00</td> 																																																												
											  </tr>
											  <tr>
													<th scope="row">FONE:</th>
													<td class="text-secondary">(82)99999-9999</td> 																																																												
											  </tr>
											  <tr>
													<th scope="row">E-MAIL:</th>
													<td class="text-secondary">email@email.com</td>												
											  </tr>
											  <tr>
													<th scope="row">ENDEREÇO:</th>
													<td class="text-secondary">Avenida Fernandes Lima, 000</td>																								
											  </tr>
											  <tr>
													<th scope="row">BAIRRO:</th>
													<td class="text-secondary">Farol</td>												
											  </tr>
											  <tr>
													<th scope="row">CEP:</th>
													<td class="text-secondary">57080-000</td>												
											  </tr>
											  <tr>
													<th scope="row">CIDADE:</th>
													<td class="text-secondary">Maceió</td>												
											  </tr>											  
											  <tr>
													<th scope="row">ESTADO:</th>
													<td class="text-secondary">Alagoas</td>												
											  </tr>											  
											</tbody>
										</table>
							</div>
							<!-- FIM DADOS PESSOAIS -->

							<!-- MENSAGENS -->
							<div class="tab-pane fade" id="v-pills-mensagens" role="tabpanel" aria-labelledby="v-pills-mensagens-tab">
                                <h5>Mensagens</h5>
                                <hr style="border-width: 5px; border-color:#006FA7">
								<table class="table table-hover table-light">
									<thead>
										<tr class="bg-secondary text-white">
											<th scope="col">Nº</th>
											<th scope="col">Remetente</th>
											<th scope="col">Titulo</th>
											<th scope="col">Recebido</th>
											<th scope="col">Horário</th>
										</tr>
									</thead>
									<tbody>										
										<tr>
											<th scope="row">2</th>
											<td class="text-secondary">Secretaria</td>
											<td class="text-secondary">Atualização</td>
											<td class="text-secondary">15/01/2018</td>
											<td class="text-secondary">16:25</td>
										</tr>
										<tr>
											<th scope="row">1</th>
											<td class="text-secondary">Diretoria</td>
											<td class="text-secondary">Matricula 2018</td>
											<td class="text-secondary">01/01/2018</td>												
											<td class="text-secondary">19:32</td>												
										</tr>
									</tbody>
								</table>
							</div>
							<!-- FIM MENSAGENS -->							

							<!-- RESERVA DE EQUIPAMENTO -->
							<div class="tab-pane fade" id="v-pills-reserva" role="tabpanel" aria-labelledby="v-pills-reserva-tab">
								<h5>Equipamentos Reservados</h5>
                                <hr style="border-width: 5px; border-color:#006FA7">
								<table class="table table-hover mb-5">
									<tr>
										<thead>
											<th scope="col">Equipamento</th>
											<th scope="col">Sala</th>
											<th scope="col">Data</th>
											<th scope="col">Hora</th>
										</thead>										
									</tr>
									<tr class="bg-light">
										<td class="text-secondary"></td>										
									</tr>
								</table>

                                <form class="" id="formReserva">                                    
                                        <h5>Reserva de Equipamentos</h5>
                                        <hr style="border-width: 5px; border-color:#006FA7">

                                        <div class="form-group">
                                            <label for="data">Data:</label>
                                            <input class="form-control" type="date">
                                        </div>
                                        <div class="form-group">
                                            <label for="horario">Horário:</label>
                                            <select class="form-control" name="horarioInicio" id="horarioInicio">
                                                <option value="">Selecione</option>
                                                <option value="1">1° Aula</option>
												<option value="2">2° Aula</option>
												<option value="3">3° Aula</option>
												<option value="4">4° Aula</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label for="horario">Horário De Entrega:</label>
                                            <select class="form-control" name="horarioEntrega" id="horarioEntrega">
                                                <option value="">Selecione</option>
                                                <option value="1">1° Aula</option>
												<option value="2">2° Aula</option>
												<option value="3">3° Aula</option>
												<option value="4">4° Aula</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label for="equipamento">Equipamento:</label>
                                        <select class="form-control" name="ListaEquipamento" id="ListaEquipamento">
                                            <option value="">Selecione</option>
                                            <option value="">...</option>
                                        </select>
                                        </div>
										<div class="form-group">
                                        <label for="sala">Curso:</label>
                                        <select class="form-control" name="" id="">
                                            <option value="">Selecione</option>
                                            <option value="">Ciência da Computação</option>
											 <option value="">Administração</option>
											 <option value="">Direito</option>
											 <option value="">Enfermagem</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                        <label for="sala">Sala:</label>
                                        <select class="form-control" name="" id="">
                                            <option value="">Selecione</option>
                                            <option value="">Sala 1</option>
											 <option value="">Sala 2</option>
											 <option value="">Sala 3</option>
											 <option value="">Sala 4</option>
											 <option value="">Sala 5</option>
											 <option value="">Sala 6</option>
											 <option value="">Sala 7</option>
											 <option value="">Sala 8</option>
											 <option value="">Sala 9</option>
											 <option value="">Sala 10</option>
                                        </select>
                                        </div>
                                        <button class="btn btn-dark" id="btn-reserva">Reservar</button>                                    
                                </form>
							</div>
                            <!-- FIM RESERVA DE EQUIPAMENTO -->
                            
							<!-- SERVIÇOS -->
							<div class="tab-pane fade" id="v-pills-servicos" role="tabpanel" aria-labelledby="v-pills-servicos-tab">
								<h5>Serviços</h5>
				                <hr style="border-width: 5px; border-color:#006FA7">
							</div>
							<!-- FIM SERVIÇOS -->

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
		<script src="../js/funcoes.js"></script>			
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="../js/bootstrap.min.js"></script>
  </body>
</html>