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
            cadastrarEquipamento();
            break;
		case "reservarEquipamento":
            reservarEquipamento();
            break;
		case "consultarReservaUsuario":
            consultarReservaUsuario();
            break;
		case "cancelaReserva":
            cancelaReserva();
            break;
		case "destruirSessao":
            destruirSessao();
            break;	
		case "consultarUsuarioCadastrado":
            consultarUsuarioCadastrado();
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
	/* CONSULTAR RESERVA DE USUARIOS */
	function consultarReservaUsuario(){
		try{
            $pdo = conectar();
            $sql = "SELECT nome_equipamento, sala, data_reserva,id_reservar FROM reservar r INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento WHERE fk_usuario = :id_usuario;";
            $stm = $pdo->prepare($sql);
			$stm->bindValue(":id_usuario",$_SESSION["idUsuario"]);	
            $stm->execute();
            $dados = $stm->fetchAll(PDO::FETCH_ASSOC);                                    
            echo json_encode($dados);             
            
        } catch(PDOExeption $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
        }
	}
	/* CONSULTAR USUARIOS CADASTRADOS */
	function consultarUsuarioCadastrado(){
		try{
            $pdo = conectar();
            $sql = "SELECT `id_usuario`, `nome_usuario`, `email_usuario`,`cargo_usuario` FROM `usuario`";
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
	/* CONSULTAR EQUIPAMENTOS */
    function consultarEquipamento(){
        try{
            $pdo = conectar();
            $sql = "SELECT id_equipamento, nome_equipamento, quantidade_equipamento, fabricante_equipamento, patrimonio_equipamento FROM equipamento";
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
        $nome_equipamento = $_POST["nome"];;
        $fabricante_equipamento = $_POST["fabricante"];
		$quantidade_equipamento = $_POST["quantidade"];
        $patrimonio_equipamento = $_POST["patrimonio"];

        try{
            $pdo = conectar();
            $sql = "INSERT INTO `equipamento`(`id_equipamento`, `nome_equipamento`, `fabricante_equipamento`, `quantidade_equipamento`, `patrimonio_equipamento`) VALUES (:id_equipamento, :nome_equipamento, :fabricante_equipamento, :quantidade_equipamento, :patrimonio_equipamento)";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(":id_equipamento",0);
            $stm->bindValue(":nome_equipamento",$nome_equipamento);
            $stm->bindValue("fabricante_equipamento",$fabricante_equipamento);
            $stm->bindValue(":quantidade_equipamento",$quantidade_equipamento);
            $stm->bindValue(":patrimonio_equipamento",$patrimonio_equipamento);
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
		$data_reserva = inverteData($_POST['dataD']);
		$hora_inicio = $_POST['horarioInicio'];
		$hora_fim = $_POST['horarioEntrega'];
		$semestre = $_POST["semestre"];
		$curso = $_POST['curso'];
		$sala = $_POST['sala'];
		$periodo = $_POST['periodo'];
		$ListaEquipamento = $_POST['listaEquipamento'];
		
		try{
			$pdo = conectar();
            $sql = "SELECT count(data_reserva) as 'qnt_Reservados',quantidade_equipamento
					FROM
					reservar r                                     
					INNER JOIN equipamento e ON r.fk_equipamento = e.id_equipamento
					Where data_reserva = :data_reserva AND id_equipamento = :id_equipamento";
            $stm = $pdo->prepare($sql);
			$stm->bindValue(":data_reserva",$data_reserva);
			$stm->bindValue(":id_equipamento",$ListaEquipamento);                
            $stm->execute();
			$dados = $stm->fetch(PDO::FETCH_ASSOC);
			if(intval($dados['qnt_Reservados']) >= intval($dados['quantidade_equipamento']))
			{
				$response = "11";
				echo $response;
				return 0;
			} else{				
					try{
			
						$pdo = conectar();
						$sql = "INSERT INTO `reservar`(`id_reservar`, `data_reserva`, `hora_inicio`, `hora_fim`, `semestre`, `curso`, `sala`, `periodo`, `fk_usuario`, `fk_equipamento`) VALUES (:id_reservar, :data_reserva, :hora_inicio, :hora_fim, :semestre, :curso, :sala, :periodo, :fk_usuario, :fk_equipamento)";
						$stm = $pdo->prepare($sql);
						$stm->bindValue(":id_reservar",0);
						$stm->bindValue(":data_reserva",$data_reserva);
						$stm->bindValue(":hora_inicio",$hora_inicio);
						$stm->bindValue(":hora_fim",$hora_fim);
						$stm->bindValue(":semestre",$semestre);           
						$stm->bindValue(":curso",$curso);           
						$stm->bindValue(":sala",$sala);           
						$stm->bindValue(":periodo",$periodo);           
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
			} catch(PDOExeption $erro){
				echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
				echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
				echo "Linha: " . $erro->getLine();
			}	
	}
	/* CANCELAR RESEVA DE EQUIPAMENTO */
	function cancelaReserva(){
		$id_reservar = $_POST['x'];		
		try{
			
			$pdo = conectar();
			$sql = "DELETE FROM `reservar` WHERE id_reservar = :id_reservar";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(":id_reservar",$id_reservar);        
			$stm->execute();
			$response = "1";
			echo $response;
		} catch(PDOExeption $erro){
			echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
			echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
			echo "Linha: " . $erro->getLine();
		}				
	}
	/* FUNÇÃO PARA INVERTER A DATA PARA ESTILO BRASILEIRO */
	function inverteData($data){    
	   $parteData = explode("-", $data);    
	   $dataInvertida = $parteData[2] . "/" . $parteData[1] . "/" . $parteData[0];
	   return $dataInvertida;			
	}
	/* DESTROIR SESSÃO */
	function destruirSessao(){
		session_destroy();
	}
?>