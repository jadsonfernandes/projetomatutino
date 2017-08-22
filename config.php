<?php

session_start(); //Inicializo a Minha Session

function __autoload($classe) {

    $enderecos[] = "sistema/modelo/" . $classe . ".php";
    $enderecos[] = "sistema/" . $classe . ".php";
    
    foreach ($enderecos as $endereco){
        if (file_exists($endereco)) {

        require $endereco;
        return true;
        }
    }

    
}

function exibe_msg(){
     if(isset($_SESSION['msg_sucesso'])){
                    
                    echo "<div class='alert alert-success'>";
                    echo $_SESSION['msg_sucesso'];
                    echo "</div>";
                    unset($_SESSION['msg_sucesso']);
                    
                }
                if(isset($_SESSION['msg_erro'])){
                    
                    echo "<div class='alert alert-danger'>";
                   foreach($_SESSION['msg_erro'] as $erro){
                       echo "<li>$erro</erro>";
                   }
                    echo "</div>";
                    unset($_SESSION['msg_erro']);
                }
}

function retornadados($nome){
    $valor = "";
    if(isset($_SESSION[$nome])){
        $valor = $_SESSION[$nome];
        unset($_SESSION[$nome]);
    }
    return $valor;
}

function redirecionar($local){
    header("location: $local"); //Redireciono para a Listagem
    die(); //Mata a aplicação e impede que outros códigos sejam executados
}