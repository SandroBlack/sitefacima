$(document).ready(function(){
	
	var funcao = "consultar";
	var tabela = "equipamento";		
		
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao, tabela},
		dataType: 'json',					
		success: function(retorno){				
															
			for(i=0;i<retorno.length;i++){
				
				$('#ListaEquipamento').append('<option value="'+ retorno[i].id_equipamento +'">'+ retorno[i].nome +'</option>');	
					
			}									
		}
	});

	$("#btnAcessar").click(function(){
		location.href="pages/login.html";				 
  	}); 		
	
	$("#btnSair").click(function(){		
		location.href="../index.html";		
	});	

	/* Função de Login */
	$("#btnLogin").click(function(){
		var funcao = "logar";				
		var perfil = $("#perfil").val();
		var login = $("#login").val(); 
		var senha = $("#senha").val();		

		if(perfil == "" || login == "" || senha == ""){
			$("#alerta1").css("display","none");
			$("#alerta2").css("display","block");			
			return false;
		} else{			
			var dados = {funcao, perfil, login, senha};
			$.ajax({			
				type: 'POST',
				url:'../db/funcoes.php',
				data: dados,
				dataType: 'html',
				success: function(retorno){
					if(retorno == "0"){
						$("#alerta2").css("display","none");
						$("#alerta1").css("display","block");						
					} else{
						location.href="../pages/professor.php";							
					}	
				},				
			});			
		}
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
							"<td>" + retorno[i].idequipamento + "</td>"+											
							"<td>" + retorno[i].nome + "</td>"+											
							"<td>" + retorno[i].fabricante + "</td>"+											
							"<td>" + retorno[i].estoque + "</td>"+											
							
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

		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, dataD, horarioInicio, horarioEntrega, listaEquipamento, curso, periodo, sala},
			dataType: 'html',					
			success: function(retorno){				
				alert(retorno);									
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
							"<td>" + retorno[i].idreserva + "</td>"+											
							"<td>" + retorno[i].id_professor + "</td>"+											
							"<td>" + retorno[i].id_equipamento + "</td>"+											
							"<td>" + retorno[i].sala + "</td>"+											
							"<td>" + retorno[i].data + "</td>"+ 																	
							
							"<td><button class='btn btn-sm btn-primary' id='alterarReservaEquip' title='Alterar'>E</button></td>"+
							"<td><button class='btn btn-sm btn-dark' id='excluirReservaEquip' title='Excluir'>X</button></td>"+							
						"</tr>"
					);
				}									
			}
		});
	});
	
	/* CADASTRO DE EQUIPAMENTOS */
	$("#btn-cad-equip").click(function(){
		//var funcao = "cadEquip";
		var dados = $("#formEquipamento").serialize(); 
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: dados,
			dataType: 'html',
			success: function(retorno){
				if(response == "1"){
					alert("Equipamento Cadastrado com Sucesso!");
				} else{
					console.log(retorno);
				}
			}
		});		
	});

	/* PESQUISA DE ALUNOS */
	$("#pesquisa-aluno").click(function(){
		var funcao = "consultar";		
		var tabela = "aluno";		
				
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, tabela},
			dataType: 'json',								
			success: function(retorno){				
				//$(".dadosAlunos").html(retorno);												
				for(i=0;i<retorno.length;i++){
					$(".dadosAlunos").append(				
						"<tr>"+										
							"<td>" + retorno[i].ra + "</td>"+											
							"<td>" + retorno[i].nome + "</td>"+											
							"<td>" + retorno[i].sexo + "</td>"+											
							"<td>" + retorno[i].id_curso + "</td>"+											
							
							"<td><button class='btn btn-sm btn-primary' id='alterarAluno' title='Alterar'>E</button></td>"+
							"<td><button class='btn btn-sm btn-dark' id='excluirAluno' title='Excluir'>X</button></td>"+							
						"</tr>"
					);
				}									
			}
		});
	});

	/* CADASTRO DE ALUNOS */
	$("#btn-cad-aluno").click(function(){		
		var dados = $("#formAluno").serialize(); 
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: dados,
			dataType: 'html',
			success: function(retorno){
				if(response == "1"){
					alert("Aluno Cadastrado com Sucesso!");
				} else{
					console.log(retorno);
				}
			}
		});		
	});

	$(".selectCurso").click(function(){		
		var funcao = "consultar";
		var tabela = "curso";		

		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, tabela},
			dataType: 'json',
			success: function(retorno){				
				for(i=0;i<retorno.length;i++){										
					$("#inputGroupSelectCadAluno").append(						
						"<option>" + retorno[i].nome + "</option>"										
					);					
				}					
			}
		});		
	});

	/* CADASTRO DE PROFESSORES */
	$("#btn-cad-professor").click(function(){
		var dados = $("#formProfessor").serialize();
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: dados,
			dataType: 'html',
			success: function(retorno){
				if(response == "1"){
					alert("Aluno Cadastrado com Sucesso!");
				} else{
					console.log(retorno);
				}
			}
		});
	});

	/* PESQUISA DE PROFESSORES */
	$("#pesquisa-professor").click(function(){
		var funcao = "consultar";
		var tabela = "professor";		
		
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, tabela},
			dataType: 'json',					
			success: function(retorno){				
																
				for(i=0;i<retorno.length;i++){
					$(".dadosProfessores").append(				
						"<tr>"+										
							"<td>" + retorno[i].idprofessor + "</td>"+											
							"<td>" + retorno[i].rg + "</td>"+											
							"<td>" + retorno[i].nome + "</td>"+											
							"<td>" + retorno[i].sexo + "</td>"+											
							"<td>" + retorno[i].titulacao + "</td>"+											
							
							"<td><button class='btn btn-sm btn-primary' id='alterarProfesor' title='Alterar'>E</button></td>"+
							"<td><button class='btn btn-sm btn-dark' id='excluirProfessor' title='Excluir'>X</button></td>"+							
						"</tr>"
					);
				}									
			}
		});
	});
});