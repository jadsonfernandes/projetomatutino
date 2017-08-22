<?php
require 'config.php';


if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    
   $paginasDAO = new PaginasDAO;
   
   $titulo = filter_input(INPUT_POST, 'titulo');
   $conteudo = filter_input(INPUT_POST, 'conteudo');
   $categoria = filter_input(INPUT_POST, 'categoria');
   
   
   $pagina = new Pagina();
   $pagina->setTitulo($titulo);
   $pagina->setConteudo($conteudo);
   $pagina->setId_categoria($categoria);
   
   //var_dump($pagina);
   
   $validacao = new Validacao();
   $validacao->obrigatorio("Titulo", $pagina->getTitulo());
   $validacao->obrigatorio("Conteúdo", $pagina->getConteudo());
   
   
   
   if($validacao->valida()){
   
   
   
   //echo $paginasDAO->salvar($pagina);
   
   $_SESSION['msg_sucesso'] = "Página Cadastrada com Sucesso!";
   
   redirecionar("pagina_listar.php");
    }else{
    
    $_SESSION['msg_erro'] = $validacao->getMensagem();
    $_SESSION['pagina'] = $pagina;
    redirecionar("pagina_cadastrar.php");
}
    
}

