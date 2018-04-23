<?php
	include_once("../db/dbConexao.php"); 
	/* Usar o Dompdf com Namespaces e corrigir o conflito de nomes */
    use Dompdf\Dompdf;
    include_once("../pdf/dompdf/autoload.inc.php");
	session_start();
	
	$dataRelatorio = inverteData($_POST['dataRelatorio']);
		
		try{
		
		    $pdo = conectar();
            $sql = "SELECT nome_usuario, curso, semestre, periodo, sala, data_reserva, hora_inicio, hora_fim, nome_equipamento
					FROM
					reservar r                    
					INNER JOIN usuario u ON r.fk_usuario = u.id_usuario                    
					INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento
					Where data_reserva = '{$dataRelatorio}'";
            $stm = $pdo->prepare($sql);     
            $stm->execute();
			//$dados = $stm->fetchAll(PDO::FETCH_ASSOC);		
			
			$x = "";
			while($dados = $stm->fetch(PDO::FETCH_ASSOC))
			{
				$x .= "	<tr>
						<td>{$dados['nome_usuario']}</td>
						<td>{$dados['curso']}</td>
						<td>{$dados['semestre']}</td>
						<td>{$dados['periodo']}</td>
						<td>{$dados['sala']}</td>
						<td>{$dados['data_reserva']}</td>
						<td>{$dados['hora_inicio']}</td>
						<td>{$dados['hora_fim']}</td>
						<td>{$dados['nome_equipamento']}</td>
						</tr>
						";
						
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
										<h3 style='' class='page-header'>Relatório de Equipamentos Reservados - {$dataRelatorio}</h3>
									</div>
									<hr style='border-width: 5px; border-color:#006FA7'>			  				
									<div class='table-responsive'>
										<table class='table table-striped table-bordered table-condensed text-center'>
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
													<th>Equipamento</th>
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