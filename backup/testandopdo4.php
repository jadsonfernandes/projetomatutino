<?php

$dsn = "mysql:dbname=projetosamuel";
$usuario = "root";
$senha = "";

$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "DELETE FROM paginas WHERE id = 4";

try{
    
    $execucao = $conexao->query($sql);
    $linhas = $execucao->rowCount(); //Quantas linhas foram modificadas pela linha anetrior.
    
    echo "Foram apagada(s) $linhas pagina(s)";
    
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

