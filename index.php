<?php
require 'config.php';

$paginasDAO = new PaginasDAO();

$pagina = new Pagina();
$pagina->setId(9);

$pagina->setTitulo("Alterei o título");
$pagina->setConteudo("Conteúdo novo");

$paginasDAO->salvar($pagina);

var_dump($pagina);


//$paginas = $paginasDAO->buscar();

//echo "<pre>";
//var_dump($paginas);
 
//$pagina1 = $paginasDAO->buscarPorId(1);
//var_dump($pagina1);

//echo $paginasDAO->deletar(1);

/*
$paginasDAO = new paginasDAO;
$paginasDAO->deletar(5);
echo "<br>";
$paginasDAO->buscarPorId(1);
echo "<br>";
$paginasDAO->buscar();
echo "<br>";

$pagina = new Pagina();
$pagina->setTitulo("Meu Título");
$pagina->setConteudo("Meu conteúdo");

$paginasDAO->salvar($pagina);

echo "<br>";

$pagina2 = new Pagina();
$pagina2->setTitulo("Meu Título");
$pagina2->setConteudo("Meu conteúdo");
$pagina2->setId(5);

$paginasDAO->salvar($pagina2);
*/