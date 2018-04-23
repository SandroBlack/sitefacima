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

	/* Função de Login */
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
			var dados = {funcao,login, senha};
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
				console.log(retorno);
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
	$("#btn-cad-professor").click(function(){
		var funcao = 'cadastrarUsuario';
		var nome = $('#nomeUsuario').val();
		var email = $('#email').val();
		var cargo = $('#cargo').val();
		var cpf = $('#cpfUsuario').val();
		var tipoUsuario = $('#tipoUsuario').val();
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao,nome,email,cargo,tipoUsuario,cpf},
			dataType: 'html',
			success: function(retorno){
				if(retorno == "1"){
					alert("Usuario Cadastrado com Sucesso!");
					location.href="../pages/admin.php";
				}
				if(retorno == "0"){
					alert("Usuario já Cadastrado!");
				}
			}
		});
	});
});