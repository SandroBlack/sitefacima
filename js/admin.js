$(document).ready(function(){
	var editUsuario;
	var editEquipamento;
	var funcao = "consultarUsuarioCadastrado";	
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao},
		dataType: 'json',					
		success: function(retorno){							
			
			for(i=0;i<retorno.length;i++){
				var nivel = retorno[i].nivel_acesso;
				if(nivel == "Inativo"){
					nivel = '<td class="text-danger align-middle">'+ retorno[i].nivel_acesso + '</td>';
				} else{
					nivel = '<td class="text-secondary align-middle">'+ retorno[i].nivel_acesso + '</td>';
				}	
				$('#usuariosCadastrados').append('<tr><td class="text-secondary align-middle">'+ retorno[i].nome_usuario +'</td><td class="text-secondary align-middle">'+ retorno[i].cargo_usuario +'</td>'+ nivel +'</td><td class="text-secondary align-middle"><button class="btn btn-outline-secondary modal-edit-usuario" title="Editar Cadastro" data-toggle="modal" data-target="#modalUsuarios" id="'+ retorno[i].id_usuario +'"><i class="fas fa-pencil-alt fa-1x"></i></button></td></tr>');		
			}									
		}	
	});
	
	var funcao = "consultarEquipamento";	
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao},
		dataType: 'json',					
		success: function(retorno){							
			
			for(i=0;i<retorno.length;i++){
				var data = new Date(retorno[i].data_cadastro);
				data = data.toLocaleDateString(); 
				$('#equipamentosCadastrados').append('<tr><td class="text-secondary align-middle">'+ retorno[i].patrimonio_equipamento +'</td><td class="text-secondary align-middle">'+ retorno[i].nome_equipamento +'</td><td class="text-secondary align-middle">'+ retorno[i].fabricante_equipamento +'</td><td class="text-secondary align-middle">'+ data +'</td><td class="text-secondary align-middle">'+ retorno[i].nome_usuario +'</td><td class="text-secondary align-middle"><button class="btn btn-outline-secondary modal-edit-equipamento" title="Editar" data-toggle="modal" data-target="#modalEquipamentos" id="'+ retorno[i].nome_equipamento +'"><i class="fas fa-pencil-alt fa-1x"></i></button></td></tr>');
			}									
		}	
	});
	
	// Preencher Modal Editar Usuários
	$(document).on('click', '.modal-edit-usuario', function(){
		var funcao = "editarUsuario";
		editUsuario = this.id;
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao,editUsuario},
			dataType: 'json',					
			success: function(retorno){			
				$('#atualizarNomeUsuario').val(retorno.nome_usuario);
				$('#atualizaEmailUsuario').val(retorno.email_usuario);
				$('#atualizarCargoUsuario').val(retorno.cargo_usuario);
				//$('#atualizarAcessoUsuario').append(retorno.nivel_acesso);
			}										
		});	
	});
	
	// Salvar Dados da Modal Editar Usuário
	$(document).on('click', '#btnAtualizarUsuario', function(){		
		var funcao = "SalvarEdit";
		var novoNome = $('#atualizarNomeUsuario').val();
		var novoEmail = $('#atualizaEmailUsuario').val();
		var novoCargo = $('#atualizarCargoUsuario').val();
		var novoAcesso = $('#atualizarAcessoUsuario').val();
		
		if(novoAcesso == ""){
			alert('Selecione o nivel de acesso'); return 0;
		}

		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, editUsuario, novoNome, novoEmail, novoCargo, novoAcesso},
			dataType: 'html',					
			success: function(retorno){
				if (retorno == "1"){
					alert('Usuario alterado com sucesso');
					location.href='admin.php';
				} else if (retorno == "0"){
					alert('Informações inseridas invalidas');
				}
				//console.log(retorno);
			}										
		});	
	});
	
	$(document).on('click', '.modal-edit-equipamento', function(){
		var funcao = "editarEquipamento";
		editEquipamento = this.id;
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao,editEquipamento},
			dataType: 'json',					
			success: function(retorno){			
				$('#atualizarNomeEquipamento').val(retorno.nome_equipamento);
				$('#atualizarFabricanteEquipamento').val(retorno.fabricante_equipamento);
				$('#atualizarQuantidadeEquipamento').val(retorno.quantidade_equipamento);
				$('#atualizarPatrimonioEquipamento').val(retorno.patrimonio_equipamento);
			}										
		});	
	});
	
	$(document).on('click', '#btnAtualizarEquipamento', function(){
		var funcao = "salvarEditEquip";
		var novoNome = $('#atualizarNomeEquipamento').val();
		var novoFabricante = $('#atualizarFabricanteEquipamento').val();
		var novoQuantidade = $('#atualizarQuantidadeEquipamento').val();
		var novoPatrimonio = $('#atualizarPatrimonioEquipamento').val();

		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao, editEquipamento, novoNome, novoFabricante, novoQuantidade, novoPatrimonio},
			dataType: 'html',					
			success: function(retorno){
				if (retorno == "1"){
					alert('Equipamento alterado com sucesso');
					location.href='admin.php';
				}
			}										
		});	
	});
});