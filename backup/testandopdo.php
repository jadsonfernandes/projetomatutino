<?php

$dsn = "mysql:dbname=projetosamuel";
$usuario = "root";
$senha = "";

$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO paginas (titulo,conteudo) VALUES ('Pagina que vamos mudar','Conteúdo')";

try {
    $conexao->query($sql); //Executa o código SQL
    $id = $conexao->lastInsertId(); //Retorna o ultimo id inserido
    echo "A página com id $id foi inserida!";
    
} catch (PDOException $e) {
    
    echo "<h3>Erro: " . $e->getMessage()."</h3>";
}