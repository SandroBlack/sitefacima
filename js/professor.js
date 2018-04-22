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
				$('#reservaUsuario').append('<tr class="bg-light"><td class="text-secondary">'+ retorno[i].nome_equipamento +'</td><td class="text-secondary">'+ retorno[i].sala +'</td><td class="text-secondary">'+ retorno[i].data_reserva +'</td><td class="text-secondary"><i class="fas fa-times-circle fa-3x" id="'+ retorno[i].id_reservar +'"></i></td></tr>');
			}
console.log(retorno);			
		}	
	});
	
	$(document).on('click', '.fa-times-circle', function(){
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