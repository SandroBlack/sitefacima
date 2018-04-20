<?php
	include_once("../db/dbConexao.php"); 
	/* Usar o Dompdf com Namespaces e corrigir o conflito de nomes */
    use Dompdf\Dompdf;
    include_once("../pdf/dompdf/autoload.inc.php");
	
	$dataRelatorio = $_POST['dataRelatorio'];
		
		try{
		
		    $pdo = conectar();
            $sql = "SELECT *
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
						<td>{$dados['nomeUser']}</td>
						<td>{$dados['curso']}</td>
						<td>{$dados['periodo']}</td>
						<td>{$dados['sala']}</td>
						<td>{$dados['data_reserva']}</td>
						<td>{$dados['hora_inicio']}</td>
						<td>{$dados['hora_fim']}</td>
						<td>{$dados['nome']}</td>
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
    $conteudo = "<h1 style='text-align:center;text-decoration:underline;'>Relatório de Equipamentos Reservados</h1>
        <table style='margin: 0 auto;text-align:center;' border='1'>
            <tr>
                <th>Professor</th>
                <th>Curso</th>
                <th>Período</th>
                <th>Sala</th>
                <th>Data Reserva</th>
                <th>Horário do Pedido</th>
                <th>Horário da Entrega</th>
                <th>Equipamento</th>
            </tr>
			{$x}
        </table>
    ";

    /* Gera a Página com o Conteúdo */
    $dompdf->load_html($conteudo);

    /* Renderizando o Pdf */
    $dompdf->render();

    /* Exibe a Página e Define se o Arquivo Será Visualizado Antes de Baixar */
    $dompdf->stream($nomeArquivo, array("Attachment" => false));    

?>