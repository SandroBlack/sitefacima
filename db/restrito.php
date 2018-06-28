<?php 
    session_start();

    if(isset($_SESSION["nivel_acesso"]) && $_SESSION["nivel_acesso"] == "Administrador" || $_SESSION["nivel_acesso"] == "Professor"){       
                
    } else{
        session_destroy();        
        header("Location:../index.php");	
    }

?>