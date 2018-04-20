<?php    
    include_once("dbConexao.php"); 
    $funcao = $_POST["funcao"];   
    
    switch($funcao){
        case "logar":
            logar();
            break;            
        case "cadAluno":
            cadastrarAluno();
            break;            
        case "consultar":
            consultarDados();                                      
            break;            
        case "cadProfessor":
            cadastrarProfessor();
            break;                   
        case "cadEquip":
            cadastrarEquip();
            break;
		case "reservarEquipamento":
            reservarEquipamento();
            break;		
        default:            
            echo "<script>console.log('Função Não Encontrada')</script>";               
    }    

    /* CONSULTAR REGISTROS */
    function consultarDados(){
        $tabela = $_POST["tabela"];

        try{
            $pdo = conectar();
            $sql = "SELECT * FROM {$tabela}";
            $stm = $pdo->prepare($sql);            
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_ASSOC);                                    
            echo json_encode($dados);             
            
        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        } 
        
        /*echo "<table class='table table-bordered bg-white text-center'>";
            echo "<thead class='thead-light'>";
                echo "<tr>";
                    echo "<th scope='col'>RA</th>";
                    echo "<th scope='col'>NOME</th>";
                    echo "<th scope='col'>SEXO</th>";
                    echo "<th scope='col'>CURSO</th>";
                    echo "<th scope='col'>EDITAR</th>";
                    echo "<th scope='col'>EXCLUIR</th>";
                echo " </tr>";
            echo " </thead>";
            echo "<tbody>";
            while($dados = $stm->fetch(PDO::FETCH_ASSOC)){                
                echo "<tr>";
                    echo "<td>{$dados['ra']}</td>";                  
                    echo "<td>{$dados['nome']}</td>";                 
                    echo "<td>{$dados['sexo']}</td>";                  
                    echo "<td>{$dados['id_curso']}</td>";
                    echo "<td><button class='btn btn-sm btn-primary' title='Alterar'>E</button></td>";
					echo "<td><button class='btn btn-sm btn-dark' title='Excluir'>X</button></td>";                  
                echo "</tr>";           
            }
            echo "<tbody>";
        echo "</table>"; */ 
    }

    /* FUNÇÃO DE LOGIN */ 
    function logar(){
        $login = $_POST["login"];
        $senha  = $_POST["senha"];
        $perfil = $_POST["perfil"];
        
        if($perfil == "Administracao"){
            $sql = "SELECT * FROM administracao WHERE idadmin=? AND rg=?";
            $response = "1";
        } else if($perfil == "Aluno"){
            $sql = "SELECT * FROM aluno WHERE ra=? AND rg=?";
            $response = "2";
        } else if($perfil == "Professor"){
            $sql = "SELECT * FROM professor WHERE idprofessor=? AND rg=?";
            $response = "3";
        }

        try{
            $pdo = conectar();
            //$sql = "SELECT * FROM {$perfil} WHERE ra=? AND rg=?";
            $stm = $pdo->prepare($sql);            
            $stm->execute(array($login, $senha));
            $dados = $stm->fetch(PDO::FETCH_NUM);
            $linha = $stm->rowCount();
            
            if($linha == 0){            
                $response = "0";
                echo $response;
                return 0;
            } else{               
                echo $response;                
                session_start();
                $_SESSION["nomeUsuario"] = $dados[2];                
                $_SESSION["idUsuario"] = $dados[0];                
                //header("location:../pages/aluno.php");
                return 0;
            }
        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }    
    }     

    /* CADASTRO DE EQUIPAMENTOS */
    function cadastrarEquipamento(){
        $nome = $_POST["nome"];
        $modelo = $_POST["modelo"];
        $fabricante = $_POST["fabricante"];
        $estoque = $_POST["quantidade"];

        try{
            $pdo = conectar();
            $sql = "INSERT INTO equipamento(nome,modelo,fabricante,estoque) VALUES(:nome,:modelo,:fabricante,:estoque)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(":nome",$nome);
            $stm->bindValue("modelo",$modelo);
            $stm->bindValue(":fabricante",$fabricante);
            $stm->bindValue(":estoque",$estoque);
            $stm->execute();
            $response = "1";
            echo $response;

        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }
    }

    /* CADASTRO DE ALUNOS */
    function cadastrarAluno(){
        $rg = $_POST["rg"];
        $nome = $_POST["nome"];
        $sexo = $_POST["sexo"];       

        try{
            $pdo = conectar();
            $sql = "INSERT INTO equipamento(rg,nome,sexo) VALUES(:rg,:nome,:sexo)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(":rg",$rg);
            $stm->bindValue("nome",$nome);
            $stm->bindValue(":sexo",$sexo);           
            $stm->execute();
            $response = "1";
            echo $response;

        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }
    }

    /* CADASTRO DE PROFESSOR */
    function cadastrarProfessor(){
        $rg = $_POST["rg"];
        $nome = $_POST["nome"];
        $sexo = $_POST["sexo"];       
        $titulacao = $_POST["titulacao"];       

        try{
            $pdo = conectar();
            $sql = "INSERT INTO equipamento(rg,nome,sexo,titulacao) VALUES(:rg,:nome,:sexo,:titulacao)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(":rg",$rg);
            $stm->bindValue("nome",$nome);
            $stm->bindValue(":sexo",$sexo);           
            $stm->bindValue(":titulacao",$titulacao);           
            $stm->execute();
            $response = "1";
            echo $response;

        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }
    }
	
	/* RESERVAR EQUIPAMENTO */
	function reservarEquipamento(){
		$data = $_POST['data'];
		$horarioInicio = $_POST['horarioInicio'];
		$horarioEntrega = $_POST['horarioEntrega'];
		$ListaEquipamento = $_POST['ListaEquipamento'];
		$curso = $_POST['curso'];
		$periodo = $_POST['periodo'];
		$sala = $_POST['sala'];
		
		try{
		
		    $pdo = conectar();
            $sql = "INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `periodo`, `curso`, `sala`, `fk_usuario`, `fk_equipamento`) VALUES (:id, :data_reserva, :hora_inicio, 
					:hora_fim, :periodo, :curso, :sala, :fk_usuario, :fk_equipamento)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(":id",0);
            $stm->bindValue(":data_reserva",$data);
            $stm->bindValue(":hora_inicio",$horarioInicio);
            $stm->bindValue(":hora_fim",$horarioEntrega);
            $stm->bindValue(":periodo",$periodo);           
            $stm->bindValue(":curso",$curso);           
            $stm->bindValue(":sala",$sala);           
            $stm->bindValue(":fk_usuario", $_SESSION["idUsuario"]);           
            $stm->bindValue(":fk_equipamento",$ListaEquipamento);           
            $stm->execute();
            $response = "1";
            echo $response;

        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }
	}
    
?>