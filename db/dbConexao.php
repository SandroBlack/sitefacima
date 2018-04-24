<?php 
    function conectar(){
        //$host = "mysql:host=159.203.174.27; port=3306; dbname=sitefacima";
        $host = "mysql:host=localhost; port=3306; dbname=sitefacima";
        $usuario = "root";
        $senha = "bkj5180";
        try{
            $pdo = new PDO($host, $usuario, $senha);
            $pdo->exec("SET names utf8");                            
        }catch(PDOException $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
			return 0;
        }
        return $pdo;
    }
      
?>