<?php	
	include_once("../db/dbConexao.php"); 
	
	/* Usar o Dompdf com Namespaces e corrigir o conflito de nomes */
    use Dompdf\Dompdf;
    include_once("../pdf/dompdf/autoload.inc.php");
	session_start();
	
	$data = date('d/m/Y', strtotime($_POST["dataRelatorio"]));
	$data == "01/01/1970" ? $data = "" : $data = $data;	
	$periodo = $_POST["selectTurno"];
	
		if(empty($data) && empty($periodo)){
			$data = "Geral";
			$sql = "SELECT * FROM reservar r
					INNER JOIN usuario u ON r.fk_usuario = u.id_usuario
					INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento
					ORDER BY ordem ASC, data_reserva DESC";					
		} else if(!empty($data) && empty($periodo)){			
			$sql = "SELECT nome_usuario, curso, semestre, periodo, sala, data_reserva, hora_inicio, hora_fim, patrimonio_equipamento, nome_equipamento
					FROM reservar r                    
					INNER JOIN usuario u ON r.fk_usuario = u.id_usuario                    
					INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento
					WHERE data_reserva = '{$data}'
					ORDER BY ordem ASC, data_reserva DESC";
		} else if(empty($data) && !empty($periodo)){
			$sql = "SELECT nome_usuario, curso, semestre, periodo, sala, data_reserva, hora_inicio, hora_fim, patrimonio_equipamento, nome_equipamento
					FROM reservar r                    
					INNER JOIN usuario u ON r.fk_usuario = u.id_usuario                    
					INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento
					WHERE periodo = '{$periodo}'
					ORDER BY ordem ASC, data_reserva DESC";
		} else{
			$sql = "SELECT nome_usuario, curso, semestre, periodo, sala, data_reserva, hora_inicio, hora_fim, patrimonio_equipamento, nome_equipamento
					FROM reservar r                    
					INNER JOIN usuario u ON r.fk_usuario = u.id_usuario                    
					INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento
					WHERE data_reserva = '{$data}' AND periodo = '{$periodo}'
					ORDER BY ordem ASC, data_reserva DESC";
		}		

		try{			
			$pdo = conectar();							
			$stm = $pdo->prepare($sql);     
			$stm->execute();
			$dados1 = $stm->fetch(PDO::FETCH_ASSOC);
			if(empty($dados1)){
				$x = "<tr><p class='text-center'>Não há equipamentos reservados na data ou período selecionado(s)!</p></tr>";
			} else{				
				$x = "";
				while($dados = $stm->fetch(PDO::FETCH_ASSOC)){
					$x .= "	<tr>
							<td class='align-middle'>{$dados['nome_usuario']}</td>
							<td class='align-middle'>{$dados['curso']}</td>
							<td class='align-middle'>{$dados['semestre']}</td>
							<td class='align-middle'>{$dados['periodo']}</td>
							<td class='align-middle'>{$dados['sala']}</td>
							<td class='align-middle'>{$dados['data_reserva']}</td>
							<td class='align-middle'>{$dados['hora_inicio']}</td>
							<td class='align-middle'>{$dados['hora_fim']}</td>
							<td class='align-middle'>{$dados['patrimonio_equipamento']} - {$dados['nome_equipamento']}</td>
							</tr>";							
				}		
			}
		} catch(PDOExeption $erro){
			echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
			echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
			echo "Linha: " . $erro->getLine();
		}	
		
    /* Cria uma Stancia do Dompdf */
    $dompdf = new DOMPDF();

    /* Nome do Aquivo Pdf */
    $nomeArquivo = "Relatório_de_Equipamentos_Reservados.pdf";
    $conteudo = "<head>
									<link rel='icon' href='../img/favicon-16x16.png'>
									<!-- Bootstrap CSS, Font Awesome -->
									<link rel='stylesheet' href='../css/bootstrap.min.css'>
									<!-- Optional CSS -->
									<link rel='stylesheet' href='../css/style.css'>
								</head>
								<body>
									<div>								
										<img style='float:left; margin-right: 60px' class='mb-0' src='../img/Logo_Loginb.png' alt='Logo Facima'>
										<h3 style='' class='page-header'>Relatório de Equipamentos Reservados - {$data}</h3>
									</div>
									<hr style='border-width: 5px; border-color:#006FA7'>			  				
									<div class='table-responsive'>
										<table class='table table-striped table-bordered table-sm text-center'>
											<thead>
												<tr>
													<th>Professor</th>
													<th>Curso</th>
													<th>Semestre</th>
													<th>Período</th>
													<th>Sala</th>
													<th>Data</th>
													<th>Retirada</th>
													<th>Devolução</th>
													<th>Patrimônio/Equip.</th>
												</tr>
											</thead>
											<tbody>
												{$x}
											</tbody>
										</table>
									</div>
								Gerador por: {$_SESSION['nome_usuario']}
							</body>
					";
    /* Gera a Página com o Conteúdo */
    $dompdf->load_html($conteudo);
	
	/* Colocar a página A4 ou em modo paisagem */
	$dompdf->set_paper('A4','landscape');
	
    /* Renderizando o Pdf */
    $dompdf->render();

    /* Exibe a Página e Define se o Arquivo Será Visualizado Antes de Baixar */
    $dompdf->stream($nomeArquivo, array("Attachment" => false));   

/* FUNÇÃO PARA INVERTER A DATA PARA ESTILO BRASILEIRO */
	function inverteData($data){    
	   $parteData = explode("-", $data);    
	   $dataInvertida = $parteData[2] . "/" . $parteData[1] . "/" . $parteData[0];
	   return $dataInvertida;			
	}	

?>