<?php

require 'config.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    
    $nome = filter_input(INPUT_POST,'nome');
    $login = filter_input(INPUT_POST,'login');
    $senha = filter_input(INPUT_POST,'senha');
    $foto = "";
    
    $upload = new Upload();
    //$upload0>setTipospermitidos(['application/pdf','image/jpeg']);
    $upload->setPasta('fotos');
    $upload->setArquivo('foto');
    if($upload->valida()){
        $foto = $upload->enviar();
    }
    
    $usuario = new Usuario;
    $usuario->setNome($nome);
    $usuario->setLogin($login);
    $usuario->setSenha($senha);
    $usuario->setFoto($foto);
    
    $usuariosDAO = new UsuariosDAO;
    $usuariosDAO->salvar($usuario);
    
   $_SESSION['msg_sucesso'] = "Usuário Cadastrado com Sucesso";
   redirecionar("usuario_listar.php");
}
