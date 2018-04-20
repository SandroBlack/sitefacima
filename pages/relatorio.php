<?php
    /* Usar o Dompdf com Namespaces e corrigir o conflito de nomes */
    use Dompdf\Dompdf;
    include_once("../pdf/dompdf/autoload.inc.php");

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
                <th>Horário</th>
                <th>Equipamento</th>
            </tr>
           <tr>
                <td>Ronaldo Fernandes</td>
                <td>Ciência da Computação</td>
                <td>7º</td>
                <td>30</td>
                <td>19:15 ás 20:30</td>
                <td>Projetor Epson</td>
           </tr>
        </table>
    ";

    /* Gera a Página com o Conteúdo */
    $dompdf->load_html($conteudo);

    /* Renderizando o Pdf */
    $dompdf->render();

    /* Exibe a Página e Define se o Arquivo Será Visualizado Antes de Baixar */
    $dompdf->stream($nomeArquivo, array("Attachment" => false));    

?>