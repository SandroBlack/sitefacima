$(document).ready(function(){
	var funcao = "consultarEquipamento";
	
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao},
		dataType: 'json',					
		success: function(retorno){																	
			for(i=0;i<retorno.length;i++){				
				$('#ListaEquipamento').append('<option value="'+ retorno[i].id_equipamento +'">'+ retorno[i].nome_equipamento +'</option>');					
			}	

		}	
	});
	
	var funcao = "consultarReservaUsuario";	
	$.ajax({
		type: 'POST',
		url: '../db/funcoes.php',
		data: {funcao},
		dataType: 'json',					
		success: function(retorno){							
			for(i=0;i<retorno.length;i++){
				$('#reservaUsuario').append('<tr><td class="text-secondary align-middle">'+ retorno[i].data_reserva +'</td><td class="text-secondary align-middle">'+ retorno[i].patrimonio_equipamento + ' - ' + retorno[i].nome_equipamento + ' ' + retorno[i].fabricante_equipamento + '</td><td class="text-secondary align-middle">'+ retorno[i].sala +'</td><td class="text-secondary align-middle">'+ retorno[i].hora_inicio +'</td><td class="text-secondary align-middle">'+ retorno[i].hora_fim +'</td><td class="text-secondary align-middle"><button class="btn btn-outline-secondary cancelar-reserva" title="Cancelar Reserva" id="'+ retorno[i].id_reservar +'"><i class="fas fa-times-circle fa-1x"></i></button></td></tr>');
			}					
		}	
	});
	
	$(document).on('click', '.cancelar-reserva', function(){
		var funcao = "cancelaReserva";
		var x = this.id;
		$.ajax({
			type: 'POST',
			url: '../db/funcoes.php',
			data: {funcao,x},
			dataType: 'html',					
			success: function(retorno){								
				if(retorno == "1")
				{
					location.href='../pages/professor.php';		
				}				
			}		
		});
	});
});