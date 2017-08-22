<?php
require 'config.php';
if( $_SERVER['REQUEST_METHOD'] == "GET" ){
    //FILTRO PARA APENAS RECEBER NÚMEROS INTEIROS
    $id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
   
    $paginasDAO = new PaginasDAO;
    $paginasDAO->deletar($id);
     
    $_SESSION['msg_sucesso'] = "Página Deletada com Sucesso!";
   
    redirecionar("pagina_listar.php");
}

