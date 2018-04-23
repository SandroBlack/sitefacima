$(document).ready(function(){
	var editUsuario;
	var funcao = "consultarUsuarioCadastrado";	
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao},
		dataType: 'json',					
		success: function(retorno){							
			
			for(i=0;i<retorno.length;i++){

				$('#usuariosCadastrados').append('<tr class="bg-light"><td class="text-secondary">'+ retorno[i].nome_usuario +'</td><td class="text-secondary">'+ retorno[i].cargo_usuario +'</td><td class="text-secondary"><button class="btn btn-secondary modal-edit-usuario" data-toggle="modal" data-target="#modalUsuarios" id="'+ retorno[i].nome_usuario +'"><i class="fas fa-ellipsis-v fa-1x"></i></button></td></tr>');
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

				$('#equipamentosCadastrados').append('<tr class="bg-light"><td class="text-secondary">'+ retorno[i].nome_equipamento +'</td><td class="text-secondary">'+ retorno[i].fabricante_equipamento +'</td><td class="text-secondary">'+ retorno[i].quantidade_equipamento +'</td><td class="text-secondary">'+ retorno[i].patrimonio_equipamento +'</td><td class="text-secondary"><button class="btn btn-secondary" data-toggle="modal" data-target="#modalEquipamentos"><i class="fas fa-ellipsis-v fa-1x" id="'+ retorno[i].id_equipamento +'"></i></button></td></tr>');
			}									
		}	
	});
	
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
			}										
		});	
	});
	
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
			}										
		});	
	});
});