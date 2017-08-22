<?php

//Tipo do banco: nome do banco
$dsn = "mysql:dbname=projetomatutino";
$usuario = "root";
$senha = "";

$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = " INSERT INTO paginas (titulo,conteudo) VALUES ('Primeira Página','Conteudo')";

try {

    $conexao->query($sql); //Executa o Código SQL

    
} catch (PDOException $e) {
    
    echo "<h3>Erro: " . $e->getMessage() . "</h3>";
}