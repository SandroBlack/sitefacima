$(document).ready(function(){	

	$("#btnSair").click(function(){
		var funcao = "destruirSessao";
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao},
			dataType: 'html',					
			success: function(retorno){				
				location.href="../index.php";									
			}
		});
				
	});	

	/* FUNÇÃO DE LOGIN */
	$("#btnLogin").click(function(){
		var funcao = "logar";
		var login = $("#login").val(); 
		var senha = $("#senha").val();		
		if(login == "" || senha == ""){
			$("#alertaLogin2").css("display","none");
			$("#alertaLogin3").css("display","none");
			$("#alertaLogin1").css("display","block");			
			return false;
		} else{			
			var dados = {funcao, login, senha};
			$.ajax({			
				type: 'POST',
				url:'db/funcoes.php',
				data: dados,
				dataType: 'html',
				success: function(retorno){

					if(retorno == "0"){
						$("#alertaLogin1").css("display","none");
						$("#alertaLogin2").css("display","none");
						$("#alertaLogin2").css("display","block");						
					} else if (retorno == "00"){						
						$("#alertaLogin1").css("display","none");
						$("#alertaLogin2").css("display","none");
						$("#alertaLogin3").css("display","block");							
					} else {
						location.href='pages/' + retorno + '';						
					}
				}				
			});			
		}
		$(document).keypress(function(e) {
			if(e.which == 13) {
				$("#btnLogin").click();
			}
		});
		
	});

	/* PESQUISA DE EQUIPAMENTOS */
	$("#pesquisa-equipamento").click(function(){
		var funcao = "consultar";
		var tabela = "equipamento";		
		
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, tabela},
			dataType: 'json',					
			success: function(retorno){				
																
				for(i=0;i<retorno.length;i++){
					$(".dadosEquipamentos").append(				
						"<tr>"+										
							"<td class='align-middle'>" + retorno[i].idequipamento + "</td>"+											
							"<td class='align-middle'>" + retorno[i].nome + "</td>"+											
							"<td class='align-middle'>" + retorno[i].fabricante + "</td>"+											
							"<td class='align-middle'>" + retorno[i].estoque + "</td>"+ 							
							"<td><button class='btn btn-sm btn-primary' id='alterarEquip' title='Alterar'>E</button></td>"+
							"<td><button class='btn btn-sm btn-dark' id='excluirEquip' title='Excluir'>X</button></td>"+							
						"</tr>"
					);
				}									
			}
		});
	});
	
	/* RESERVAR EQUIPAMENTO */	
	$("#btn-reserva").click(function(){
		var funcao = "reservarEquipamento";
		var dataD = $("#data").val();
		var horarioInicio = $('#horarioInicio').val();
		var horarioEntrega = $('#horarioEntrega').val();
		var listaEquipamento = $('#ListaEquipamento').val();
		var curso = $('#curso').val();
		var periodo = $('#periodo').val();
		var sala = $('#sala').val();
		var semestre = $('#semestre').val();

		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, dataD, horarioInicio, horarioEntrega, listaEquipamento, curso, periodo, sala,semestre},
			dataType: 'html',					
			success: function(retorno){
				if(retorno == "1")
				{		
					alert("Equipamento Reservado com Sucesso");
					location.href="../pages/professor.php";								
				}
				if(retorno == "11")
				{		
					alert("Todos equipamentos reservados para a data selecionada");								
				}				
			}
		});
	});		

	/* PESQUISA RESERVA DE EQUIPAMENTOS */
	$("#pesquisa-reserva-equip").click(function(){
		var funcao = "consultar";
		var tabela = "reservado";		
		
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, tabela},
			dataType: 'json',					
			success: function(retorno){				
																
				for(i=0;i<retorno.length;i++){
					$(".dadosReserva").append(				
						"<tr>"+																			
							"<td class='align-middle'>" + retorno[i].idreserva + "</td>"+											
							"<td class='align-middle'>" + retorno[i].id_professor + "</td>"+											
							"<td class='align-middle'>" + retorno[i].id_equipamento + "</td>"+											
							"<td class='align-middle'>" + retorno[i].sala + "</td>"+											
							"<td class='align-middle'>" + retorno[i].data + "</td>"+								
							"<td><button class='btn btn-sm btn-primary' id='alterarReservaEquip' title='Alterar'>E</button></td>"+
							"<td><button class='btn btn-sm btn-dark' id='excluirReservaEquip' title='Excluir'>X</button></td>"+							
						"</tr>"
					);
				}									
			}
		});
	});
	
	/* PESQUISA EQUIPAMENTOS RESERVADOS (ADMIN) */
	$("#pesquisa-equip-reservados").click(function(){
		var funcao = "consultarEquipamentoReservado";
		var tabela = "reserva";
		var data = $("#dataRelatorio").val();
		var turno = $("#selectTurno").val();		
		
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, tabela, data, turno},
			dataType: 'json',					
			success: function(retorno){
				if(retorno == 0){
					$(".dadosReservados").empty();
					$(".dadosReservadosMsg").empty();
					$(".dadosReservadosMsg").append("<p class='text-center'>Não há equipamentos reservados na data ou período selecionado(s)!</p>");
				} else{				
					$(".dadosReservados").empty();
					$(".dadosReservadosMsg").empty();												
					for(i=0;i<retorno.length;i++){
						$(".dadosReservados").append(				
							"<tr>"+																			
								"<td class='align-middle'>" + retorno[i].id_reservar + "</td>"+													
								"<td class='align-middle'>" + retorno[i].nome_usuario + "</td>"+
								"<td class='align-middle'>" + retorno[i].patrimonio_equipamento + ' - ' + retorno[i].nome_equipamento + ' ' + retorno[i].fabricante_equipamento + "</td>"+
								"<td class='align-middle'>" + retorno[i].periodo + "</td>"+	
								"<td class='align-middle'>" + retorno[i].sala + "</td>"+														
								"<td class='align-middle'>" + retorno[i].data_reserva + "</td>"+												
								"<td><button class='btn btn-sm btn-outline-secondary' id='"+ retorno[i].id_reservar +"' title='Dar baixa'><i class='fas fa-exchange-alt'></i></button></td>"+							
							"</tr>"
						);
					}
				}																	
			}
		});
	});	
	
	/* CADASTRO DE EQUIPAMENTOS */
	$("#btn-cad-equip").click(function(){
		var funcao = "cadEquip";
		var nome = $('#nome').val();
		var fabricante = $('#fabricante').val();
		var quantidade = $('#quantidade').val();
		var patrimonio = $('#patrimonio').val();
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao,nome,fabricante,quantidade,patrimonio},
			dataType: 'html',
			success: function(retorno){
				if(retorno == "1"){
					alert("Equipamento Cadastrado com Sucesso!");
					location.href="../pages/admin.php";
				}
			}
		});		
	});

	/* CADASTRO DE USUARIOS */
	$("#btn-cad-usuario").click(function(){
		var funcao = 'cadastrarUsuario';
		var nome = $('#nome').val();
		var email = $('#email').val();
		var cargo = $('#cargo').val();
		var senha = $('#senha').val();
		var confSenha = $('#confSenha').val();

		if(senha != confSenha){
			$("#alertaCad1").css("display","none");
			$("#alertaCad2").css("display","none");
			$("#alertaCad3").css("display","block");
			return 0;
		} else if(funcao == '' || nome == '' || email == '' || cargo == '' || senha == '' || confSenha == ''){
			$("#alertaCad1").css("display","none");
			$("#alertaCad2").css("display","block");
			$("#alertaCad3").css("display","none");
			return 0;
		}
		
		var xx = validaEmail(email);
		if(xx == false){
			$("#alertaCad2").css("display","block");
			return 0;
		}
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao,nome,email,cargo,senha},
			dataType: 'html',
			success: function(retorno){
				if(retorno == "1"){
					$("#alertaCad1").css("display","none");
					$("#alertaCad2").css("display","none");
					$("#alertaCad3").css("display","none");
					$("#alertaCad4").css("display","block");
					setTimeout(redirecionarPagina(), 2000);
					//location.href="../index.php";
				}
				if(retorno == "0"){
					$("#alertaCad1").css("display","block");
					$("#alertaCad2").css("display","none");
					$("#alertaCad3").css("display","none");
					$("#alertaCad4").css("display","none");
				}
			}
		});
		function redirecionarPagina(){
			location.href="../index.php";
		}
	});

});

function validaEmail(email) {
  var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  return regex.test(email);
}

