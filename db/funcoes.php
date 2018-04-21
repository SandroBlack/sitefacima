<?php    
    include_once("dbConexao.php"); 
    $funcao = $_POST["funcao"];  
	session_start();
    
    switch($funcao){
        case "logar":
            logar();
            break;            
        case "cadAluno":
            cadastrarAluno();
            break;            
        case "consultarEquipamento":
            consultarEquipamento();                                      
            break;            
        case "cadastrarUsuario":
            cadastrarUsuario();
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
	
    /* FUNÇÃO DE LOGIN */ 
    function logar(){
        $login = $_POST["login"];
        $senha  = $_POST["senha"];

        try{
            $pdo = conectar();
            $sql = "SELECT * FROM usuario WHERE email_usuario = :email AND senha_usuario = :senha";
            $stm = $pdo->prepare($sql);            
            //$stm->execute(array($login, $senha));
			$stm->bindValue(":email",$login);
			$stm->bindValue(":senha",$senha);
			$stm->execute();
            $dados = $stm->fetch(PDO::FETCH_NUM);
            $linha = $stm->rowCount();
            
            if($linha == 0){            
                $response = '0';
                echo $response;
                return 0;
            } else{              
                $_SESSION['id_usuario'] = $dados[0];                
                $_SESSION['nome_usuario'] = $dados[1];                
                $_SESSION['email_usuario'] = $dados[2];                
                $_SESSION['cargo_usuario'] = $dados[4];                
                $_SESSION['nivel_acesso'] = $dados[5];
                //header("location:../pages/aluno.php");
				
				if($dados[5] == 3)
				{
					echo 'admin.php';
				}
				else
				{
					echo 'professor.php';
				}	
                return 0;
            }
        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }    
    }
	 /* CADASTRO DE USUARIO */
    function cadastrarUsuario(){
        $nome_usuario = $_POST['nome'];
        $email_usuario = $_POST['email'];
        $senha_usuario = '29529dewc2q92cd';
        $cargo_usuario = $_POST['cargo'];
		$nivel_acesso = $_POST['tipoUsuario'];
		if($nivel_acesso == "Professor"){
			$nivel_acesso = 1;
		} else{
			$nivel_acesso = 3;
		}		
		try{
			$pdo = conectar();
            $sql = "SELECT `nome_usuario`, `email_usuario` FROM `usuario` WHERE `email_usuario` = :email_usuario";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(":email_usuario",$email_usuario);         
            $stm->execute();
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
			if($dados == 0)
			{
				try{
					$pdo = conectar();
					$sql = "INSERT INTO `usuario`(`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `cargo_usuario`, `nivel_acesso`) VALUES(:id_usuario,:nome_usuario,:email_usuario,:senha_usuario, :cargo_usuario, :nivel_acesso)";
					$stm = $pdo->prepare($sql);
					$stm->bindValue(":id_usuario",0);
					$stm->bindValue(":nome_usuario",$nome_usuario);
					$stm->bindValue(":email_usuario",$email_usuario);           
					$stm->bindValue(":senha_usuario",$senha_usuario);           
					$stm->bindValue(":cargo_usuario",$cargo_usuario);           
					$stm->bindValue(":nivel_acesso",$nivel_acesso);           
					$stm->execute();
					$response = "1";
					echo $response;

				} catch(PDOExeption $erro){
					echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
					echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
					echo "Linha: " . $erro->getLine();
				}
				
			}else {
				$response = "0";
				echo $response;
			}
		} catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }  
    }
	/* CONSULTAR EQUIPAMENTOS */
    function consultarEquipamento(){

        try{
            $pdo = conectar();
            $sql = "SELECT id_equipamento, nome_equipamento FROM equipamento";
            $stm = $pdo->prepare($sql);            
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_ASSOC);                                    
            echo json_encode($dados);             
            
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
	/* RESERVAR EQUIPAMENTO */
	function reservarEquipamento(){
		$data = $_POST['dataD'];
		$horarioInicio = $_POST['horarioInicio'];
		$horarioEntrega = $_POST['horarioEntrega'];
		$ListaEquipamento = $_POST['listaEquipamento'];
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
            $stm->bindValue(":hora_inicio",$horarioInicio . " ° Aula");
            $stm->bindValue(":hora_fim",$horarioEntrega . " ° Aula");
            $stm->bindValue(":periodo",$periodo . " °");           
            $stm->bindValue(":curso",$curso);           
            $stm->bindValue(":sala","Sala n° " . $sala);           
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