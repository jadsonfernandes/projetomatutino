<?php

//Tipo do banco: nome do banco
$dsn = "mysql:dbname=projetomatutino";
$usuario = "root";
$senha = "";

$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM paginas WHERE id = 1";

try {
    $consulta = $conexao->query($sql); // Executo o SQL e retorno a Consulta
    $dados = $consulta->fetch(PDO::FETCH_ASSOC); // Recupero todos os dados da Consulta
    // Fecth_assoc retorna pra gente os dados com um array associativo
} catch (PDOException $e) {

    echo $e->getMessage();
}


    echo "<li>" . $dados['id'] . ' - ' . $dados['titulo'] . "</li>";
