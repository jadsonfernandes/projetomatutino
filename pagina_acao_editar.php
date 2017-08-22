<?php
require 'config.php';


if( $_SERVER['REQUEST_METHOD'] == "POST"){
    
    $titulo = filter_input(INPUT_POST, 'titulo');
    $conteudo = filter_input(INPUT_POST, 'conteudo');
    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    
    $pagina = new Pagina();
    $pagina->setTitulo($titulo);
    $pagina->setConteudo($conteudo);
    $pagina->setId($id);
    
    $paginasDAO = new PaginasDAO;
    
    $paginasDAO->salvar($pagina);
    
     $_SESSION['msg_sucesso'] = "Página Editada com Sucesso!";
   
    redirecionar("pagina_editar.php?id=$id");
}
