<?php

$dsn = "mysql:dbname=projetosamuel";
$usuario = "root";
$senha = "";

$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM paginas WHERE id = 1";

try {

    $consulta = $conexao->query($sql); //Executo o SQL e retorno a consulta
    $dados = $consulta->fetch(PDO::FETCH_ASSOC); // Recupero todos os dados da consulta
    // Fetch_assoc retorna pra gente os dados como um array associativo
} catch (PDOException $ex) {
    echo $ex->getMessage();
}


    echo "<li>" . $dados['id'] . " - " . $dados['titulo'] . "</li>";