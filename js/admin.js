$(document).ready(function(){
	
	var funcao = "consultarUsuarioCadastrado";	
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao},
		dataType: 'json',					
		success: function(retorno){							
			
			for(i=0;i<retorno.length;i++){

				$('#usuariosCadastrados').append('<tr class="bg-light"><td class="text-secondary">'+ retorno[i].nome_usuario +'</td><td class="text-secondary">'+ retorno[i].cargo_usuario +'</td><td class="text-secondary"><button class="btn btn-secondary" data-toggle="modal" data-target="#modalUsuarios"><i class="fas fa-ellipsis-v fa-1x" id="'+ retorno[i].id_usuario +'"></i></button></td></tr>');
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
	
	$(document).on('click', '.dw', function(){
	
	});
});