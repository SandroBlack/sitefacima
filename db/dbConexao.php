<?php 
    function conectar(){
        $host = "mysql:host=localhost; dbname=sitefacima";
        $usuario = "root";
        $senha = "";
        
        try{
            $pdo = new PDO($host, $usuario, $senha);
            $pdo->exec("SET names utf8");                            
        }catch(PDOException $erro){
            echo "Mensagem de Erro: " . $erro->getMessage() . "<br>";
            echo "Nome do Arquivo: " . $erro->getFile() . "<br>";
            echo "Linha: " . $erro->getLine();
           
        }
        return $pdo;
    }
      
?>