<?php

$dsn = "mysql:dbname=projetosamuel";
$usuario = "root";
$senha = "";

$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "UPDATE paginas SET titulo = 'Titulo Alterado' WHERE id = 6";

try{
    
    $editar = $conexao->query($sql);
    $linhas = $editar->rowCount(); //Quantas linhas foram afetadas pela edição
    
    echo "Foram editadas $linhas paginas";
    
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
