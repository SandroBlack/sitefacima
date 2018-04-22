<?php
	include_once("../db/dbConexao.php"); 
	include_once("../db/funcoes.php");
	/* Usar o Dompdf com Namespaces e corrigir o conflito de nomes */
    use Dompdf\Dompdf;
    include_once("../pdf/dompdf/autoload.inc.php");
	
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
				</head><body><br><br><br>
				<div class='container'>				
				  <h3 class='page-header'>Relatório de equipamentos reservados no dia {$dataRelatorio}</h3>
				  <div class='table-responsive'>
					<table class='table table-striped table-bordered table-condensed'>
					  <thead>
						<tr>
						  <th>Professor</th>
						  <th>Curso</th>
						  <th>Semestre</th>
						  <th>Período</th>
						  <th>Sala</th>
						  <th>Data Reserva</th>
						  <th>Horário do Pedido</th>
						  <th>Horário da Entrega</th>
						  <th>Equipamento</th>
						</tr>
					  </thead>
					  <tbody>
						{$x}
					  </tbody>
					</table>
				  </div>
				</div></body>
				";
    /* Gera a Página com o Conteúdo */
    $dompdf->load_html($conteudo);
	
	/* Coloca pagina A4 e em modo paisagem */
	$dompdf->set_paper('A4','landscape');
	
    /* Renderizando o Pdf */
    $dompdf->render();

    /* Exibe a Página e Define se o Arquivo Será Visualizado Antes de Baixar */
    $dompdf->stream($nomeArquivo, array("Attachment" => false));    

?>