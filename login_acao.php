<?php

require 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login  = filter_input(INPUT_POST, 'login');
    $senha = filter_input(INPUT_POST, 'senha');
    
    $usuariosDAO = new UsuariosDAO;
    $usuario = $usuariosDAO->buscar("login = :login",[":login" => $login],false);
    
    // Se existir o usuário e a senha dele estiver correta!
    if($usuario && $usuario->login($senha)){
        
        redirecionar("pagina_listar.php");
    }
    else{
    
        $_SESSION['msg_erro'] = ['Usuário ou Senha Incorretos'];
        $_SESSION['login'] = $login;
        redirecionar('login.php');
    }
    
    
    
    
    
}

